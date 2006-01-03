<?php
class subscribe {

	function subscribe () {
		global $HTTP_GET_VARS, $HTTP_POST_VARS, $HTTP_SERVER_VARS;
		$this->chid=$HTTP_GET_VARS["chid"];
		$this->id=$HTTP_GET_VARS["id"];
		$this->field=$HTTP_GET_VARS["field"];
		$this->page=$HTTP_GET_VARS["page"];
		$this->i=$HTTP_GET_VARS["i"];
		$this->order=$HTTP_GET_VARS["order"];
		$this->mid=$HTTP_GET_VARS["mid"];
		$this->message=$HTTP_GET_VARS["m"];
		$this->fields=$HTTP_POST_VARS["fields"];
		$this->host=$HTTP_SERVER_VARS["HTTP_HOST"];
		$this->lst=$HTTP_POST_VARS["lst"];
		$action=explode("_", $HTTP_GET_VARS["action"]);
		$class[$action[1]]=" id=\"cur\"";
		eval('$this->navBar="'.admin::template("subscribeNav").'";');
	}

	function defaultAction () {
		$db=new sql;
		$db->connect();
		$chid=$this->chid;
		$res=$db->query("select * from subs_lists order by title");
		while($data=$db->fetch_array($res)) {
			$i++;
			eval('$subscribeTR.="'.admin::template("subscribeTR").'";');
		}
		eval('$content="'.admin::template("subscribeMain").'";');
		$this->elements["content"]=$content;
	}

	function add() {
		$this->navBar="";
		$action="infoAddApply";
		$header="Добавление списка рассылки";
		eval('$content="'.admin::template("subscribeInfo", "FORMPOST", array("fields[title]"=>"EXISTS")).'";');
		$this->elements["content"]=$content;
	}

	function show_Info() {
		$db=new sql;
		$db->connect();
		$chid=$this->chid;
		$res=$db->query("select * from subs_lists where id=$this->id");
		$data=$db->fetch_array($res);
		$listName=$data["title"];
		$action="infoEditApply";
		$header="Свойства списка рассылки";
		eval('$content="'.admin::template("subscribeInfoEdit", "FORMPOST", array("fields[title]"=>"EXISTS")).'";');
		$this->elements["content"]=$content;
	}

	function infoAddApply() {
		foreach($this->fields as $key => $value) {
			$query.="$key='".admin::slashesIn($value)."', ";
		}
		$query=substr($query, 0, strlen($s)-2);
		$db=new sql;
		$db->connect();
		$chid=$this->chid;
		$db->query("insert into subs_lists set $query");
		header("Location: ?chid=".$this->chid);
	}

	function infoEditApply() {
		foreach($this->fields as $key => $value) {
			$query.="$key='".admin::slashesIn($value)."', ";
		}
		$query=substr($query, 0, strlen($s)-2);
		$db=new sql;
		$db->connect();
		$chid=$this->chid;
		$db->query("update subs_lists set $query");
		header("Location: ?chid=".$this->chid."&action=show_Info&id=".$this->id);
	}

	function delete() {
		$db=new sql;
		$db->connect();
		$db->query("delete from subs_messages where lid=".$this->id);
		$db->query("delete from subs_subscribed where lid=".$this->id);
		$db->query("delete from subs_lists where id=".$this->id);
		header("Location: ?chid=".$this->chid);
	}

	function show_Messages() {
		$db=new sql;
		$db->connect();
		$chid=$this->chid;
		$res=$db->query("select * from subs_lists where id=$this->id");
		$data=$db->fetch_array($res);
		$listName=$data["title"];
		$res=$db->query("select * from subs_messages where lid=$this->id order by  id desc");
		while($data=$db->fetch_array($res)) {
			$i++;
			$data["date_sent"]=($data["date_sent"]) ? date("d.m.Y H:i:s", $data["date_sent"]) : "";
			eval('$subscribeMessagesTR.="'.admin::template("subscribeMessagesTR").'";');
		}
		eval('$content="'.admin::template("subscribeMessagesMain").'";');
		$this->elements["content"]=$content;
	}

	function add_Messages() {
		$db=new sql;
		$db->connect();
		$res=$db->query("select * from subs_lists where id=$this->id");
		$data=$db->fetch_array($res);
		$listName=$data["title"];
		$data["subj"]=$listName;
		$action="addApply_Messages";
		$header="Добавление сообщения";
		eval('$content="'.admin::template("subscribeMessageAdd", "FORMPOST", array("fields[title]"=>"EXISTS")).'";');
		$this->elements["content"]=$content;
	}

	function delete_Messages() {
		$db=new sql;
		$db->connect();
		$db->query("delete from subs_messages where id=".$this->mid);
		header("Location: ?chid=".$this->chid."&action=show_Messages&id=".$this->id);
	}

