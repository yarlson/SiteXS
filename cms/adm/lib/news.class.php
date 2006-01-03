<?php
class news {

	function news () {
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
		$pagination=new pagination ("?chid=".$this->chid."&", $this->page, $adminConfig["recPerPage"], '', "news", "id");
		$res=$db->query("select id, time, title from news order by id desc ".$pagination->limit());
		$page =($this->page) ? "&page=".$this->page : "";
		while($data=$db->fetch_array($res)) {
			$data["date"]=($data["time"]) ? @date("d.m.Y", $data["time"]) : "";
			eval('$newsTR.="'.admin::template("newsTR").'";');
		}
		
		$pageBar=$pagination->bar();
		
		eval('$content="'.admin::template("newsMain").'";');
		$this->elements["content"]=$content;
	}

	function add() {
		$select=admin::getDateSelectOptions();
		$chid=$this->chid;
		$action="appendAdd";
		$header="Добавление";
		eval("\$content=\"".admin::template("newsAdd", "FORMPOST", array("fields[title]"=>"EXISTS"))."\";");
		$this->elements["content"]=$content;
	}

	function appendAdd () {
		$this->fields["time"]=mktime(0, 0, 0, $this->date["month"], $this->date["day"], $this->date["year"]);
		foreach($this->fields as $key => $value) {
			$query.="$key='$value', ";
		}
		$query=substr($query, 0, strlen($s)-2);
		$db=new sql;
		$db->connect();
		$db->query("insert into news set $query");
		header("Location: ?chid=".$this->chid."&m=1");
	}

	function delete () {
		if ($this->id) {
			$db=new sql;
			$db->connect();
			$db->query("delete from news where id =".$this->id);
		}
		header("Location: ?chid=".$this->chid."&m=2");
	}

	function edit() {
		$db=new sql;
		$db->connect();
		$res=$db->query("select * from news where id=".$this->id);
		$data=$db->fetch_array($res);
		$data["text"]=htmlspecialchars($data["text"]);
		$select=admin::getDateSelectOptions($data["time"]);
		$chid=$this->chid;
		$action="appendEdit";
		$header="Редактирование";
		eval("\$content=\"".admin::template("newsAdd", "FORMPOST", array("fields[title]"=>"EXISTS"))."\";");
		$this->elements["content"]=$content;
	}

	function appendEdit () {
		$this->fields["time"]=mktime(0, 0, 0, $this->date["month"], $this->date["day"], $this->date["year"]);
		foreach($this->fields as $key => $value) {
			$query.="$key='$value', ";
		}
		$query=substr($query, 0, strlen($s)-2);
		$db=new sql;
		$db->connect();
		$db->query("update news set $query where id=".$this->fields["id"]);
		header("Location: ?chid=".$this->chid."&m=3");
	}

}
?>