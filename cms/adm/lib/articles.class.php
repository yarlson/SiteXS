<?php
class articles {

	var $elements;
	var $chid;
	var $id;
	
	function articles () {
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
		$this->db=new sql;
		$this->db->connect();
	}

	function defaultAction () {
		$chid=$this->chid;
		
		include "lib/pagination.class.php";
		
		$adminConfig=admin::adminConfig();
		$pagination=new pagination ("?chid=".$this->chid."&", $this->page, $adminConfig["recPerPage"], '', "articles", "id");
		$res=$this->db->query("select id, time, title from articles order by id desc ".$pagination->limit());
		$page =($this->page) ? "&page=".$this->page : "";
		while($this->data=$this->db->fetch_array($res)) {
			$this->data["date"]=($this->data["time"]) ? @date("d.m.Y", $this->data["time"]) : "";
			$this->articlesTR.=admin::template("articlesTR", $this);
		}
		
		$this->pageBar=$pagination->bar();
		
		$content=admin::template("articlesMain", $this);
		$this->elements["content"]=$content;
	}

	function showStructure () {
		echo "showStructure";
	}

	function add () {
		$this->select=admin::getDateSelectOptions();
		$this->chid=$this->chid;
		$this->action="appendAdd";
		
		$this->db=new sql;
		$this->db->connect();
		$res=$this->db->query("select * from types order by id");
		while($data=$this->db->fetch_array($res)) {
			$i++;
			$this->types.="<option value=\"$data[id]\">$data[title]</option>";
		}
		
		$ts[$this->level]=" selected";
		$true=($this->level==4) ? " && true" : " && false";
		$this->data["pid"]=$this->pid;
		$this->chapter_tree=$this->_getChaptersTree();
		$this->header=__("Add new");
		$lid=$this->lid;
		$library["chid"]=admin::getTypeID("library");
		$this->elements["content"]=admin::template("articlesAdd", $this);
	}

	function edit () {
		$this->db=new sql;
		$this->db->connect();
		$res=$this->db->query("select * from articles where id=".$this->id);
		$this->data=$this->db->fetch_array($res);
		$this->data["text"]=htmlspecialchars($this->data["text"]);
		$true=($this->data["type"]==4) ? " && true" : " && false";
		
		$this->db=new sql;
		$this->db->connect();
		$res1=$this->db->query("select * from types order by id");
		while($data1=$this->db->fetch_array($res1)) {
			$i++;
			$this->types.="<option".(($this->data["type"]==$data1[id]) ? " selected" : "")." value=\"$data1[id]\">$data1[title]</option>";
		}
		
		$this->select=admin::getDateSelectOptions($this->data["time"]);
		$chid=$this->chid;
		$res1=$this->db->query("select * from articles_chapters where article_id=".$this->id);
		while($data1=$this->db->fetch_array($res1)) {
			$checked_nodes[$data1["chapter_id"]]=1;
		}
		$this->chapter_tree=$this->_getChaptersTree(0, $checked_nodes);
		$this->action="appendEdit";
		$this->id='<tr>
			<td></td>
			<td><input maxlength="14" name="fields[id]" size="14" value="'.$this->id.'" readonly="readonly" style="width: auto;" value="'.$this->id.'"></td>
		</tr>';
		
		//$res2=$this->db->query("select id, name, short_text, time from library where id='".$data["article"]."'");
		
		$this->state_selected[$this->data["state"]]=" selected";
		$this->header=__("Edit");
		$lid=$this->lid;
		$content=admin::template("articlesAdd", $this);
		$this->elements["content"]=$content;
	}