	function edit_Messages () {
		$db=new sql;
		$db->connect();
		$res=$db->query("select * from subs_messages where id=".$this->mid);
		$data=$db->fetch_array($res);
		$action="editApply_Messages&mid=".$this->mid;
		$header="Редактирование сообщения";
		eval('$content="'.admin::template("subscribeMessageAdd", "FORMPOST", array("fields[title]"=>"EXISTS")).'";');
		$this->elements["content"]=$content;
		
	}

	function show_AllUsers() {
		$db=new sql;
		$db->connect();
		$chid=$this->chid;
		include "lib/pagination.class.php";
		include "lib/orderby.class.php";
		
		$adminConfig=admin::adminConfig();
		
		$orderBy=new orderBy("?chid=".$this->chid."&action=show_AllUsers&", array("id"=>"№", "name"=>"Имя", "email"=>"E-mail"), array("name"=>""),$this->field, $this->order);
		$pagination=new pagination ($orderBy->urlForPage(), $this->page, $adminConfig["recPerPage"], '', "subs_users", "id");
		$res=$db->query("select * from subs_users".$orderBy->orderByQuery()." ".$pagination->limit());
		if ($this->field) $page="&field=$this->field";
		if ($this->order) $page.="&order=$this->order";
		if ($this->page) $page.="&page=$this->page";
		while($data=$db->fetch_array($res)) {
			$i++;
			eval('$subscribeAllUsersTR.="'.admin::template("subscribeAllUsersTR").'";');
		}
		$th=$orderBy->bar();
		$pageBar=$pagination->bar();
		eval('$content="'.admin::template("subscribeAllUsersMain").'";');
		$this->elements["content"]=$content;
	}

	function addApply_Messages() {
		$this->fields["html"]=str_replace("href=\"/", "href=\"http://www.archipelag.ru/", $this->fields["html"]);
		foreach($this->fields as $key => $value) {
			$query.="$key='".admin::slashesIn($value)."', ";
		}
		$query=substr($query, 0, strlen($s)-2);
		$db=new sql;
		$db->connect();
		$chid=$this->chid;
		$db->query("insert into subs_messages set $query");
		header("Location: ?chid=".$this->chid."&action=show_Messages&id=".$this->id);
	}

	function editApply_Messages() {
		$this->fields["html"]=str_replace("href=\\\"/", "href=\\\"http://www.archipelag.ru/", $this->fields["html"]);
		foreach($this->fields as $key => $value) {
			$query.="$key='".admin::slashesIn($value)."', ";
		}
		$query=substr($query, 0, strlen($s)-2);
		$db=new sql;
		$db->connect();
		$chid=$this->chid;
		$db->query("update subs_messages set $query where id=".$this->mid);
		header("Location: ?chid=".$this->chid."&action=show_Messages&id=".$this->id);
	}

	function show_Conf () {
		$db=new sql;
		$db->connect();
		$res=$db->query("select * from subs_config");
		$data=$db->fetch_array($res);
		foreach ($data as $key => $value) {
			$data[$key]=htmlspecialchars($value);
		}
		eval('$content="'.admin::template("subscribeMainInfo", "FORMPOST", array("fields[text]"=>"EXISTS", "fields[html]"=>"EXISTS", "fields[confirm]"=>"EXISTS")).'";');
		$this->elements["content"]=$content;
	}

	function apply_conf () {
		foreach($this->fields as $key => $value) {
			$query.="$key='".admin::slashesIn($value)."', ";
		}
		$query=substr($query, 0, strlen($s)-2);
		$db=new sql;
		$db->connect();
		$chid=$this->chid;
		$db->query("update subs_config set $query");
		header("Location: ?chid=".$this->chid."&action=show_conf");
	}

	function test_Messages () {
		
		include_once "lib/mail.class.php";
		
		$conf=$this->conf();
		$db=new sql;
		$db->connect();
		$res=$db->query("select * from subs_messages where id=$this->mid");
		$data=$db->fetch_array($res);
		
		$user["name"]="ТЕСТОВЫЙ ПОЛЬЗОВАТЕЛЬ";
		$user["email"]=$conf["email"];
		
		$text["txt"]=$data["text"];
		$text["html"]=$data["html"];
		
		if ($data["text"])
			$txt=$this->replaceMacros($conf["text"], $text, $conf, $user);
		if ($data["html"])
			$html=$this->replaceMacros($conf["html"], $text, $conf, $user);
		
		$mail = new htmlMimeMail();
		
		$mail->setSubject($data["subj"]);
		$mail->setFrom($conf["email_from"]);
		
		if ($html) {
			$mail->setHtmlEncoding("base64");
			$mail->setHTML($html, $txt, '');
		}
		elseif ($txt && !$html) {
			$mail->setText($txt);
		}
		
		$result = $mail->send(array($conf["test_email"]));
		
		header("Location: ?chid=".$this->chid."&action=show_Messages&id=".$this->id);
	}

