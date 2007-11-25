<?php
class articles {

	function articles ($url, $query, $id, &$elements) {
		$this->id=$id;
		$this->db=new sql;
		$this->db->connect();
		$this->parElements=$elements;
	}

	function leftBar() {
		return "";
	}

	function content() {
		$res=$this->db->query("select library.text as ltext, article from library left join chapters on library.id=chapters.article where chapters.id=".$this->id);
		$data=$this->db->fetch_array($res);
		$this->elements["content"]=$data["ltext"];
		$this->article=$data["article"];
	}

	function authors() {
		$res=$this->db->query("select url, lastname, firstname from library_authors left join authors on library_authors.author=authors.id where library=".$this->article);
		while($data=$this->db->fetch_array($res)) {
			$authors.="<a href=\"/authors/$data[url]/\">".trim($data["firstname"]." ".$data["lastname"])."</a>, ";
		}
		$authors=preg_replace("', $'", "", $authors);
		if ($authors) $this->elements["authors"]="<div id=\"print\"><a href=\"?version=forprint\" target=\"_blank\"><img src=\"/i/print.gif\" alt=\"\" width=\"16\" height=\"14\" border=\"0\" align=\"absmiddle\" hspace=\"3\">Версия для печати</a></div><div class=\"author\">".$authors."</div>";
	}

	function time() {
		$this->elements["time"]="<div class=\"thedate1\">Опубликовано на сайте: ".date("d.m.Y", $this->parElements["time"])."</div>";
	}

}
?>