	function appendAdd () {
		session_start();
		unset($_SESSION["wrongFields"]);
		$chapters=$this->fields["chapters"];
		unset($this->fields["chapters"]);
		$this->fields["time"]=mktime(0, 0, 0, $this->date["month"], $this->date["day"], $this->date["year"]);
		foreach($this->fields as $key => $value) {
			$query.="$key='".$value."', ";
		}
		$query.="ctime=".@time().", lmtime=".@time();
		$this->db=new sql;
		$this->db->connect();
		$res=$this->db->query("select id from articles where url='".$this->fields["url"]."'");
		if ($this->db->num_rows($res)) {
			$_SESSION["fields"]=$this->fields;
			$_SESSION["wrongFields"][]="The page with such URI <b>".$this->fields["url"]."</b> exists!";
			header("Location: ?chid=".$this->chid."&action=wrongAdd&id=".$this->lid);
			exit;
		}
		$this->db->query("insert into articles set $query");
		$last_id=$this->db->insert_id();
		foreach($chapters as $key => $value) {
			$this->db->query("insert into articles_chapters set article_id=".$last_id.", chapter_id=".$key);
		}
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
			
			$this->db=new sql;
			$this->db->connect();
			$res=$this->db->query("select * from types order by id");
			while($data1=$this->db->fetch_array($res)) {
				$i++;
				$types.="<option".(($data["type"]==$data1["id"]) ? " selected" : "")." value=\"$data1[id]\">$data1[title]</option>";
			}
			
			$ts[$data["type"]]=" selected";
			$true=($data["type"]==4) ? " && true" : " && false";
			$data=$_SESSION["fields"];
			$header="";
			$lid=$this->lid;
			$library["chid"]=admin::getTypeID("library");
			eval("\$content=\"".admin::template("articleAdd", "FORMPOST", array("fields[title]"=>"EXISTS", "fields[url]"=>"EXISTS"))."\";");
			$this->elements["content"]=$content;
		}
	}

	function appendEdit () {
		$chapters=$this->fields["chapters"];
		unset($this->fields["chapters"]);
		$this->fields["time"]=mktime(0, 0, 0, $this->date["month"], $this->date["day"], $this->date["year"]);
		foreach($this->fields as $key => $value) {
			$query.="$key='".$value."', ";
		}
		$query.="lmtime=".@time();
		$this->db=new sql;
		$this->db->connect();
		$this->db->query("update articles set $query where id=".$this->fields["id"]);
		$this->db->query("delete from articles_chapters where article_id=".$this->fields["id"]);
		foreach($chapters as $key => $value) {
			$this->db->query("insert into articles_chapters set article_id=".$this->fields["id"].", chapter_id=".$key);
		}
		header("Location: ?chid=".$this->chid."&m=3&id=".$this->lid);
	}

	function delete () {
		$this->db=new sql;
		$this->db->connect();
		$this->db->query("delete from articles where id=".$this->id);
		$this->db->query("delete from articles_chapters where article_id=".$this->id);
		header("Location: ?chid=".$this->chid."&m=1&id=".$this->lid);
	}

	function reorder () {
	
		$this->db=new sql;
		$this->db->connect();
		$this->db->query("select pid, sortorder from articles where id=".$this->eid);
		$edata=$this->db->fetch_array($this->db->result);
		$this->db->query("select pid, sortorder from articles where id=".$this->feid);
		$fdata=$this->db->fetch_array($this->db->result);
		if ($edata["pid"]<>$fdata["pid"]) {
			$this->db->query("UPDATE articles SET sortorder= sortorder+1 WHERE sortorder>=".$edata["sortorder"]." and pid=".$edata["pid"]);
			$this->db->query("UPDATE articles SET sortorder= sortorder-1 WHERE sortorder>".$fdata["sortorder"]." and pid=".$fdata["pid"]);
			$this->db->query("UPDATE articles SET sortorder=".$edata["sortorder"].", pid=".$edata["pid"]." WHERE id=".$this->feid);
		}
		else {
			if ($fdata["sortorder"]>$edata["sortorder"]) {
				$this->db->query("UPDATE articles SET sortorder= sortorder+1 WHERE sortorder<".$fdata["sortorder"]." && sortorder>=".$edata["sortorder"]."  && pid=".$fdata["pid"]);
				$this->db->query("UPDATE articles SET sortorder=".$edata["sortorder"]." WHERE id=".$this->feid);
			}
			elseif ($fdata["sortorder"]<$edata["sortorder"]) {
				$this->db->query("UPDATE articles SET sortorder= sortorder-1 WHERE sortorder>".$fdata["sortorder"]." && sortorder<".$edata["sortorder"]."  && pid=".$fdata["pid"]);
				$this->db->query("UPDATE articles SET sortorder=".$edata["sortorder"]."-1  where id=".$this->feid);
			}
		}
		header("Location: ?chid=".$this->chid."&id=".$this->id);
	}

	function _getChaptersTree($current=0, $checked_nodes=array()) {
		$res=$this->db->query("select id, title, pid from chapters where pid='".$current."' order by sortorder");
		while ($data=$this->db->fetch_array($res)) {
			$child=$this->_getChaptersTree($data["id"], $checked_nodes);
			$tree.="<li><input type=\"checkbox\" style=\"width: 1em;\" id=\"chapter_".$data["id"]."\" name=\"fields[chapters][".$data["id"]."]\" value=\"1\"".(($checked_nodes[$data["id"]]) ? " checked" : "")." /> <label for=\"chapter_".$data["id"]."\">".$data["title"]."</label>".$child."</li>";
		}
		if ($tree) return "<ul>".$tree."</ul>";
	}
	
}
?>