	function send_Messages () {
		
		include_once "lib/mail.class.php";
		
		$conf=$this->conf();
		$db=new sql;
		$db->connect();
		$res=$db->query("select * from subs_messages where id=$this->mid");
		$data=$db->fetch_array($res);
		
		$page=($this->page) ? $this->page : 1;
		$res=$db->query("select * from subs_users left join subs_subscribed on subs_users.id=subs_subscribed.sid where lid=$this->id limit ".(10*($page-1)).",10");
		
		if ($db->num_rows($res)) {
			while ($user=$db->fetch_array($res)) {
				$i++;
				$text["txt"]=$data["text"];
				$text["html"]=$data["html"];
				
				if ($data["text"])
					$txt=$this->replaceMacros($conf["text"], $text, $conf, $user);
				if ($data["html"])
					$html=$this->replaceMacros($conf["html"], $text, $conf, $user);
				
				$mail = new htmlMimeMail();
				
				$mail->setSubject($data["subj"]);
				$mail->setFrom($conf["email_from"]);
				
				if ($html) {
					$mail->setHtmlEncoding("base64");
					$mail->setHTML($html, $txt, '');
				}
				elseif ($txt && !$html) {
					$mail->setText($txt);
				}
				
				$result = $mail->send(array($user["email"]));
			}
			
			$page++;
			//echo "Location: ?chid=".$this->chid."&action=send_Messages&id=".$this->id."&mid=$this->mid&page=$page;";
			header("Location: ?chid=".$this->chid."&action=send_Messages&id=".$this->id."&mid=$this->mid&page=$page&i=$i");
		}
		else {
			if ($this->page) {
				$count=10*($this->page-2)+$this->i;
				$_SESSION["warning"]="Писем отправлено: $count";
				$db->query("update subs_messages set date_sent=".time()." where id=$this->mid");
			}
			header("Location: ?chid=".$this->chid."&action=show_Messages&id=".$this->id."&w=1");
		}
	}

	function conf() {
		$db=new sql;
		$db->connect();
		$db->query("select * from subs_config");
		$d=$db->fetch_array($db->result);
		//$d["text"]=addslashes(str_replace("\r", "", $d["text"]));
		//$d["html"]=addslashes(str_replace("\r", "", $d["html"]));
		return $d;
	}

	function replaceMacros($tpl, $text, $conf, $user) {
		$what=array("COMMA_NAME", "NAME", "CHANGE_URL", "REMOVE_URL", "EMAIL", "TXT", "HTML", "CONFIRM_URL", "REGRET_URL");
		foreach ($what as $key => $value) {
			$what[$key]="'%$value%'";
		}
		$to=array((($user["name"]) ? ", ".$user["name"] : ""), $user["name"], "http://".getenv("HTTP_HOST").$conf["url"]."?user=".$user["id"]."&sid=".$user["salt"]."&action=change", "http://".getenv("HTTP_HOST").$conf["url"]."?user=".$user["id"]."&sid=".$user["salt"]."&action=remove", $user["email"], $text["txt"], $text["html"], "http://".getenv("HTTP_HOST").$conf["url"]."?user=".$user["id"]."&sid=".$user["salt"]."&action=confirm", "http://".getenv("HTTP_HOST").$conf["url"]."?user=".$user["id"]."&sid=".$user["salt"]."&action=regret");
		return preg_replace($what, $to, $tpl);
	}

	function add_AllUsers() {
		$db=new sql;
		$db->connect();
		if ($this->field) $page="&field=$this->field";
		if ($this->order) $page.="&order=$this->order";
		if ($this->page) $page.="&page=$this->page";
		$action="addApply_AllUsers$page";
		$header="Добавление подписчика";
		$res=$db->query("select * from subs_lists order by title");
		while ($data=$db->fetch_array($res)) {
			$lists.="<input name=\"lst[".$data["id"]."]\" type=\"checkbox\" value=\"1\" id=\"lst[".$data["id"]."]\"><label for=\"lst[".$data["id"]."]\">".$data["title"]."</label><br>";
		}
		eval('$content="'.admin::template("subscribeAllUsersAdd", "FORMPOST", array("fields[name]"=>"EXISTS", "fields[email]"=>"EXISTS")).'";');
		$this->elements["content"]=$content;
	}

