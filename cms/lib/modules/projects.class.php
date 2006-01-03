<?php
class projects {

	function projects ($url, $query, $id) {
		$this->db=new sql;
	}

	function content() {
		$this->db->connect();
		$res=$this->db->query("select * from projects order by id");
		while ($data=$this->db->fetch_array($res)) {
			$this->elements["content"].="<li style=\"margin-top: 1em; margin-bottom: 1em;\"><a href=\"$data[url]\">".$data["title"]."</a> ".(($data["period"]) ? "(".$data["period"].")" : "").(($data["text"]) ? "<p>".$data["text"]."</p>" : "")."</li>";
		}
	}

}
?>