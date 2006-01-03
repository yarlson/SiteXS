<?php
class library {

	function library () {
		global $HTTP_GET_VARS, $HTTP_POST_VARS;
		$this->chid=$HTTP_GET_VARS["chid"];
		$this->id=$HTTP_GET_VARS["id"];
		$this->message=$HTTP_GET_VARS["m"];
		$this->field=$HTTP_GET_VARS["field"];
		$this->order=$HTTP_GET_VARS["order"];
		$this->page=$HTTP_GET_VARS["page"];
		$this->fields=$HTTP_POST_VARS["fields"];
		$this->author=$HTTP_POST_VARS["author"];
		$this->date=$HTTP_POST_VARS["date"];
	}

	function defaultAction () {
		$db=new sql;
		$db->connect();
		
		$chid=$this->chid;
		
		include "lib/pagination.class.php";
		include "lib/orderby.class.php";
		
		$adminConfig=admin::adminConfig();
		
		$orderBy=new orderBy("?chid=".$this->chid."&", array("library"=>"№", "time"=>"Дата", "name"=>"Заголовок", "short_text"=>"Подзаголовок", "author"=>"Автор"), array("library"=>"desc"),$this->field, $this->order);
		$pagination=new pagination ($orderBy->urlForPage(), $this->page, $adminConfig["recPerPage"], '', "library", "id");
		$res=$db->query("select library.id as library, name, short_text, time, authors.lastname as author FROM (library LEFT JOIN library_authors ON library.id = library_authors.library) LEFT JOIN authors ON library_authors.author = authors.id GROUP BY library.id".$orderBy->orderByQuery()." ".$pagination->limit());
		$page =($this->page) ? "&page=".$this->page : "";
		while($data=$db->fetch_array($res)) {
			$res1=$db->query("select id, firstname, secondname, lastname from library_authors left join authors on library_authors.author = authors.id where library_authors.library=".$data["library"]." order by lastname, firstname, secondname");
			$typeAuthorsID=admin::getTypeID("authors");
			while ($data1=$db->fetch_array($res1)) {
				$data["fio"].="<li><a href=\"?chid=$typeAuthorsID&action=edit&id=$data1[id]\">".$data1["lastname"].(($data1["firstname"]) ? " ".$data1["firstname"] : "").(($data1["secondname"]) ? " ".$data1["secondname"] : "")."</a></li>";
			}
			$data["date"]=($data["time"]) ? @date("d.m.Y", $data["time"]) : "";
			$data["fio"]=($data["fio"]) ? "<ul>".$data["fio"]."</ul>" : "";
			eval('$libraryTR.="'.admin::template("libraryTR").'";');
		}
		
		$pageBar=$pagination->bar();
		
		$th=$orderBy->bar();
		eval('$content="'.admin::template("libraryMain").'";');
		$this->elements["content"]=$content;
	}

	function add() {
		$select=admin::getDateSelectOptions();
		$chid=$this->chid;
		$action="appendAdd";
		$idSel=0;
		eval("\$authorsSel=\"".admin::template("authorsJSscr")."\";");
		$header="Добавление";
		eval("\$content=\"".admin::template("libraryAdd", "FORMPOST", array("fields[name]"=>"EXISTS"))."\";");
		$this->elements["content"]=$content;
	}

	function appendAdd () {
		$this->fields["time"]=mktime(0, 0, 0, $this->date["month"], $this->date["day"], $this->date["year"]);
		srand((double)microtime()*1000000);
		$this->fields["sid"]=md5 (uniqid (rand()));
		foreach($this->fields as $key => $value) {
			$query.="$key='$value', ";
		}
		$query.="ctime=".@time().", lmtime=".@time();
		$db=new sql;
		$db->connect();
		$db->query("insert into library set $query");
		$res=$db->query("select id from library where sid='".$this->fields["sid"]."'");
		$data=$db->fetch_array($res);
		if (is_array($this->author)) {
			foreach($this->author as $key => $value) {
				if ($value)	{
					$res=$db->query("select library from library_authors where library=".$data["id"]." and author=".$value);
					if (!$db->num_rows($res)) {
						$db->query("insert into library_authors set library=".$data["id"].", author=".$value);
					}
				}
			}
		}
		header("Location: ?chid=".$this->chid."&m=1");
	}

	function delete () {
		if ($this->id) {
			$db=new sql;
			$db->connect();
			$db->query("delete from library where id =".$this->id);
			$db->query("delete from library_authors where library =".$this->id);
		}
		header("Location: ?chid=".$this->chid."&m=2");
	}

	function edit() {
		$db=new sql;
		$db->connect();
		$res=$db->query("select * from library where id=".$this->id);
		$data=$db->fetch_array($res);
		$data["text"]=htmlspecialchars($data["text"]);
		$select=admin::getDateSelectOptions($data["time"]);
		$chid=$this->chid;
		$action="appendEdit";
		$id='<tr>
			<td>№</td>
			<td><input maxlength="14" name="fields[id]" size="14" value="'.$this->id.'" readonly="readonly" style="width: auto;" value="'.$this->id.'"></td>
		</tr>';
		$res1=$db->query("select library_authors.* from library_authors left join authors on library_authors.author=authors.id where library=".$this->id." order by firstname, secondname, lastname");
		$idSel=0;
		while($data1=$db->fetch_array($res1)) {
			$curSel=$data1["author"];
			eval("\$authorsSel.=\"".admin::template("authorsJSscr")."\";");
			$idSel++;
		}
		$curSel=0;
		eval("\$authorsSel.=\"".admin::template("authorsJSscr")."\";");
		$header="Редактирование";
		$page="&page=".$this->page;
		eval("\$content=\"".admin::template("libraryAdd", "FORMPOST", array("fields[name]"=>"EXISTS"))."\";");
		$this->elements["content"]=$content;
	}

