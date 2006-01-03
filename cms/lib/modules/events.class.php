<?php
class events {

	function events ($url, $query, $id) {
		$this->db=new sql;
		$this->query=$query;
		$this->url=$url;
		$this->ruMonths=array("1"=>"€нварь", "февраль", "март", "апрель", "май", "июнь", "июль", "август", "сент€брь", "окт€брь", "но€брь", "декабрь");
		if ($this->url) {
			$this->dirs=explode("/", preg_replace("'^\/|\/$'", "", $url));
		}
	}

	function _tree($id, $url) {
		$this->db->connect();
		$res=$this->db->query("SELECT DISTINCT DATE_FORMAT(FROM_UNIXTIME(time),\"%Y\") as year FROM `events` ORDER BY year DESC");
		while ($data=$this->db->fetch_array($res)) {
			$res1=$this->db->query("SELECT DISTINCT DATE_FORMAT(FROM_UNIXTIME(time),\"%c\") as month FROM `events` where DATE_FORMAT(FROM_UNIXTIME(time),\"%Y\")='".$data["year"]."' ORDER BY month DESC");
			while ($data1=$this->db->fetch_array($res1)) {
				if ($data["year"]==$this->dirs[0] && $data1["month"]==$this->dirs[1])
					$month.="<li><b>".$this->ruMonths[$data1["month"]]."</b></li>\n";
				else
					$month.="<li><a href=\"/events/$data[year]/$data1[month]/\">".$this->ruMonths[$data1["month"]]."</a></li>\n";
			}
			if ($month) $month="<ul>$month</ul>\n";
			if ($data["year"]==$this->dirs[0] && !$this->dirs[1])
				$tree.="<li><span><b>".$data["year"]."</b></span>$month</li>\n";
			else
				$tree.="<li><a href=\"/events/$data[year]/\">".$data["year"]."</a></span>$month</li>\n";
			$month="";
		}
		if ($tree) $tree="<ul id=\"date\">$tree</ul>";
		return $tree;
	}

	function content() {
		if ($this->url) {
			$this->db->connect();
			if ($this->dirs[1]) $where=" and DATE_FORMAT(FROM_UNIXTIME(time),\"%c\")='".$this->dirs[1]."'";
			$res=$this->db->query("select * from (events left join events_types on events.type=events_types.type_id) left join events_formats on events.format=events_formats.format_id where DATE_FORMAT(FROM_UNIXTIME(time),\"%Y\")='".$this->dirs[0]."'$where order by time desc");
			while ($data=$this->db->fetch_array($res)) {
				$count=!$count;
				if ($count) $color="#F0F0F0";
				else $color="#FFFFFF";
				$data["date"]=date("d.m.Y", $data["time"]);
				eval('$eventsTR.="'.page::template("modules/eventsTR").'";');
				$data1=$data;
			}
			$this->properties["year"]=$data1["year"];
			if ($this->dirs[1]) {
				$this->properties["month"]=$data1["month"];
				$this->properties["ruMonth"]=$this->ruMonths[$data1["month"]];
			}
		}
		elseif ($this->query) {
			parse_str($this->query, $query);
			if ($query["action"]=="edit") {
				$eventsTR="<tr><td>!</td></tr>";
			}
		}
		else {
			$this->db->connect();
			$res=$this->db->query("select * from (events left join events_types on events.type=events_types.type_id) left join events_formats on events.format=events_formats.format_id order by time desc");
			while ($data=$this->db->fetch_array($res)) {
				$count=!$count;
				if ($count) $color="#F0F0F0";
				else $color="#FFFFFF";
				$data["date"]=date("d.m.Y", $data["time"]);
				eval('$eventsTR.="'.page::template("modules/eventsTR").'";');
			}
		}
		$_SESSION["HTTP_REFERER"]="";
		if ($query["action"]=="edit") {
			$header="–едактирование";
			$_SESSION["HTTP_REFERER"]=$_SERVER["HTTP_REFERER"];
			$action="edit";
			$this->db->connect();
			$res=$this->db->query("select * from events where id=$query[id]");
			$data=$this->db->fetch_array($res);
			$data["date"]=date("d.m.Y H:i", $data["time"]);
			if ($data["time_end"]>0) $data["date_end"]=date("d.m.Y H:i", $data["time_end"]);
			
			$res_type=$this->db->query("select * from events_types order by type_name");
			while ($type=$this->db->fetch_array($res_type)) {
				$select_type.="<option value=\"".$type["type_id"]."\"".(($data["type"]==$type["type_id"]) ? " selected" : "").">".$type["type_name"]."</option>";
			}
			
			$res_format=$this->db->query("select * from events_formats order by format_name");
			while ($format=$this->db->fetch_array($res_format)) {
				$select_format.="<option value=\"".$format["format_id"]."\"".(($data["format"]==$format["format_id"]) ? " selected" : "").">".$format["format_name"]."</option>";
			}
			$data["text"]=str_replace("<br>", "\r", $data["text"]);
			$data["place"]=str_replace("<br>", "\r", $data["place"]);
			eval('$content="'.page::template("modules/eventsAdd").'";');
		}
		elseif ($query["action"]=="add") {
			$header="ƒобавление";
			$_SESSION["HTTP_REFERER"]=$_SERVER["HTTP_REFERER"];
			$action="add";
			$this->db->connect();
			$data["date"]=date("d.m.Y H:i:s", time());
						
			$res_type=$this->db->query("select * from events_types order by type_name");
			while ($type=$this->db->fetch_array($res_type)) {
				$select_type.="<option value=\"".$type["type_id"]."\"".(($data["type"]==$type["type_id"]) ? " selected" : "").">".$type["type_name"]."</option>";
			}
			
			$res_format=$this->db->query("select * from events_formats order by format_name");
			while ($format=$this->db->fetch_array($res_format)) {
				$select_format.="<option value=\"".$format["format_id"]."\"".(($data["format"]==$format["format_id"]) ? " selected" : "").">".$format["format_name"]."</option>";
			}
			$data["add_person"]=$_SESSION["user"];
			eval('$content="'.page::template("modules/eventsAdd", "FORMPOST", array("fields[name]"=>"EXISTS")).'";');
		}
		else {
			eval('$content="'.page::template("modules/eventsMain").'";');
		}
		$this->elements["content"]=$content;
	}