	function addApply_AllUsers() {
		mt_srand ((double) microtime() * 1000000);
		$this->fields["salt"]=md5(mt_rand(100000000,999999999));
		$this->fields["approved"]=1;
		foreach($this->fields as $key => $value) {
			$query.="$key='".addslashes($value)."', ";
		}
		$query=substr($query, 0, strlen($s)-2);
		$db=new sql;
		$db->connect();
		$chid=$this->chid;
		$db->query("insert into subs_users set $query");
		$res=$db->query("select id from subs_users where salt='".$this->fields["salt"]."'");
		$data=$db->fetch_array($res);
		if (is_array($this->lst)) {
			foreach($this->lst as $key => $value) {
				$db->query("insert into subs_subscribed set lid=$key, sid=".$data["id"]);
			}
		}
		$page="&field=id&order=desc";
		header("Location: ?chid=".$this->chid."&action=show_AllUsers$page");
	}

	function delete_AllUsers() {
		$db=new sql;
		$db->connect();
		$db->query("delete from subs_subscribed where sid=".$this->id);
		$db->query("delete from subs_users where id=".$this->id);
		if ($this->field) $page="&field=$this->field";
		if ($this->order) $page.="&order=$this->order";
		if ($this->page) $page.="&page=$this->page";
		header("Location: ?chid=".$this->chid."&action=show_AllUsers$page");
	}

	function edit_AllUsers() {
		$db=new sql;
		$db->connect();
		$res=$db->query("select * from subs_users where id=$this->id");
		$data=$db->fetch_array($res);
		if ($this->field) $page="&field=$this->field";
		if ($this->order) $page.="&order=$this->order";
		if ($this->page) $page.="&page=$this->page";
		$action="editApply_AllUsers&id=$this->id$page";
		$header="Редактирование подписчика";
		if (!$data["approved"]) $approved="<p style=\"color: red; font-weight: bold;\"><label for=\"approved\">&nbsp;Подтвердить подписку </label><input name=\"fields[approved]\" value=\"1\" type=\"Checkbox\" id=\"approved\"></p>";
		$res2=$db->query("select * from subs_subscribed where sid=".$data["id"]);
		while ($data2=$db->fetch_array($res2)) {
			$lst[$data2["lid"]]=1;
		}
		$res1=$db->query("select * from subs_lists order by title");
		while ($data1=$db->fetch_array($res1)) {
			$lists.="<input name=\"lst[".$data1["id"]."]\" type=\"checkbox\" value=\"1\" id=\"lst[".$data1["id"]."]\"".(($lst[$data1["id"]]) ? " checked" : "")."><label for=\"lst[".$data1["id"]."]\">".$data1["title"]."</label><br>";
		}
		eval('$content="'.admin::template("subscribeAllUsersAdd", "FORMPOST", array("fields[name]"=>"EXISTS", "fields[email]"=>"EXISTS")).'";');
		$this->elements["content"]=$content;
	}

	function editApply_AllUsers() {
		foreach($this->fields as $key => $value) {
			$query.="$key='".addslashes($value)."', ";
		}
		$query=substr($query, 0, strlen($s)-2);
		$db=new sql;
		$db->connect();
		$chid=$this->chid;
		$db->query("update subs_users set $query where id=$this->id");
		$db->query("delete from subs_subscribed where sid=$this->id");
		if (is_array($this->lst)) {
			foreach($this->lst as $key => $value) {
				$db->query("insert into subs_subscribed set lid=$key, sid=".$this->id);
			}
		}
		if ($this->field) $page="&field=$this->field";
		if ($this->order) $page.="&order=$this->order";
		if ($this->page) $page.="&page=$this->page";
		header("Location: ?chid=".$this->chid."&action=show_AllUsers$page");
	}

	function show_Users () {
		$db=new sql;
		$db->connect();
		$res=$db->query("select * from subs_lists where id=$this->id");
		$data=$db->fetch_array($res);
		$listName=$data["title"];
		$res=$db->query("select * from subs_users left join subs_subscribed on subs_users.id=subs_subscribed.sid where lid=$this->id");
		if ($this->field) $page="&field=$this->field";
		if ($this->order) $page.="&order=$this->order";
		if ($this->page) $page.="&page=$this->page";
		while($data=$db->fetch_array($res)) {
			$i++;
			eval('$subscribeUsersTR.="'.admin::template("subscribeUsersTR").'";');
		}
		eval('$content="'.admin::template("subscribeUsersMain").'";');
		$this->elements["content"]=$content;
	}

	function add_Users () {
		$db=new sql;
		$db->connect();
		$db->query("delete from subs_subscribed where lid=$this->id");
		$res=$db->query("select id from subs_users");
		while ($data=$db->fetch_array($res)) {
			$db->query("insert into subs_subscribed set lid=$this->id, sid=$data[id]");
		}
		header("Location: ?chid=$this->chid&action=show_Users&id=$this->id");
	}
}
?>