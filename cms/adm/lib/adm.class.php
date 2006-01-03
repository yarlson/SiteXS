<?php
include admin::getDocumentRoot()."/lib/db.conf.php";
include "mysql.class.php";
class admin {

	var $nav;
	var $elements;
	var $id;
	var $action;
	
	function admin () {
		include_once ("./lib/config.inc.php");
		session_start();
		if ($_GET["action"]=="logout") {
			session_destroy();
			header("Location: ./");
		}
		if (!$_SESSION["user_id"]) {
			if ($_POST["user"] && $_POST["pass"]) {
				$db=new sql;
				$db->connect();
				$res=$db->query("select id, pass from users where login='".$_POST["user"]."'");
				$data=$db->fetch_array($res);
				if ($data["pass"]==md5($_POST["pass"])) {
					$_SESSION["user_id"]=$data["id"];
					header("Location: ./");
				}
				else {
					$this->message="<h3 style=\"color: red;\">Ќеправильный логин или пароль!!!</h3>";
					$login=$page->template("login", $this);
					echo $login;
					exit;
				}
			}
			else {
				$login=$this->template("login", $this);
				echo $login;
				exit;
			}
		}
		else {
			$db=new sql;
			$db->connect();
			$res=$db->query("select id, name, admin from users where id=".$_SESSION["user_id"]);
			$data=$db->fetch_array($res);
			$this->user=$data["name"];
			$this->user_id=$data["id"];
			$this->user_admin=$data["admin"];
		}
		$this->nav=$nav;
		$this->admin_config=$admin_config;
		$this->id=($_GET["chid"]) ? $_GET["chid"] : 1;
		$this->action=$_GET["action"];
		
	}

	function setMenu ($id=0) {
		
		for ($i=1; $i<=count($this->nav); $i++) {
			$this->i=$i;
			if ($this->nav[$i][0]==$id) {
				if (!$this->nav[$i][4] || ($this->nav[$i][4] && $this->user_admin)) {
					$im = ($this->nav[$i][3]) ? $this->nav[$i][3] : "dot.gif";
					$this->nameI="<img src=\"i/".$im."\" alt=\"\" border=\"0\" align=\"absmiddle\" hspace=\"6\" width=\"16\" height=\"16\">".$this->nav[$i][1];
					if ($i==$this->id && !$this->action) {
						$menu.=$this->template("menuItemCurM", $this);
					}
					elseif ($i==$this->nav[$this->id][0] || ($i==$this->id && $this->action)) {
						$menu.=$this->template("menuItemCur", $this);
					}
					else {
						$menu.=$this->template("menuItem", $this);
					}
				}
			}
		}
		if ($menu) {
			$this->menu=$menu;
			$menu=$this->template("menu", $this);
		}
		if ($id)
			$this->elements["subMenu"]=$menu;
		else
			$this->elements["menu"]=$menu;
	}

	function setTitle () {
		
		$this->elements["title"]="<h2><nobr>".$this->nav[$this->id][1]."</nobr></h2>";
		
	}

	function getAll () {
		$g=$_GET["nomain"];
		if (!$g) {
			$this->setMenu();
			$id=$this->id;
			$id=($this->nav[$id][0]==0) ? $id : $this->nav[$id][0];
			$this->setMenu($id);
			$this->setTitle();
		}
		$className=$this->nav[$this->id][2];
		if ($className) {
			if (file_exists("./lib/$className.class.php")) {
				include_once "./lib/$className.class.php";
				$curClass= new $className;
				
				$action=$this->action;
				if ($action){
					if (method_exists($curClass, $action))
						$curClass->$action();
					elseif ($this->admin_config["show_warnings"])
						$this->warnings.="<p>There is no method <b>$action</b> in class <b>$className</b></p>";
				}
				else {
					if (method_exists($curClass, "defaultAction"))
						$curClass->defaultAction();
					elseif ($this->admin_config["show_warnings"])
						$this->warnings.="<p>There is no method <b>defaultAction</b> in class <b>$className</b></p>";
				}
			}
			else
				$this->warnings.=($this->admin_config["show_warnings"]) ? "<b>$className.class.php</b> - Class difinition file is missing!" : "";

		}
		if (is_array($curClass->elements)) extract($curClass->elements);
		$this->warnings.=$_SESSION["warning"];
		if ($_GET["w"]) {
			$_SESSION["warning"]="";
			$_SESSION["old_data"]="";
		}
		if ($this->warnings) $this->warnings=$this->showWarnings($this->warnings);
		$this->content=$this->warnings.$content;
		if (!$g) {
			$main=$this->template("main", $this);
		}
		else $main=$this->content;
		return $main;
		
	}

	function template ($name, &$ref) {
	    $file=admin::getDocumentRoot()."/adm/templates/".trim($name).".php";
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

	function getDateSelectOptions ($date='') {
		if (!$date) $date=time();
		for ($i=(int)date("Y"); $i>1994; $i--) {
			$select["year"].="<option value=\"$i\"".((@date("Y", $date)==$i) ? " selected" : "").">$i</option>";
		}
		$month=array("1"=>"€нвар€","феврал€","марта","апрел€","ма€","июн€","июл€","августа","сент€бр€","окт€бр€","но€бр€","декабр€");
		for ($i=1; $i<13;$i++) {
			$select["month"].="<option value=\"$i\"".((@date("m", $date)==$i) ? " selected" : "").">$month[$i]</option>";
		}
		for ($i=1; $i<32; $i++) {
			$select["day"].="<option value=\"$i\"".((@date("d", $date)==$i) ? " selected" : "").">$i</option>";
		}
		return $select;
	}

	function getTypeID ($typeName) {
		include "./lib/config.inc.php";
		foreach ($nav as $key => $value) {
			if ($value[2]==$typeName) return $key;
		}
		return false;
	}

	function showWarnings ($warningsText) {
		return "<div class=\"error\">".$warningsText."</div>";
	}

	function showMessage($warningsText) {
		return "<div class=\"message\">".$warningsText."</div>";
	}

	function getDocumentRoot () {
		return preg_replace("'/$'", "", getenv("DOCUMENT_ROOT"));
	}

	function adminConfig() {
		include "./lib/config.inc.php";
		return $admin_config;
	}

	function sendHeaders() {
		$GLOBALS['now'] = gmdate('D, d M Y H:i:s') . ' GMT';
		header('Expires: ' . $GLOBALS['now']); // rfc2616 - Section 14.21
		header('Last-Modified: ' . $GLOBALS['now']);
		header('Cache-Control: no-store, no-cache, must-revalidate, pre-check=0, post-check=0, max-age=0'); // HTTP/1.1
		header('Pragma: no-cache'); // HTTP/1.0
		header("Content-Type: text/html; charset=windows-1251");
	}

	function null2nbsp($text) {
		return ($text) ? $text : "&nbsp;";
	}

	function slashesIn ($string) {
		return str_replace("'", "\\'", $string);
	}

	function slashesOut ($string) {
		return str_replace("\"", "&quot;", $string);
	}

	function toUnixTime($string) {
		if (preg_match("/\d{1,2}\.\d{1,2}\.\d{2,4}?/",$string)) {
			$temparr=explode(".",$string);
			$result=mktime(0,0,0, $temparr[1], $temparr[0], $temparr[2]);
		}
		return $result;
	}
}
?>