<?php
class conf {

	var $chid;
	var $POST;
	var $db;

	function conf() {
		global $HTTP_GET_VARS, $HTTP_POST_VARS;
		$this->chid=$HTTP_GET_VARS["chid"];
		$this->POST=$HTTP_POST_VARS;
		$this->db=new sql;
		$this->db->connect();
	}

	function defaultAction () {
		$chid=$this->chid;
		$res=$this->db->query("select * from config");
		while ($data=$this->db->fetch_array($res)) eval('$confItem.="'.admin::template("confItem").'";');
		$chid=$this->chid;
		eval('$conf="'.admin::template("conf").'";');
		$this->elements["content"]=$conf;
	}

	function append () {
		foreach ($this->POST as $key => $value) {
			$this->db->query("UPDATE config SET text='".trim($value)."' where name='".$key."'");
		}
		header("Location: ?chid=".$this->chid);
	}

	function addParam() {
		$chid=$this->chid;
		extract($this->POST);
		eval('$conf="'.admin::template("confNew", "param", array("name"=>"EXISTS", "descr"=>"EXISTS")).'";');
		$this->elements["content"]=$conf;
	}

	function addParamAppend () {
		$res=$this->db->query("select * from config where name='".$this->POST["name"]."'");
		if ($this->db->num_rows($res)) {
			$name=$this->POST["name"]; unset($this->POST["name"]);
			$this->addParam();
			$this->POST["name"]=$name;
			$this->elements["content"]=admin::showWarnings("Параметр с <b>названием переменной&nbsp;&mdash; ".$this->POST["name"]."</b> существует!").$this->elements["content"];
		}
		else {
			$this->db->query("INSERT INTO config (name, descr, text) values ('".$this->POST["name"]."', '".$this->POST["descr"]."', '".$this->POST["text"]."')");
			$this->defaultAction();
			$this->elements["content"]=admin::showMessage("Параметр \"<b>".$this->POST["descr"]."</b>\" успешно добавлен").$this->elements["content"];
		}
	}

}

?>