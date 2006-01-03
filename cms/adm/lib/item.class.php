<?php
class item {

	var $elements;
	var $chid;
	var $id;
	
	function item () {
		global $HTTP_GET_VARS, $HTTP_POST_VARS;
		$this->chid=$HTTP_GET_VARS["chid"];
		$this->id=$HTTP_GET_VARS["id"];
		$this->lid=$HTTP_GET_VARS["lid"];
		$this->eid=$HTTP_GET_VARS["eid"];
		$this->feid=$HTTP_GET_VARS["feid"];
		$this->pid=$HTTP_GET_VARS["pid"];
		$this->level=$HTTP_GET_VARS["level"];
		$this->fields=$HTTP_POST_VARS["fields"];
		$this->date=$HTTP_POST_VARS["date"];
	}

	function defaultAction () {
		$open_nodes=$this->_get_open_nodes($this->id);
		$content=$this->_get_tree(0, $open_nodes);
		$chid=$this->chid;
		$lid=($this->id) ? $this->id : 0;
		eval('$content="'.admin::template("itemMain").'";');
		$this->elements["content"]=$content;
	}

	function showStructure () {
		echo "showStructure";
	}

	function add () {
		$select=admin::getDateSelectOptions();
		$chid=$this->chid;
		$action="appendAdd";
		
		$db=new sql;
		$db->connect();
		$res=$db->query("select * from types order by id");
		while($data=$db->fetch_array($res)) {
			$i++;
			$types.="<option value=\"$data[id]\">$data[title]</option>";
		}
		
		$ts[$this->level]=" selected";
		$true=($this->level==4) ? " && true" : " && false";
		$data["pid"]=$this->pid;
		$header="Добавление";
		$lid=$this->lid;
		$library["chid"]=admin::getTypeID("library");
		eval("\$content=\"".admin::template("itemAdd", "FORMPOST", array("fields[title]"=>"EXISTS", "fields[url]"=>"EXISTS"))."\";");
		$this->elements["content"]=$content;
	}

	function edit () {
		$db=new sql;
		$db->connect();
		$res=$db->query("select * from chapters where id=".$this->id);
		$data=$db->fetch_array($res);
		$data["text"]=htmlspecialchars($data["text"]);
		$true=($data["type"]==4) ? " && true" : " && false";
		
		$db=new sql;
		$db->connect();
		$res1=$db->query("select * from types order by id");
		while($data1=$db->fetch_array($res1)) {
			$i++;
			$types.="<option".(($data["type"]==$data1[id]) ? " selected" : "")." value=\"$data1[id]\">$data1[title]</option>";
		}
		
		$select=admin::getDateSelectOptions($data["time"]);
		$chid=$this->chid;
		$action="appendEdit";
		$id='<tr>
			<td>№</td>
			<td><input maxlength="14" name="fields[id]" size="14" value="'.$this->id.'" readonly="readonly" style="width: auto;" value="'.$this->id.'"></td>
		</tr>';
		
		//$res2=$db->query("select id, name, short_text, time from library where id='".$data["article"]."'");
		
		$state_selected[$data["state"]]=" selected";
		$header="Редактирование";
		$lid=$this->lid;
		eval("\$content=\"".admin::template("itemAdd", "FORMPOST", array("fields[title]"=>"EXISTS", "fields[url]"=>"EXISTS"))."\";");
		$this->elements["content"]=$content;
	}

	function appendAdd () {
		session_start();
		unset($_SESSION["wrongFields"]);
		$this->fields["time"]=mktime(0, 0, 0, $this->date["month"], $this->date["day"], $this->date["year"]);
		srand((double)microtime()*1000000);
		$this->fields["sortorder"]=0;
		$this->fields["sid"]=md5 (uniqid (rand()));
		foreach($this->fields as $key => $value) {
			$query.="$key='".$value."', ";
		}
		$query.="ctime=".@time().", lmtime=".@time();
		$db=new sql;
		$db->connect();
		$res=$db->query("select id from chapters where url='".$this->fields["url"]."' and pid='".$this->fields["pid"]."'");
		if ($db->num_rows($res)) {
			$_SESSION["fields"]=$this->fields;
			$_SESSION["wrongFields"][]="Страница с таким адресом (URL)&nbsp;&mdash; <b>".$this->fields["url"]."</b>&nbsp;&mdash; уже существует!";
			header("Location: ?chid=".$this->chid."&action=wrongAdd&id=".$this->lid);
			exit;
		}
		$db->query("insert into chapters set $query");
		$db->query("UPDATE chapters SET sortorder= sortorder+1 WHERE pid='".$this->fields["pid"]."'");
		header("Location: ?chid=".$this->chid."&m=2&id=".$this->lid);
	}

