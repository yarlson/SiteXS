<?php
class authors {

	function authors () {
		global $HTTP_GET_VARS, $HTTP_POST_VARS, $HTTP_SERVER_VARS;
		$this->chid=$HTTP_GET_VARS["chid"];
		$this->id=$HTTP_GET_VARS["id"];
		$this->message=$HTTP_GET_VARS["m"];
		$this->fields=$HTTP_POST_VARS["fields"];
		$this->host=$HTTP_SERVER_VARS["HTTP_HOST"];
	}

	function defaultAction () {
		$db=new sql;
		$db->connect();
		$chid=$this->chid;
		$res=$db->query("select id, firstname, secondname, lastname from authors order by lastname, firstname, secondname");
		while($data=$db->fetch_array($res)) {
			$i++;
			$data["fio"]=$data["lastname"].(($data["firstname"]) ? " ".$data["firstname"] : "").(($data["secondname"]) ? " ".$data["secondname"] : "");
			eval('$authorsTR.="'.admin::template("authorsTR").'";');
		}
		eval('$content="'.admin::template("authorsMain").'";');
		$this->elements["content"]=$content;
	}

	function add() {
		for ($i=1900; $i<2005; $i++) {
			$birth_year_options.="\n\t\t\t\t\t<option value=\"$i\">$i</option>\n";
		}
		$chid=$this->chid;
		$action="appendAdd";
		$header="Добавление";
		$data["img"]="<img src=\"i/dot.gif\" alt=\"\" width=\"1\" height=\"1\" border=\"0\" vspace=\"0\" hspace=\"0\" name=\"photo\">";
		eval("\$content=\"".admin::template("authorsAdd", "FORMPOST", array("fields[lastname]"=>"EXISTS", "fields[url]"=>"EXISTS"))."\";");
		$this->elements["content"]=$content;
	}

	function appendAdd () {
		$this->fields["img"]=str_replace("http://".$this->host,"",$this->fields["img"]);
		foreach($this->fields as $key => $value) {
			$query.="$key='".addslashes($value)."', ";
		}
		$query=substr($query, 0, strlen($s)-2);
		$db=new sql;
		$db->connect();
		$db->query("insert into authors set $query");
		header("Location: ?chid=".$this->chid."&m=1");
	}

	function delete () {
		if ($this->id) {
			$db=new sql;
			$db->connect();
			$db->query("delete from authors where id =".$this->id);
			$db->query("delete from library_authors where author=".$this->id);
		}
		header("Location: ?chid=".$this->chid."&m=2");
	}

	function edit() {
		$db=new sql;
		$db->connect();
		$res=$db->query("select * from authors where id=".$this->id);
		$data=$db->fetch_array($res);
		$fio=$data["lastname"].(($data["firstname"]) ? " ".$data["firstname"] : "").(($data["secondname"]) ? " ".$data["secondname"] : "");
		for ($i=1900; $i<2005; $i++) {
			$birth_year_options.="\n\t\t\t\t\t<option value=\"$i\"".(($data["birthyear"]==$i) ? " selected" : "").">$i</option>\n";
		}
		$data["img"]=($data["img"]) ? str_replace(" src=\"/", " src=\"http://".$this->host."/", $data["img"]) : "<img src=\"i/dot.gif\" alt=\"\" width=\"1\" height=\"1\" border=\"0\" vspace=\"0\" hspace=\"0\" name=\"photo\">";
		$chid=$this->chid;
		$action="appendEdit";
		$id='<tr>
			<td>№</td>
			<td><input maxlength="14" name="fields[id]" size="14" value="'.$this->id.'" readonly="readonly" style="width: auto;" value="'.$this->id.'"></td>
		</tr>';
		$header="Редактирование";
		eval("\$content=\"".admin::template("authorsAdd", "FORMPOST", array("fields[lastname]"=>"EXISTS", "fields[url]"=>"EXISTS"))."\";");
		$this->elements["content"]=$content;
	}

	function appendEdit () {
		foreach($this->fields as $key => $value) {
			$query.="$key='".addslashes($value)."', ";
		}
		$query=substr($query, 0, strlen($s)-2);
		$db=new sql;
		$db->connect();
		$db->query("update authors set $query where id=".$this->fields["id"]);
		header("Location: ?chid=".$this->chid."&m=3");
	}

	function showAuthorSelectJS () {
		$db=new sql;
		$db->connect();
		$res=$db->query("select id, firstname, secondname, lastname from authors order by lastname, firstname, secondname");
		while($data=$db->fetch_array($res)) {
			$i++;
			$chid=$this->chid;
			$data["fio"]=$data["lastname"].(($data["firstname"]) ? " ".$data["firstname"] : "").(($data["secondname"]) ? " ".$data["secondname"] : "");
			eval('$authorsJSline.="'.admin::template("authorsJSline").'";');
		}
		eval('$content="'.admin::template("authorsJS").'";');
		echo $content;
	}
}
?>