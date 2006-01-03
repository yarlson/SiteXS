<?php
class users {

	var $chid;
	var $POST;
	var $db;

	function users() {
		global $HTTP_GET_VARS, $HTTP_POST_VARS;
		$this->id=$HTTP_GET_VARS["id"];
		$this->chid=$HTTP_GET_VARS["chid"];
		$this->fields=$HTTP_POST_VARS["fields"];
		$this->confirm=$HTTP_POST_VARS["confirm"];
		$this->db=new sql;
		$this->db->connect();
	}

	function defaultAction () {
		$chid=$this->chid;
		$res=$this->db->query("select * from users order by name");
		while ($data=$this->db->fetch_array($res)) {
			$i++;
			$im=($data["admin"]) ? "<img src=\"i/bull2.gif\" alt=\"\" width=\"16\" height=\"16\" hspace=\"6\" border=\"0\">" : "";
			eval('$usersTR.="'.admin::template("usersTR").'";');
		}
		$chid=$this->chid;
		eval('$users="'.admin::template("usersMain").'";');
		$this->elements["content"]=$users;
	}

	function add() {
		$chid=$this->chid;
		$action="appendAdd";
		$header="Добавление";
		eval("\$content=\"".admin::template("usersAdd", "FORMPOST", array("fields[login]"=>"EXISTS", "fields[pass]"=>"EXISTS", "fields[name]"=>"EXISTS", "confirm"=>"EQUAL fields[pass]", "fields[email]"=>"EMAIL"))."\";");
		$this->elements["content"]=$content;
	}

	function appendAdd () {
		$this->fields["pass"]=md5($this->fields["pass"]);
		foreach($this->fields as $key => $value) {
			$query.="$key='$value', ";
		}
		$query=substr($query, 0, strlen($s)-2);
		$db=new sql;
		$db->connect();
		$db->query("insert into users set $query");
		header("Location: ?chid=".$this->chid."&m=1");
	}

	function delete () {
		if ($this->id) {
			$db=new sql;
			$db->connect();
			$db->query("delete from users where id =".$this->id);
		}
		header("Location: ?chid=".$this->chid."&m=2");
	}

	function edit() {
		$db=new sql;
		$db->connect();
		$res=$db->query("select * from users where id=".$this->id);
		$data=$db->fetch_array($res);
		$data["description"]=htmlspecialchars($data["description"]);
		$chid=$this->chid;
		$action="appendEdit";
		$id='<tr>
			<td>№</td>
			<td><input maxlength="14" name="fields[id]" size="14" value="'.$this->id.'" readonly="readonly" style="width: auto;" value="'.$this->id.'"></td>
		</tr>';
		$header="Редактирование";
		eval("\$content=\"".admin::template("usersEdit", "FORMPOST", array("fields[login]"=>"EXISTS", "fields[name]"=>"EXISTS", "confirm"=>"EQUAL fields[pass]", "fields[email]"=>"EMAIL"))."\";");
		$this->elements["content"]=$content;
	}

	function appendEdit () {
		if ($this->fields["pass"]) $this->fields["pass"]=md5($this->fields["pass"]);
		else unset($this->fields["pass"]);
		foreach($this->fields as $key => $value) {
			$query.="$key='$value', ";
		}
		$query=substr($query, 0, strlen($s)-2);
		$db=new sql;
		$db->connect();
		$db->query("update users set $query where id=".$this->fields["id"]);
		header("Location: ?chid=".$this->chid."&m=3");
	}

}

?>