	function breadCrumbs () {
		if ($this->properties["year"]) {
			$this->elements["breadCrumbs"]="&nbsp;<img src=\"/i/rarr.gif\" alt=\"\" width=\"9\" height=\"20\" border=\"0\" align=\"absmiddle\">&nbsp;".$this->properties["year"].(($this->properties["month"]) ? " ".$this->properties["ruMonth"] : "");
		}
	}

	function contentTitle() {
		if ($this->dirs[0]) $this->elements["contentTitle"]="<h2>".$this->properties["year"].(($this->properties["month"]) ? " ".$this->properties["ruMonth"] : "")."</h2>";
	}

	function _error404() {
		return ((count($this->properties)<1 && $this->url) || count($this->dirs)>2) ? true : false;
	}

	function _POST($POST) {
		if ($POST["action"]=="add" || $POST["action"]=="edit") {
			$POST["fields"]["time"]=$this->_get_time($POST["fields"]["time"]);
			$POST["fields"]["time_end"]=$this->_get_time($POST["fields"]["time_end"]);
			foreach($POST["fields"] as $key => $value) {
				$value=str_replace("\r", "<br>", $value);
				$value=str_replace("\n", "", $value);
				$query.="$key='$value', ";
			}
			$query=substr($query, 0, strlen($s)-2);
			$db=new sql;
			$db->connect();
		}
		if ($POST["action"]=="add") {
			$db->query("insert into events set $query");
			header("Location: ".$_SESSION["HTTP_REFERER"]);
		}
		else {
			$db->query("update events set $query where id=".$POST["fields"]["id"]);
			header("Location: /events/?action=edit&id=".$POST["fields"]["id"]);
		}
	}

	function _get_time($str_time) {
		preg_match("'(\d{1,2})\.(\d{1,2})\.(\d{1,4})( |)(\d{0,2})(:|)(\d{0,2})(:|)(\d{0,2})'", $str_time, $result);
		//print_r($result);
		return mktime($result[5], $result[7], $result[9], $result[2], $result[1], $result[3]);
	}

}
?>