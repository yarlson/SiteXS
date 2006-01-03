<?php
class photos {

	function photos() {
		$this->db=new sql;
	}

	function content() {
		$this->db->connect();
		$res=$this->db->query("select url, title from chapters where pid=48");
		 while($data=$this->db->fetch_array($res)) {
		 	$this->elements["content"].="<a href=\"$data[url]/\">$data[title]</a>";
		 }
	}
}
?>
