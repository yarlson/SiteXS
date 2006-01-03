<?php
class index {

	function index ($url, $query, $id) {
		$this->id=$id;
	}

	function rightBar() {
		$db=new sql;
		$db->connect();
		$res=$db->query(" select * from news order by time desc limit 0, 3");
		while ($data=$db->fetch_array($res)) {
			$this->elements["rightBar"].='<table><tr><th>'.$data["title"].':</th></tr><tr><td>'.$data["text"].'</td></tr></table>';
		}
		$this->elements["rightBar"]='<td valign="top" style="padding-left: 1em;">'.$this->elements["rightBar"].'<p align="right"><a href="/news/">¬се новости &rarr;</a></p><br><i>¬ принципе, вы можете зайти и ознакомитьс€ с <a href="/timeline/" target="_self">хронологией моих работ</a> (благо, их пока не так уж много).</i><p align="right"><a href="/card/" target="_self"> арта сайта &rarr;</a></p></td>';
	}

	function content() {
	}

}
?>