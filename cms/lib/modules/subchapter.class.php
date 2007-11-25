<?php
class subchapter {

	function subchapter ($url, $query, $id) {
		$this->id=$id;
	}

	function leftBar() {
		$this->db=new sql;
		$this->db->connect();
		$this->elements["leftBar"].=$this->_tree($this->id, "");
		if ($this->elements["leftBar"]) $this->elements["leftBar"]="<h2>Рубрики</h2>".$this->elements["leftBar"];
		$res=$this->db->query("select id, time, title, url from chapters where pid=".$this->id." and type=3 order by sortorder");
		$data=$this->db->fetch_array($res);
		if ($data["id"]) {
			$block="<h2>Последний выпуск</h2><table cellspacing=\"0\" cellpadding=\"5\" width=\"100%\"><tr><th><span class=\"thedate\">[".date("d.m.y", $data["time"])."]</span> <a href=\"$data[url]/\">".$data["title"]."</a></th></tr><tr><td><ul>";
			$res1=$this->db->query("select time, article, title, subtitle, url from chapters where pid=".$data["id"]." and type=4 order by sortorder");
			while($data1=$this->db->fetch_array($res1)) {
				$res2=$this->db->query("select lastname, firstname from library_authors left join authors on library_authors.author=authors.id where library=".$data1["article"]);
				while($data2=$this->db->fetch_array($res2)) {
					$authors.=trim($data2["firstname"]." ".$data2["lastname"]).", ";
				}
				$authors=preg_replace("', $'", "", $authors);
				$block.="<li><span class=\"thedate\">[".date("d.m.y", $data1["time"])."]</span> $authors: <a href=\"$data[url]/$data1[url]/\">".$data1["title"]."</a><div>".$data1["subtitle"]."</div></li>";
				$authors="";
			}
			$block.="</ul></td></tr></table>";
		}
		
		while($data=$this->db->fetch_array($res)) {
			$blocks.="<li><span class=\"thedate\">[".date("d.m.y", $data["time"])."]</span> <a href=\"$data[url]/\">".$data["title"]."</a></li>";
		}
		if ($blocks) $blocks="<br><h2>Другие выпуски</h2><ul>".$blocks."</ul><br>&nbsp;";
		if ($blocks || $block) $this->elements["leftBar"].="<h1>Выпуски</h1>".$block.$blocks;
		if ($this->elements["leftBar"]) $this->elements["leftBar"]="<td width=\"30%\" valign=\"top\" id=\"leftBar\">".$this->elements["leftBar"]."</td>";
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