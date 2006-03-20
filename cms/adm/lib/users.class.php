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
		while ($this->data=$this->db->fetch_array($res)) {
			$this->i++;
			$this->im=($this->data["admin"]) ? "<img src=\"i/bull2.gif\" alt=\"\" width=\"16\" height=\"16\" hspace=\"6\" border=\"0\">" : "";
			$this->usersTR.=admin::template("usersTR", $this);
		}
		$chid=$this->chid;
		$users=admin::template("usersMain", $this);
		$this->elements["content"]=$users;
	}

	function add() {
		$this->chid=$this->chid;
		$this->action="appendAdd";
		$this->header="Add";
		$this->elements["content"]=admin::template("usersAdd", $this);
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
		$this->data=$db->fetch_array($res);
		$this->data["description"]=htmlspecialchars($this->data["description"]);
		$chid=$this->chid;
		$this->action="appendEdit";
		$id='<tr>
			<td>¹</td>
			<td><input maxlength="14" name="fields[id]" size="14" value="'.$this->id.'" readonly="readonly" style="width: auto;" value="'.$this->id.'"></td>
		</tr>';
		$this->header="Edit";
		$this->elements["content"]=admin::template("usersEdit", $this);
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