	function wrongAdd() {
		session_start();
		if ($_SESSION["fields"]) {
			foreach ($_SESSION["wrongFields"] as $key => $value) {
				$message.="<p class=\"error\">".$value."</p>";
			}
			$data=$_SESSION["fields"];
			$select=admin::getDateSelectOptions($data["time"]);
			$chid=$this->chid;
			$action="appendAdd";
			
			$db=new sql;
			$db->connect();
			$res=$db->query("select * from types order by id");
			while($data1=$db->fetch_array($res)) {
				$i++;
				$types.="<option".(($data["type"]==$data1["id"]) ? " selected" : "")." value=\"$data1[id]\">$data1[title]</option>";
			}
			
			$ts[$data["type"]]=" selected";
			$true=($data["type"]==4) ? " && true" : " && false";
			$data=$_SESSION["fields"];
			$header="Добавление";
			$lid=$this->lid;
			$library["chid"]=admin::getTypeID("library");
			eval("\$content=\"".admin::template("itemAdd", "FORMPOST", array("fields[title]"=>"EXISTS", "fields[url]"=>"EXISTS"))."\";");
			$this->elements["content"]=$content;
		}
	}

	function appendEdit () {
		$this->fields["time"]=mktime(0, 0, 0, $this->date["month"], $this->date["day"], $this->date["year"]);
		foreach($this->fields as $key => $value) {
			$query.="$key='".$value."', ";
		}
		$query.="lmtime=".@time();
		$db=new sql;
		$db->connect();
		$db->query("update chapters set $query where id=".$this->fields["id"]);
		header("Location: ?chid=".$this->chid."&m=3&id=".$this->lid);
	}

	function delete () {
		$db=new sql;
		$db->connect();
		$db->query("delete from chapters where id=".$this->id);
		header("Location: ?chid=".$this->chid."&m=1&id=".$this->lid);
	}

	function reorder () {
	
		$db=new sql;
		$db->connect();
		$db->query("select pid, sortorder from chapters where id=".$this->eid);
		$edata=$db->fetch_array($db->result);
		$db->query("select pid, sortorder from chapters where id=".$this->feid);
		$fdata=$db->fetch_array($db->result);
		if ($edata["pid"]<>$fdata["pid"]) {
			$db->query("UPDATE chapters SET sortorder= sortorder+1 WHERE sortorder>=".$edata["sortorder"]." and pid=".$edata["pid"]);
			$db->query("UPDATE chapters SET sortorder= sortorder-1 WHERE sortorder>".$fdata["sortorder"]." and pid=".$fdata["pid"]);
			$db->query("UPDATE chapters SET sortorder=".$edata["sortorder"].", pid=".$edata["pid"]." WHERE id=".$this->feid);
		}
		else {
			if ($fdata["sortorder"]>$edata["sortorder"]) {
				$db->query("UPDATE chapters SET sortorder= sortorder+1 WHERE sortorder<".$fdata["sortorder"]." && sortorder>=".$edata["sortorder"]."  && pid=".$fdata["pid"]);
				$db->query("UPDATE chapters SET sortorder=".$edata["sortorder"]." WHERE id=".$this->feid);
			}
			elseif ($fdata["sortorder"]<$edata["sortorder"]) {
				$db->query("UPDATE chapters SET sortorder= sortorder-1 WHERE sortorder>".$fdata["sortorder"]." && sortorder<".$edata["sortorder"]."  && pid=".$fdata["pid"]);
				$db->query("UPDATE chapters SET sortorder=".$edata["sortorder"]."-1  where id=".$this->feid);
			}
		}
		header("Location: ?chid=".$this->chid."&id=".$this->id);
	}

