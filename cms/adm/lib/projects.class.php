<?php
class projects {

	function projects () {
		global $HTTP_GET_VARS, $HTTP_POST_VARS;
		$this->chid=$HTTP_GET_VARS["chid"];
		$this->id=$HTTP_GET_VARS["id"];
		$this->message=$HTTP_GET_VARS["m"];
		$this->fields=$HTTP_POST_VARS["fields"];
		$this->page=$HTTP_GET_VARS["page"];
		$this->date=$HTTP_POST_VARS["date"];
	}

	function defaultAction () {
		$db=new sql;
		$db->connect();
		
		$chid=$this->chid;
		
		include "lib/pagination.class.php";
		
		$adminConfig=admin::adminConfig();
		$pagination=new pagination ("?chid=".$this->chid."&", $this->page, $adminConfig["recPerPage"], '', "projects", "id");
		$res=$db->query("select id, name, company from projects order by id desc ".$pagination->limit());
		$page =($this->page) ? "&page=".$this->page : "";
		while($data=$db->fetch_array($res)) {
			$data["date"]=($data["time"]) ? @date("d.m.Y", $data["time"]) : "";
			eval('$projectsTR.="'.admin::template("projectsTR").'";');
		}
		
		$pageBar=$pagination->bar();
		
		eval('$content="'.admin::template("projectsMain").'";');
		$this->elements["content"]=$content;
	}

	function add() {
		$chid=$this->chid;
		$action="appendAdd";
		$header="Добавление";
		$data["date"]=date("d.m.Y");
		eval("\$content=\"".admin::template("projectsAdd", "FORMPOST", array("fields[name]"=>"EXISTS", "fields[company]"=>"EXISTS"))."\";");
		$this->elements["content"]=$content;
	}

	function appendAdd () {
		$this->fields["date"]=admin::toUnixTime($this->fields["date"]);
		
		$this->fields["name"]=str_replace('"', "&quot;", $this->fields["name"]);
		
		//$this->fields["min_begin"]=$this->_strToFloat($this->fields["min_begin"]);
		//$this->fields["max_begin"]=$this->_strToFloat($this->fields["max_begin"]);
		//$this->fields["min_current"]=$this->_strToFloat($this->fields["min_current"]);
		//$this->fields["max_current"]=$this->_strToFloat($this->fields["max_current"]);
		
		//$this->fields["square"]=$this->_strToFloat($this->fields["square"]);
		
		//$this->fields["end"]=admin::toUnixTime($this->fields["end"]);
		foreach($this->fields as $key => $value) {
			$query.="$key='$value', ";
		}
		$query=substr($query, 0, strlen($s)-2);
		$db=new sql;
		$db->connect();
		$db->query("insert into projects set $query");
		header("Location: ?chid=".$this->chid."&m=1");
	}

	function delete () {
		if ($this->id) {
			$db=new sql;
			$db->connect();
			$db->query("delete from projects where id =".$this->id);
		}
		header("Location: ?chid=".$this->chid."&m=2");
	}

	function edit() {
		$db=new sql;
		$db->connect();
		$res=$db->query("select * from projects where id=".$this->id);
		$data=$db->fetch_array($res);
		$data["date"]=date("d.m.Y", $data["date"]);
		//$data["end"]=date("d.m.Y", $data["end"]);
		$category_selected[$data["category"]]=" selected";
		$chid=$this->chid;
		$action="appendEdit";
		$header="Редактирование";
		eval("\$content=\"".admin::template("projectsAdd", "FORMPOST", array("fields[url]"=>"EXISTS", "fields[title]"=>"EXISTS"))."\";");
		$this->elements["content"]=$content;
	}

	function appendEdit () {
		$this->fields["date"]=admin::toUnixTime($this->fields["date"]);
		
		$this->fields["name"]=str_replace('"', "&quot;", $this->fields["name"]);
		
		//$this->fields["min_begin"]=$this->_strToFloat($this->fields["min_begin"]);
		//$this->fields["max_begin"]=$this->_strToFloat($this->fields["max_begin"]);
		//$this->fields["min_current"]=$this->_strToFloat($this->fields["min_current"]);
		//$this->fields["max_current"]=$this->_strToFloat($this->fields["max_current"]);
		
		//$this->fields["square"]=$this->_strToFloat($this->fields["square"]);
		//$this->fields["end"]=admin::toUnixTime($this->fields["end"]);
		foreach($this->fields as $key => $value) {
			$query.="$key='$value', ";
		}
		$query=substr($query, 0, strlen($s)-2);
		$db=new sql;
		$db->connect();
		$db->query("update projects set $query where id=".$this->fields["id"]);
		header("Location: ?chid=".$this->chid."&m=3");
	}

	function _strToFloat($string) {
		$string=str_replace("\$", "", $string);
		$string=str_replace(",", ".", $string);
		$string=str_replace(" ", "", $string);
		$string=(float)$string;
		return $string;
	}
}
?>