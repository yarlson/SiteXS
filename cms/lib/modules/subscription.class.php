<?php
class news {

	function news ($url, $query, $id) {
		$this->db=new sql;
		$this->url=$url;
		if ($this->url) {
			$this->dirs=explode("/", preg_replace("'^\/|\/$'", "", $url));
		}
	}

	function leftBar() {
		$this->db=new sql;
		$this->db->connect();
		$this->elements["leftBar"].=$this->_tree($this->id, "");
		if ($this->elements["leftBar"]) $this->elements["leftBar"]="<td width=\"20%\" valign=\"top\" id=\"leftBar\">".$this->elements["leftBar"]."</td>";
	}

	function _tree($id, $url) {
		$this->db->connect();
		$res=$this->db->query("SELECT DISTINCT DATE_FORMAT(FROM_UNIXTIME(time),\"%Y\") as year FROM `news` ORDER BY year DESC");
		while ($data=$this->db->fetch_array($res)) {
			$res1=$this->db->query("SELECT DISTINCT DATE_FORMAT(FROM_UNIXTIME(time),\"%c\") as month FROM `news` where DATE_FORMAT(FROM_UNIXTIME(time),\"%Y\")='".$data["year"]."' ORDER BY month DESC");
			while ($data1=$this->db->fetch_array($res1)) {
				if ($data["year"]==$this->dirs[0] && $data1["month"]==$this->dirs[1])
					$month.="<li><b>".$this->ruMonths[$data1["month"]]."</b></li>\n";
				else
					$month.="<li><a href=\"/news/$data[year]/$data1[month]/\">".$this->ruMonths[$data1["month"]]."</a></li>\n";
			}
			if ($month) $month="<ul>$month</ul>\n";
			$tree.="<li><span>&nbsp;&nbsp;".$data["year"]."&nbsp;&nbsp;</span>$month</li>\n";
			$month="";
		}
		if ($tree) $tree="<ul id=\"date\">$tree</ul>";
		return $tree;
	}

	function content() {
		if ($this->url) {
			$this->db->connect();
			if ($this->dirs[1]) $where=" and DATE_FORMAT(FROM_UNIXTIME(time),\"%c\")='".$this->dirs[1]."'";
			$res=$this->db->query("select *, DATE_FORMAT(FROM_UNIXTIME(time),\"%Y\") as year, DATE_FORMAT(FROM_UNIXTIME(time),\"%c\") as month from news where DATE_FORMAT(FROM_UNIXTIME(time),\"%Y\")='".$this->dirs[0]."'$where");
			while ($data=$this->db->fetch_array($res)) {
				$this->elements["content"].="<p style=\"margin-bottom: 0.5em;\"><span class=\"date\">&nbsp;&nbsp;".date("d.m.Y", $data["time"])."&nbsp;&nbsp;</span>&nbsp; <b>".$data["title"]."</b></p>\n".$data["text"];
				$data1=$data;
			}
			$this->properties["year"]=$data1["year"];
			if ($this->dirs[1]) {
				$this->properties["month"]=$data1["month"];
				$this->properties["ruMonth"]=$this->ruMonths[$data1["month"]];
			}
		}
		else {
			$this->db->connect();
			$res=$this->db->query("select * from news order by time desc limit 0,5");
			while ($data=$this->db->fetch_array($res)) {
				$data["date"]=date("d.m.Y", $data["time"]);
				$this->elements["content"].="<p style=\"margin-top: 0.5em;margin-bottom: 0.5em;\"><span class=\"date\">&nbsp;&nbsp;".date("d.m.Y", $data["time"])."&nbsp;&nbsp;</span>&nbsp; <b>".$data["title"]."</b></p>\n".$data["text"]."<br><br>";
			}
		}
	}


	function breadCrumbs () {
		if ($this->properties["year"]) {
			$this->elements["breadCrumbs"]=$this->properties["year"].(($this->properties["month"]) ? " ".$this->properties["ruMonth"] : "");
		}
	}

	function contentTitle() {
		if ($this->dirs[0]) $this->elements["contentTitle"]="<h2>".$this->properties["year"].(($this->properties["month"]) ? " ".$this->properties["ruMonth"] : "")."</h2>";
	}

	function _error404() {
		return ((count($this->properties)<1 && $this->url) || count($this->dirs)>2) ? true : false;
	}

}
?>