	function _get_open_nodes($id) {
		$db=new sql;
		$db->connect();
		if ($id) {
			$res=$db->query("select id, pid, title, LENGTH(text) as bl, url from chapters where id=$id order by sortorder");
			while ($db->num_rows($res)>0) {
				$data=$db->fetch_array($res);
				$open_nodes[$data["id"]]=true;
				$res=$db->query("select id, pid, title, LENGTH(text) as bl, url from chapters where id=".$data["pid"]);
			}
		}
		return $open_nodes;
	}
	
	function _get_tree($id=0, $open_nodes, $level=0, $counter=false) {
		global $cid, $lid, $lang;
		$level++;
		$db=new sql;
		$db->connect();
		$res=$db->query("select id, pid, title, LENGTH(text) as bl, url, type, state from chapters where pid=$id order by sortorder");
		if ($db->num_rows($res)>0) {
			$s.="\n";
			while ($data=$db->fetch_array($res)) {
				$bl=($data["bl"]) ? number_format($data["bl"]/1024, 2, ',', ' ')."&nbsp;КБ" : "";
				$gc=$this->_got_child($data["id"]);
				$img=($gc) ? (($open_nodes[$data["id"]]) ? "minus" : "plus") : "dot";
				$l=($data["type"]) ? "_" : "";
				$img1=($open_nodes[$data["id"]]) ? "folderopen".$l : "folder".$l;
				$pid=($open_nodes[$data["id"]]) ? $data["pid"] : $data["id"];
				$a_o=($gc) ?  "<a href=\"?chid=".$this->chid."&id=$pid\" style=\"color: black;\" id=\"tree\">" :"";
				$a_c=($gc) ?  "</a>" :"";
				$lid=$this->id;
				$del=($gc || $data["id"]=="1") ? "&nbsp;<img src=\"i/dot.gif\" alt=\"\" width=\"16\" height=\"16\" border=\"0\">" : "&nbsp;<a href=\"?chid=".$this->chid."&action=delete&id=".$data["id"]."&lid=$lid\" class=\"buttons\"><img src=\"i/del.gif\" alt=\"Удалить\" width=\"16\" height=\"16\" border=\"0\" onClick=\"return submit_delete(".$data["id"].")\"></a>";
				$s.= "<tr><td><img src=\"i/dot.gif\" alt=\"\" width=\"".(($level-1)*20)."\" height=\"1\" border=\"0\">$a_o<img src=\"i/".$img.".gif\" alt=\"\" border=\"0\" align=\"absmiddle\" height=\"16\" width=\"16\"><img id=\"icon".$data["id"]."\" src=\"i/$img1.gif\" alt=\"\" border=\"0\" align=\"absmiddle\" height=\"16\" width=\"16\" hspace=\"5\" class=\"dragme\">".$data["title"]."$a_c</span></td><td style=\"color: gray;\" align=\"right\">$bl</td><td align=\"center\"><img src=\"i/".(($data["state"] ? "dot" : "hidden")).".gif\" alt=\"".(($data["state"] ? "" : "скрыто"))."\" width=\"32\" height=\"16\" border=\"0\"></td><td style=\"white-space: nowrap;\">&nbsp;&nbsp;<a href=\"?chid=".$this->chid."&action=edit&id=".$data["id"]."&lid=$lid\" class=\"buttons\"><img src=\"i/edit.gif\" alt=\"Редактировать\" width=\"16\" height=\"16\" border=\"0\"></a>$del&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"?chid=".$this->chid."&action=add&pid=".$data["id"]."&level=".($level+1)."&lid=$lid\" class=\"buttons\"><img src=\"i/add.gif\" alt=\"Добавить\" width=\"16\" height=\"16\" border=\"0\"></a>&nbsp;&nbsp;</td></tr>\n";
				if ($open_nodes[$data["id"]]) $s.=$this->_get_tree($data["id"], $open_nodes, $level, &$counter);
			}
			$s.="\n";
			return $s;
		}
	}

	function _got_child($id) {
		$db=new sql;
		$db->connect();
		$res=$db->query("select id, pid, title, LENGTH(text) as bl, url from chapters where pid=$id");
		return ($db->num_rows($res)>0);
	}
}
?>
