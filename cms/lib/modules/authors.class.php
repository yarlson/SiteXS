<?php
class authors {

	function authors ($url, $query, $id) {
		$this->db=new sql;
		$this->url=$url;
		if ($this->url) {
			$this->dirs=explode("/", preg_replace("'^\/|\/$'", "", $url));
		}
	}

	function content() {
		if ($this->url) {
			$this->db->connect();
			$res=$this->db->query("select * from authors where url='".$this->dirs[0]."'");
			$this->properties=$this->db->fetch_array($res);
			$this->elements["content"]="<table><tr>";
			$this->elements["content"].=($this->properties["img"]) ? "<td class=\"authorimg\" valign=\"top\">".$this->properties["img"]."</td>\n" : "";
			$this->elements["content"].="<td valign=\"top\" wodth=\"100%\">";
			$this->elements["content"].=($this->properties["jobtitle"]) ? "<p class=\"jobtitle\"><h4>Должность:</h4> ".$this->properties["jobtitle"]."</p>\n" : "";
			$this->elements["content"].=($this->properties["regalia"]) ? "<p class=\"regalia\"><h4>Звания:</h4> ".$this->properties["regalia"]."</p>\n" : "";
			$this->elements["content"].=($this->properties["bio"]) ? "<p class=\"bio\"><h4>Биография:</h4> ".$this->properties["bio"]."</p>\n" : "";
			$this->elements["content"].=($this->properties["publishedworks"]) ? "<p class=\"publishedworks\"><h4>Опубликованные работы:</h4> ".$this->properties["publishedworks"]."</p>\n" : "";
			$this->elements["content"].="</td></tr></table>";
		}
		else {
			$this->db->connect();
			$res=$this->db->query("select * from authors order by lastname, firstname, secondname");
			while ($data=$this->db->fetch_array($res)) {
				$en=$data["lastname_en"].(($data["lastname_en"]) ? " " : "").$data["firstname_en"];
				$en=($en) ? " (".$en.")" : "";
				$this->elements["content"].="<li><a href=\"$data[url]/\">$data[lastname] $data[firstname]</a>$en</li>";
			}
			$this->elements["content"]="<ul>".$this->elements["content"]."</ul>";
		}
	}

	function breadCrumbs () {
		if ($this->properties["lastname"]) {
			$this->elements["breadCrumbs"]=$this->properties["lastname"];
		}
	}

	function contentTitle() {
		$en=$this->properties["lastname_en"].(($this->properties["lastname_en"]) ? " " : "").$this->properties["firstname_en"];
		$en=($en) ? " (".$en.")" : "";
		if ($this->url) $this->elements["contentTitle"]="<h1>".($this->properties["lastname"].(($this->properties["firstname"]) ? " ".$this->properties["firstname"] : "").(($this->properties["secondname"]) ? " ".$this->properties["secondname"] : ""))."$en</h1>";
	}

	function _error404() {
		return ((count($this->properties)<=1 && $this->url) || count($this->dirs)>1) ? true : false;
	}
}
?>