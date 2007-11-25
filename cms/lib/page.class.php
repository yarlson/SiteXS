<?php
class page {

	function page() {

		$this->documentRoot=$this->getDocumentRoot();
		
		$this->db=& $GLOBALS['db'];
	}

	function parseURI () {
		
		$this->url=parse_url($_GET["url"]);

		if ($this->url["path"]!="/" and $this->url["path"]!="") {
			$this->dirs["url"]=explode("/", preg_replace("'^\/|\/$'", "", $this->url["path"]));
		}
		else {
			$this->dirs["url"][]="index";
		}
		
		if ($this->url["query"]) {
			parse_str($this->url["query"], $this->get);
		}
	}

	function findPath() {
	
		$pid=0;
		
		for ($i=0; $i<count($this->dirs["url"]) && !($data["type"] && $data["root"]); $i++) {
		
			$res=$this->db->query("select chapters.id as cid, pid, chapters.title as ctitle, type, url, root from chapters left join types on (chapters.type=types.id) where url='".$this->dirs["url"][$i]."' and pid='".$pid."'");
			$data=$this->db->fetch_array($res);
			
			$this->dirs["id"][]=$data["cid"];
			$this->dirs["pid"][]=$data["pid"];
			$this->dirs["title"][]=$data["ctitle"];
			$this->dirs["type"][]=$data["type"];
			$this->dirs["root"]=$data["root"];
			
			$pid=$data["cid"];
			
			if ($data["cid"]) {
				$this->dirs["count"]=count($this->dirs["id"]);
			}
		}
		
		$this->id=$data["cid"];
	}

	function getElements() {
		
		include_once ($this->documentRoot."/lib/elements.class.php");
		
		$this->els=new elements($this->dirs);
		$elementsMethods = get_class_methods(get_class($this->els));
		for ($i=1; $i<count($elementsMethods); $i++) {
			$methodName=$elementsMethods[$i];
			if (substr($methodName, 0, 1)!="_") $this->elements[$methodName]=$this->els->$methodName();
		}
		//print_r($this->elements);
		$moduleId=$this->dirs["type"][count($this->dirs["type"])-1];
		if ($moduleId) {
			
			$this->db->connect();
			$res=$this->db->query("select * from types where id='$moduleId'");
			$data=$this->db->fetch_array($res);
			
			include $this->documentRoot."/lib/modules/".$data["name"].".class.php";
			
			for ($i=0; $i<count($this->dirs["type"]); $i++) {
				$url_before.=$this->dirs["url"][$i]."/";
			}
			
			$url=$this->url["path"];
			$url=preg_replace("'^\/".addslashes($url_before)."'", "", $url);
			
			$module=new $data["name"]($this->dirs);
			$modulesMethods = get_class_methods(get_class($module));
			
			for ($i=1; $i<count($modulesMethods); $i++) {
				$methodName=$modulesMethods[$i];
				if (substr($methodName, 0, 1)!="_") $moduleElements[$methodName]=$module->$methodName();
			}
			
			if (method_exists($module, "_error404")) {
				if ($module->_error404()) {
					readfile ($this->documentRoot."/404.html");
					exit;
				}
			}
			
			foreach ($this->elements as $key => $value) {
				if ($moduleElements[$key]) $this->elements[$key]=$moduleElements[$key];
			}
			
		}

	}

	function getConfig() {
		$db=& $GLOBALS['db'];;
		$res=$db->query("select * from config");
		while ($data=$db->fetch_array($res)) {
			$this->config[$data["name"]]=$data["text"];
		}
		return $this->config;
	}

	function sendHeader() {
		if (count($this->dirs["url"])==$this->dirs["count"] || $this->dirs["root"]) {
			header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
			header("Content-Type: text/html; charset=".$this->config["charset"]);
			header("HTTP/1.0 200 OK", true);
		}
		else {
			header("HTTP/1.0 404 OK", false);
			readfile($this->documentRoot."/404.html");
			exit;	
		}
	}

    function isMain() {
        return ($this->id==1 || $this->id==6);
    }

	function getDocumentRoot () {
		
		return preg_replace("'/$'", "", getenv("DOCUMENT_ROOT"));
		
	}

	function template ($name, &$ref) {
	    
		$file=page::getDocumentRoot()."/templates/".trim($name).".php";
		if (file_exists($file)) {
            ob_start();
			include $file;
            $template=ob_get_contents();
            ob_end_clean();
        }
		else
			$template=($admin_config["show_warnings"]) ? addslashes(page::showWarnings("<b>".trim($name).".php</b> - Template is missing!")) : "";
		return $template;
		
	}

	function escapeText ($text) {
		return str_replace("\\'", "'", addslashes($text));
	}

	function showWarnings ($warningsText) {
		return "<div class=\"error\">".$warningsText."</div>";
	}

	function getmicrotime(){ 
    list($usec, $sec) = explode(" ",microtime()); 
    return ((float)$usec + (float)$sec); 
  }

}
?>
