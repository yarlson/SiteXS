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
		$this->fields["time"]=mktime(0, 0, 0, $this->date["month"], $this->date["day"], $this->date["year"]);
		foreach($this->fields as $key => $value) {
			$query.="$key='".$value."', ";
		}
		$query.="lmtime=".@time();
		$this->db=new sql;
		$this->db->connect();
		$this->db->query("update articles set $query where id=".$this->fields["id"]);
		header("Location: ?chid=".$this->chid."&m=3&id=".$this->lid);
	}

	function delete () {
		$this->db=new sql;
		$this->db->connect();
		$this->db->query("delete from articles where id=".$this->id);
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

	function _get_open_nodes($id) {
		$this->db=new sql;
		$this->db->connect();
		if ($id) {
			$res=$this->db->query("select id, pid, title, LENGTH(text) as bl, url from articles where id=$id order by sortorder");
			while ($this->db->num_rows($res)>0) {
				$data=$this->db->fetch_array($res);
				$open_nodes[$data["id"]]=true;
				$res=$this->db->query("select id, pid, title, LENGTH(text) as bl, url from articles where id=".$data["pid"]);
			}
		}
		return $open_nodes;
	}
	
	function _get_tree($id=0, $open_nodes, $level=0, $counter=false) {
		global $cid, $lid, $lang;
		$level++;
		$this->db=new sql;
		$this->db->connect();
		$res=$this->db->query("select id, pid, title, LENGTH(text) as bl, url, type, state from articles where pid=$id order by sortorder");
		if ($this->db->num_rows($res)>0) {
			$s.="\n";
			while ($data=$this->db->fetch_array($res)) {
				$bl=($data["bl"]) ? number_format($data["bl"]/1024, 2, ',', ' ')."&nbsp;".__("KB") : "";
				$gc=$this->_got_child($data["id"]);
				$img=($gc) ? (($open_nodes[$data["id"]]) ? "minus" : "plus") : "dot";
				$l=($data["type"]) ? "_" : "";
				$img1=($open_nodes[$data["id"]]) ? "folderopen".$l : "folder".$l;
				$pid=($open_nodes[$data["id"]]) ? $data["pid"] : $data["id"];
				$a_o=($gc) ?  "<a href=\"?chid=".$this->chid."&id=$pid\" style=\"color: black;\" id=\"tree\">" :"";
				$a_c=($gc) ?  "</a>" :"";
				$lid=$this->id;
				$del=($gc || $data["id"]=="1") ? "&nbsp;<img src=\"i/dot.gif\" alt=\"\" width=\"16\" height=\"16\" border=\"0\">" : "&nbsp;<a href=\"?chid=".$this->chid."&action=delete&id=".$data["id"]."&lid=$lid\" class=\"buttons\"><img src=\"i/del.gif\" title=\"".__("Delete")."\" width=\"16\" height=\"16\" border=\"0\" onClick=\"return submit_delete(".$data["id"].")\"></a>";
				$s.= "<tr><td><img src=\"i/dot.gif\" alt=\"\" width=\"".(($level-1)*20)."\" height=\"1\" border=\"0\">$a_o<img src=\"i/".$img.".gif\" alt=\"\" border=\"0\" align=\"absmiddle\" height=\"16\" width=\"16\"><img id=\"icon".$data["id"]."\" src=\"i/$img1.gif\" alt=\"\" border=\"0\" align=\"absmiddle\" height=\"16\" width=\"16\" hspace=\"5\" class=\"dragme\">".$data["title"]."$a_c</span></td><td style=\"color: gray;\" align=\"right\">$bl</td><td align=\"center\"><img src=\"i/".(($data["state"] ? "dot" : "hidden")).".gif\" alt=\"".(($data["state"] ? "" : __("hidden")))."\" width=\"32\" height=\"16\" border=\"0\"></td><td style=\"white-space: nowrap;\">&nbsp;&nbsp;<a href=\"?chid=".$this->chid."&action=edit&id=".$data["id"]."&lid=$lid\" class=\"buttons\"><img src=\"i/edit.gif\" title=\"".__("Edit")."\" width=\"16\" height=\"16\" border=\"0\"></a>$del&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"?chid=".$this->chid."&action=add&pid=".$data["id"]."&level=".($level+1)."&lid=$lid\" class=\"buttons\"><img src=\"i/add.gif\" title=\"".__("Add new")."\" width=\"16\" height=\"16\" border=\"0\"></a>&nbsp;&nbsp;</td></tr>\n";
				if ($open_nodes[$data["id"]]) $s.=$this->_get_tree($data["id"], $open_nodes, $level, &$counter);
			}
			$s.="\n";
			return $s;
		}
	}

	function _got_child($id) {
		$this->db=new sql;
		$this->db->connect();
		$res=$this->db->query("select id, pid, title, LENGTH(text) as bl, url from articles where pid=$id");
		return ($this->db->num_rows($res)>0);
	}
}
?>
