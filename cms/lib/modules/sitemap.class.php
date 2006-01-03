<?php
class sitemap {

	function sitemap() {
	}

	function content() {
		$this->elements["content"]=$this->_sel();
	}

	function _sel($id=0, $url="", $menu=0) {
		$db=new sql;
		$db->connect();
		if ($menu==1) $where=" and menu=1";
		else $where=" and menu!=1";
		$res=$db->query("select id, title, url from chapters where (pid=$id and url<>'searchresult' and url<>'sitemap' and type<>4 and id<>1)$where order by sortorder");
		if ($db->num_rows($res)>0) {
			$sel="<ul>";
			while ($data=$db->fetch_array($res)) {
				$str.=$data["title"];
				$url1=$url."/".$data["url"];
				$sel.="<li type=\"disc\"><a href=\"$url1/\">".$data["title"]."</a>\n";
				$sel.=$this->_sel($data["id"], $url1);
				$sel.="</li>\n";
			}
			$sel.="</ul>";
			return $sel;
		}
	}

}
?>