	function appendEdit () {
		$this->fields["time"]=mktime(0, 0, 0, $this->date["month"], $this->date["day"], $this->date["year"]);
		foreach($this->fields as $key => $value) {
			$query.="$key='$value', ";
		}
		$query.="lmtime=".@time();
		$db=new sql;
		$db->connect();
		$db->query("update library set $query where id=".$this->fields["id"]);
		$db->query("delete from library_authors where library=".$this->fields["id"]);
		if (is_array($this->author)) {
			foreach($this->author as $key => $value) {
				if ($value)	{
					$res=$db->query("select library from library_authors where library=".$this->fields["id"]." and author=".$value);
					if (!$db->num_rows($res)) {
						$db->query("insert into library_authors set library=".$this->fields["id"].", author=".$value);
					}
				}
			}
		}
		$page="&page=".$this->page;
		header("Location: ?chid=".$this->chid."&m=3$page");
	}

	function librarySelect () {
		
		if (!$this->page) $this->page=1;
		
		$adminConfig=admin::adminConfig();
		
		$db=new sql;
		$db->connect();
		include "lib/orderby.class.php";
		$orderBy=new orderBy("?chid=".$this->chid."&", array("library"=>"№", "time"=>"Дата", "name"=>"Заголовок", "short_text"=>"Подзаголовок", "author"=>"Автор"), array("library"=>"desc"),$this->field, $this->order);
		$ths=$orderBy->ths();
		
		if ($this->id) {
			$res=$db->query("select id from library order by id desc");
			while($data=$db->fetch_array($res)) {
				$position++;
				if ($data["id"]==$this->id) break;
			}
			$this->page=ceil($position/$adminConfig["recPerPage"]);
			$db->free_result($res);
			$page="?page=".$this->page."&id=".$this->id;
		}
		
		$db->query("select count(id) as counter from library");
		$data=$db->fetch_array($db->result);
		$numRows=$data["counter"];
		
		$counter=1;
		
		while ($counter<$numRows) {
			$i++;
			$pageSelectOption.="<option value=\"".$i."\" ".(($i==$this->page) ? " selected" : "").">$i</option>";
			$counter+=$adminConfig["recPerPage"];
		}
		
		eval("\$content=\"".admin::template("librarySelect")."\";");
		$this->elements["content"]=$content;
	}

	function librarySelectI () {
		
		if (!$this->page) $this->page=1;
		
		$db=new sql;
		$db->connect();
		
		include "lib/orderby.class.php";
		$orderBy=new orderBy("?chid=".$this->chid."&", array("library"=>"№", "time"=>"Дата", "name"=>"Заголовок", "short_text"=>"Подзаголовок", "author"=>"Автор"), array("library"=>"desc"),$this->field, $this->order);
		
		$adminConfig=admin::adminConfig();
		//echo "select library.id as library, name, short_text, time, authors.lastname as author FROM (library LEFT JOIN library_authors ON library.id = library_authors.library) LEFT JOIN authors ON library_authors.author = authors.id GROUP BY library.id".$orderBy->orderByQuery()." limit ".(($this->page-1)*$adminConfig["recPerPage"]).", ".$adminConfig["recPerPage"];
		$res=$db->query("select library.id as library, name, short_text, time, authors.lastname as author FROM (library LEFT JOIN library_authors ON library.id = library_authors.library) LEFT JOIN authors ON library_authors.author = authors.id GROUP BY library.id".$orderBy->orderByQuery()." limit ".(($this->page-1)*$adminConfig["recPerPage"]).", ".$adminConfig["recPerPage"]);
		
		while ($data=$db->fetch_array($res)) {
			$i++;
			$data["date"]=date("d.m.Y", $data["time"]);
			$data["name"]=admin::null2nbsp($data["name"]);
			$data["short_text"]=admin::null2nbsp($data["short_text"]);
			$res1=$db->query("select id, firstname, secondname, lastname from library_authors left join authors on library_authors.author = authors.id where library_authors.library=".$data["library"]." order by lastname, firstname, secondname");
			while ($data1=$db->fetch_array($res1)) {
				$data["fio"].="<li>".$data1["lastname"].(($data1["firstname"]) ? " ".$data1["firstname"] : "").(($data1["secondname"]) ? " ".$data1["secondname"] : "")."</li>";
			}
			$data["fio"]=admin::null2nbsp($data["fio"]);
			$checked=($data["library"]==$this->id || (!$this->id && $i==1)) ? " checked" : "";
			eval("\$librarySelectITR.=\"".admin::template("librarySelectITR")."\";");
		}
		
		eval("\$content=\"".admin::template("librarySelectI")."\";");
		$this->elements["content"]=$content;
	}
}
?>