<?php
class elements {

	function elements ($dirs) {
		$this->dirs=$dirs;
		
		$this->db=new sql;
		$this->db->connect();
		$res=$this->db->query("select * from chapters where id='".$this->dirs["id"][$this->dirs["count"]-1]."'");
		$this->properties=$this->db->fetch_array($res);
		
	}

	function breadCrumbs () {
		if ($this->properties["id"]!=1 && $this->properties["id"]!=6) {
			$this->elements["breadCrumbs"]="<a href=\"/intro/\"><img src=\"/i/home.gif\" alt=\"\" width=22 height=20 border=0 vspace=5 hspace=5 align=\"absmiddle\">Сетевое &laquo;Я&raquo; Ярослава Кравцова</a>";
			$count=($this->dirs["root"] && count($this->dirs["url"])!=count($this->dirs["id"])) ? $this->dirs["count"] : $this->dirs["count"]-1;
			for ($i=0; $i<$count; $i++) {
				$url.=$this->dirs["url"][$i]."/";
				$this->elements["breadCrumbs"].="&nbsp;<img src=\"/i/rarr.gif\" alt=\"\" width=\"9\" height=\"20\" border=\"0\" align=\"absmiddle\">&nbsp;<a href=\"/".$url."\">".$this->dirs["title"][$i]."</a>";
			}
			//if (!($this->dirs["root"] && count($this->dirs["url"])!=count($this->dirs["id"]))) $this->elements["breadCrumbs"].=$this->dirs["title"][$this->dirs["count"]-1];
		}
		else {
			$this->elements["breadCrumbs"]="<img src=\"/i/dot.gif\" alt=\"\" width=\"1\" height=\"30\" border=\"0\">";
		}
	}

	function content () {
		$this->elements["content"]=$this->properties["text"];
	}

	function menus () {
		$mt=$this->mt;
		$this->mt=$this->getmicrotime();
		$this->mta[]=  "<!-- b menu".($this->mt-$mt)." -->";
		$res=$this->db->query("select * from menus order by id");
		while ($menus=$this->db->fetch_array($res)) {
			$res1=$this->db->query("select title, url, id from chapters where pid=0 and menu=".$menus["id"]." order by sortorder");
			while($data=$this->db->fetch_array($res1)) {
				
				$i++;
				
				if ($data[id]==1)
					$data["url"]="";
				else
					$data["url"].="/";
				
				if ($data["id"]==$this->dirs["id"][$this->dirs["count"]-1]) {
					$tpl="cur";
				}
				elseif ($data["id"]==$this->dirs["id"][0]) {
					$tpl="open";
				}
				else {
					$tpl="";
				}
				eval('$menuNodes.="'.page::escapeText($menus[$tpl."node_tpl"]).'";');
				
			}
			eval('$menu.="'.page::escapeText($menus["main_tpl"]).'";');
			$this->elements["menu".$menus["id"]]=$menu;
			unset($menu);unset($i);unset($menuNodes);
		}
		$mt=$this->mt;
		$this->mt=$this->getmicrotime();
		$this->mta[]=  "<!-- amenu".($this->mt-$mt)." -->";
	}

	function leftBar() {
		$this->elements["leftBar"]="";
	}

	function rightBar() {
		$this->elements["rightBar"]="";
	}

	function contentTitle() {
		if ($this->properties["id"]>1) $this->elements["contentTitle"]="<h1>".$this->properties["title"]."</h1>";
	}

	function title() {
		$this->elements["title"]=$this->properties["title"];
	}

	function contentSubTitle() {
		if ($this->properties["subtitle"]) $this->elements["contentSubTitle"]="<h1>".$this->properties["subtitle"]."</h1>";
	}

	function authors() {
		$this->elements["authors"]="";
	}

	function style () {
		if (file_exists(page::getDocumentRoot()."/images/bottom/w".$this->properties["id"].".gif")) {
			$this->elements["style1"]="background: url(/images/bottom/w".$this->properties["id"].".gif) bottom right no-repeat;";
			$this->elements["style2"]=" url(/images/bottom/w".$this->properties["id"].".gif) bottom right no-repeat";
		}
		if (file_exists(page::getDocumentRoot()."/images/bottom/w".$this->properties["id"]."_.gif")) {
			$this->elements["style3"]=" style=\"background: url(/images/bottom/w".$this->properties["id"]."_.gif) bottom right no-repeat;\"";
		}
	}

	function time() {
		$this->elements["time"]="";
	}

	function keywords() {
		$this->elements["keywords"]=$this->properties["keywords"];
	}

	function description() {
		$this->elements["description"]=$this->properties["description"];
	}

	function getmicrotime(){ 
    list($usec, $sec) = explode(" ",microtime()); 
    return ((float)$usec + (float)$sec); 
  }

}
?>