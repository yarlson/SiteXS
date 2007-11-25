<?php
class elements {

	function elements ($dirs) {
		$this->dirs=$dirs;
		
		$this->db=& $GLOBALS['db'];

		$res=$this->db->query("select * from chapters where id='".$this->dirs["id"][$this->dirs["count"]-1]."'");
		$this->properties=$this->db->fetch_array($res);
		
	}

	function breadCrumbs () {
		if ($this->properties["id"]!=1) {
			$breadCrumbs="";
			$count=($this->dirs["root"] && count($this->dirs["url"])!=count($this->dirs["id"])) ? $this->dirs["count"] : $this->dirs["count"]-1;
			for ($i=0; $i<$count; $i++) {
				$url.=$this->dirs["url"][$i]."/";
				$breadCrumbs.="&nbsp;&rarr;&nbsp;<a href=\"/".$url."\">".$this->dirs["title"][$i]."</a>";
			}
			if (!($this->dirs["root"] && count($this->dirs["url"])!=count($this->dirs["id"]))) $breadCrumbs.="&nbsp;&rarr; ".$this->dirs["title"][$this->dirs["count"]-1];
			$breadCrumbs="<a href=\"/\">".__("Home")."</a>".$breadCrumbs;
			return $breadCrumbs;
		}
	}

	function content () {
		return $this->properties["text"];
	}

	function menus () {

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
			$menu_res[$menus["id"]]=$menu;
			unset($menu);unset($i);unset($menuNodes);
		}
		return $menu_res;

	}

	function leftBar() {
		return "";
	}

	function rightBar() {
		return "";
	}

	function contentTitle() {
		if ($this->properties["id"]>1) $contentTitle="<h2 class=\"pagetitle\"\>".$this->properties["title"]."</h2>";
		return $contentTitle;
	}

	function title() {
		return $this->properties["title"];
	}

	function contentSubTitle() {
		if ($this->properties["subtitle"]) $contentSubTitle="<h1>".$this->properties["subtitle"]."</h1>";
		$contentSubTitle;
	}

	function authors() {
		return "";
	}

	function articles() {
		$res=$this->db->query("select id, title, subtitle, time from articles left join articles_chapters on articles.id=articles_chapters.article_id where chapter_id=".$this->properties["id"]." order by time desc");
		while ($data=$this->db->fetch_array($res)) {
			$articles="<li>".$data["title"]."</li>";
		}
		if ($articles) return "<ul>$articles</ul>";
	}

	function style () {
		if (file_exists(page::getDocumentRoot()."/images/bottom/w".$this->properties["id"].".gif")) {
			$style[1]="background: url(/images/bottom/w".$this->properties["id"].".gif) bottom right no-repeat;";
			$style[2]=" url(/images/bottom/w".$this->properties["id"].".gif) bottom right no-repeat";
		}
		if (file_exists(page::getDocumentRoot()."/images/bottom/w".$this->properties["id"]."_.gif")) {
			$style[3]=" style=\"background: url(/images/bottom/w".$this->properties["id"]."_.gif) bottom right no-repeat;\"";
		}
		return $style;
	}

	function time() {
		return "";
	}

	function keywords() {
		return $this->properties["keywords"];
	}

	function description() {
		return $this->properties["description"];
	}

	function getmicrotime(){ 
    list($usec, $sec) = explode(" ",microtime()); 
    return ((float)$usec + (float)$sec); 
  }

}
?>
