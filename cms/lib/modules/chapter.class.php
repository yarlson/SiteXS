<?php
class chapter {

	function chapter ($url, $query, $id) {
		$this->id=$id;
	}

	function leftBar() {
		$this->db=new sql;
		$this->db->connect();
		$this->elements["leftBar"].=$this->_tree($this->id, "");
		if ($this->elements["leftBar"]) $this->elements["leftBar"]="<td width=\"30%\" valign=\"top\" id=\"leftBar\"><h2>Рубрики</h2><br>".$this->elements["leftBar"]."</td>";
	}

	function _tree($id, $url) {
		$res=$this->db->query("select id, pid, title, url from chapters where pid=$id and type=2 order by sortorder");
		if ($this->db->num_rows($res)) {
			$tree="<ul>";
			while ($data=$this->db->fetch_array($res)) {
				$curUrl=$url.$data["url"]."/";
				$tree.="<li><a href=\"$curUrl\">".$data["title"]."</a>".$this->_tree($data["id"], $curUrl)."</li>";
			}
			$tree.="</ul>";
		}
		return $tree;
	}
}
?>