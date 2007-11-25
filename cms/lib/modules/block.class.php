<?php
class block {
	function block ($url, $query, $id) {
		$this->id=$id;
		$this->url=$url;
	}

	function content() {
		$this->db=new sql;
		$this->db->connect();
		$res1=$this->db->query("select article, title, subtitle, url from chapters where pid=".$this->id." and type=4 order by sortorder");
		while($data1=$this->db->fetch_array($res1)) {
			$res2=$this->db->query("select lastname, firstname from library_authors left join authors on library_authors.author=authors.id where library=".$data1["article"]);
			while($data2=$this->db->fetch_array($res2)) {
				$authors.=trim($data2["firstname"]." ".$data2["lastname"]).", ";
			}
			$authors=preg_replace("', $'", "", $authors);
			$block.="<li>$authors: <a href=\"$data1[url]/\">".$data1["title"]."</a><div>".$data1["subtitle"]."</div></li>";
			$authors="";
		}
		$block.="</ul></td></tr></table>";
		
		$this->elements["content"]=$block;
	}
}
?>