<?php
	include_once("../include/auth1.php");
	$url="www.usoft.ru";
	$uf=$HTTP_POST_FILES['ul_file'];
	include_once "../include/config.inc.php";
	include_once("../include/class.Template.php");
	include_once "../include/htmlmimemail/htmlMimeMail.php";
	$tpl=new Template("templates");
	if (!isset($a)) {
	}
	elseif ($t=='l') {
	$bn.="&nbsp;&mdash; Рассылки";
	$cn.="&nbsp;&mdash; Рассылки";
	if ($a=='v') {
		$db=new sql;
		$db->connect();
		$db->query("select * from subs_lists order by id");
		$nr=$db->num_rows($db->result);
		$content="<table style=\"font-size: 80%;\" cellpadding=5 cellspacing=1 width=50% bgcolor=silver><thead bgcolor=\"silver\"><td>Наименование</td><td>Действие</td></thead><tbody bgcolor=white>";
		while($data=$db->fetch_array($db->result)) {
			$i++;
			$pic=($nr==$i) ? "" : "bottom";
			$counter=!$counter;
			$style=($counter) ? " style=\"background-color: #F8F8F8;\"" : " style=\"background-color: #FFFFFF;\"";
			$content.="<tr$style><td width=100%>".htmlspecialchars($data["title"])."</td><td align=center><a href=\"?type=mod&mod_id=2&t=l&a=e&id=".$data["id"]."\" class=\"buttons\"><img src=\"img/edit.gif\" alt=\"$lang[edit_record]\" width=\"9\" height=\"9\" border=\"0\"></a>&nbsp;<a href=\"?type=mod&mod_id=2&t=l&a=d&id=".$data["id"]."\" class=\"buttons\" onClick=\"return submitdelete()\"><img src=\"img/del.gif\" alt=\"Удалить запись\" width=\"9\" height=\"9\" border=\"0\"></a></td></tr>";
		}
		$content.="</tbody></table><br><a href=\"?type=mod&mod_id=2&t=l&a=a\">Новая рассылка</a>";
	}
	if ($a=='d') {
		$db=new sql;
		$db->connect();
		$db->query("delete from subs_lists where id=$id");
		$db->query("delete from subs_subscribed where lid=$id");
		header("Location: ?type=mod&mod_id=2&t=l&a=v");
	}
	if ($a=='a') {
		$action="?type=mod&mod_id=2&t=l&a=aa";
		$page_title="Новая рассылка";
		eval("\$content=\"".$tpl->get("mail_list_item")."\";");
	}
	if ($a=='aa') {
		$db=new sql;
		$db->connect();
		$db->query("insert into subs_lists values('', '$title_list', '$period', '$description', '')");
		header("Location: ?type=mod&mod_id=2&t=l&a=v");
	}
	if ($a=='e') {
		$db=new sql;
		$db->connect();
		$page_title="Редактирование рассылки";
		$db->query("select * from subs_lists where id=$id");
		$data=$db->fetch_array($db->result);
		$data["title"]=htmlspecialchars($data["title"]);
		$action="?type=mod&mod_id=2&t=l&a=ea&id=$id";
		eval("\$content=\"".$tpl->get("mail_list_item")."\";");
	}
	if ($a=='ea') {
		$db=new sql;
		$db->connect();
		$db->query("update subs_lists set title='$title_list', period='$period', description='$description' where id='$id'");
		header("Location: ?type=mod&mod_id=2&t=l&a=v");
	}
	}
	elseif ($t=="m") {
	$bn.="&nbsp;&mdash; Сообщения";
	$cn.="&nbsp;&mdash; Сообщения";
	if ($a=='v') {
		$db=new sql;
		$db->connect();
		$r=$db->query("select * from subs_lists order by id");
		$content=(isset($s)) ? "Было успешно отослано $s ".ruAmmount($s, array("сообщение", "сообщения", "сообщений")).".<br><br>\n" : "";
		$content.="<table style=\"font-size: 80%;\" cellpadding=5 cellspacing=1 width=50% bgcolor=silver>\n<tbody bgcolor=white>\n";
		while($d=$db->fetch_array($r)) {
			$res=$db->query("select * from subs_messages where lid='".$d["id"]."' order by id desc limit 0, 10");
			$nr=$db->num_rows($res);
			$content.="<tr bgcolor=#F8F8F8>\n\t<td colspan=2><b>".$d['title'].'</b>&nbsp;('.$d['period'].')&nbsp;<a href="?type=mod&mod_id=2&t=m&a=a&lid='.$d["id"].'" class="buttons"><img src="img/add.gif" alt="Добавить запись" width="9" height="9" border="0"></a>'."</td>\n</tr>\n";
			while($data=$db->fetch_array($db->result)) {
				$i++;
				$pic=($nr==$i) ? "" : "bottom";
				$sent=($data["date_sent"]==0) ? '&nbsp;(<a href="?type=mod&mod_id=2&t=m&a=p&id='.$data["id"].'">Разослать</a>)&nbsp;(<a href="?type=mod&mod_id=2&t=m&a=t&id='.$data["id"].'">Тест</a>)' : '&nbsp;(<span style="font-size: 10px;">'.date("d.m.y H:i", $data["date_sent"]).'</span>)';
				$content.="<tr>\n\t<td>&nbsp;</td>\n\t<td>".$data["subj"]." &nbsp; <a href=\"?type=mod&mod_id=2&t=m&a=e&id=".$data["id"]."\" class=\"buttons\"><img src=\"img/edit.gif\" alt=\"Редактировать запись\" width=\"9\" height=\"9\" border=\"0\"></a>&nbsp;<a href=\"?type=mod&mod_id=2&t=m&a=d&id=".$data["id"]."\" class=\"buttons\"><img src=\"img/del.gif\" alt=\"Удалить запись\" width=\"9\" height=\"9\" border=\"0\" onClick=\"return submitdelete()\"></a>$sent</td>\n</tr>";
			}
		}
		$content.="</tbody>\n</table>";
	}
	if ($a=='d') {
		$db=new sql;
		$db->connect();
		$db->query("delete from subs_messages where id=$id");
		header("Location: ?type=mod&mod_id=2&t=m&a=v");
	}
	if ($a=='a') {
		$action="?type=mod&mod_id=2&t=m&a=aa";
		$par="lid";
		$id=$lid;
		$db=new sql;
		$db->connect();
		$page_title="Новое сообщение";
		$db->query("select * from subs_lists order by id");
		$dis="";
		while($data=$db->fetch_array($db->result)) {
			if ($data['id']==$lid) {
				$sel="selected";
				$subj=$data["title"];
			}
			else
				$sel="";
			$options.='		<option value="'.$data['id'].'"'.$sel.'>'.$data['title'].'</option>';
		}
		unset($data);
		$data["subj"]=htmlspecialchars($subj);
		eval("\$content=\"".$tpl->get("mail_message_item")."\";");
	}
	if ($a=='aa') {
		$db=new sql;
		$db->connect();
		if (is_uploaded_file($uf['tmp_name']))
    		copy($uf['tmp_name'], getenv("DOCUMENT_ROOT")."/adm/dl/".$uf['name']);
				chmod (getenv("DOCUMENT_ROOT")."/adm/dl/".$uf['name'], 777);
		$db->query("insert into subs_messages values('', $lid, '$subj', '$text', '$html','','".$uf['name']."')");
		header("Location: ?type=mod&mod_id=2&t=m&a=v");
	}
	if ($a=='e') {
		$db=new sql;
		$db->connect();
		$par="id";
		$page_title="Редактирование сообщения";
		$action="?type=mod&mod_id=2&t=m&a=ea&id=$id";
		$db->query("select * from subs_messages where id=$id");
		$data=$db->fetch_array($db->result);
		$db->query("select * from subs_lists order by id");
		while($d=$db->fetch_array($db->result)) {
			$sel=($d['id']==$data["lid"]) ? " selected" : "";
			$options.='		<option value="'.$d['id'].'"'.$sel.'>'.$d['title'].'</option>';
		}
		$data["subj"]=htmlspecialchars($data["subj"]);
		eval("\$content=\"".$tpl->get("mail_message_item")."\";");
	}
	if ($a=='ea') {
		$db=new sql;
		$db->connect();
		if (is_uploaded_file($uf['tmp_name'])) {
    		copy($uf['tmp_name'], getenv("DOCUMENT_ROOT")."/adm/dl/".$uf['name']);
			$f=", file='".$uf['name']."'";
		}
		$db->query("update subs_messages set lid='$lid', subj='$subj', text='$text', html='$html'$f where id='$id'");
		header("Location: ?type=mod&mod_id=2&t=m&a=v");
	}
	if ($a=='p') {
		$conf=conf();
		eval("\$conf[email_from]=\"".$conf["email_from"]."\";");
		$ef=$conf["email_from"];
		if (!$num) $num=1;
		$db=new sql;
		$db->connect();
		$db->query("select * from subs_messages where id=$id");
		$data=$db->fetch_array($db->result);
		$db->query("select subs_users.* from subs_users left join subs_subscribed on subs_users.id = subs_subscribed.sid where lid=".$data["lid"]." limit ".($num-1).", 10");
		if ($db->num_rows($db->result)) {
			$num+=10;
			$lid=$data["lid"];
			while ($d=$db->fetch_array($db->result)) {
				if ($d["approved"]==1) {
					$i++;
					
					$mail = new htmlMimeMail();
					if ($data["file"]) $mail->addAttachment($mail->getFile("dl/".$data["file"]), $data["file"]);
					$mail->setSubject($data["subj"]);
					$mail->setFrom($ef);
					$d["name"]=($d["name"]) ? ", ".$d["name"] : "";
					$e=$d["email"];
					$x=$d["salt"];
					$conf=conf();
					if ($data["text"])
						eval("\$text=\"".$conf["text"]."\";");
					if ($data["html"]) {
						$content=$data["html"];
						eval("\$html=\"".$conf["html"]."\";");
						$mail->setHTML($html, $text, '');
					}
					elseif ($data["text"] && !$data["html"]) {
						$mail->setText($text);
					}
					$result = $mail->send(array($d["email"]));
					$i++;
				}
			}
			header("Location: ?type=mod&mod_id=2&t=m&a=p&id=$id&num=$num");
		}
		else {
			$tm=time();
			$db->query("update subs_lists set lastsend='$tm' where id=$data[lid]");
			$db->query("update subs_messages set date_sent='$tm' where id=$id");
			header("Location: ?type=mod&mod_id=2&t=m&a=v&s=$i");
		}
	}
	if ($a=='t') {
		$conf=conf();
		$db=new sql;
		$db->connect();
		$db->query("select * from subs_messages where id=$id");
		$data=$db->fetch_array($db->result);
		$mail = new htmlMimeMail();
		if ($data["file"]) $mail->addAttachment($mail->getFile("dl/".$data["file"]), $data["file"]);
		eval("\$conf[email_from]=\"".$conf["email_from"]."\";");
		$mail->setSubject($data["subj"]);
		$mail->setFrom($conf["email_from"]);
		$db->query("select subs_users.* from subs_users where email='".$conf["test_email"]."'");
		$lid=$data["lid"];
		$d=$db->fetch_array($db->result);
		$data["name"]=($d["name"]) ? ", ".$d["name"] : "";
		$e=$d["email"];
		$x=$d["salt"];
		if ($data["text"])
			eval("\$text=\"".$conf["text"]."\";");
		if ($data["html"]) {
			$content=$data["html"];
			eval("\$html=\"".$conf["html"]."\";");
			$mail->setHTML($html, $text, '');
		}
		elseif ($data["text"] && !$data["html"]) {
			$mail->setText($text);
		}
		$result = $mail->send(array($conf["test_email"]));
		$i++;
		header("Location: ?type=mod&mod_id=2&t=m&a=v&s=$i");
	}
	}
	elseif ($t=='u') {
	$bn.="&nbsp;&mdash; Подписчики";
	$cn.="&nbsp;&mdash; Подписчики";
	if ($a=='v') {
		$db=new sql;
		$db->connect();
		$db->query("select * from subs_users order by id");
		$nr=$db->num_rows($db->result);
		$content='<a href="?type=mod&mod_id=2&t=u&a=a">Добавить подписчика</a><br><br>
		<table style="font-size: 80%;" cellpadding=5 cellspacing=1 width=50% bgcolor=silver>
<thead bgcolor="silver"><tr><td>E-mail</td><td>Действие</td></tr></thead>
<tbody bgcolor=white>';
		while($data=$db->fetch_array($db->result)) {
			$i++;
			$counter=!$counter;
			$style=($counter) ? " style=\"background-color: #F8F8F8;\"" : " style=\"background-color: #FFFFFF;\"";
			$content.="<tr><td width=100%>".$data["email"]."</td><td align=center><a href=\"?type=mod&mod_id=2&t=u&a=e&id=".$data["id"]."\" class=\"buttons\"><img src=\"img/edit.gif\" alt=\"Редактировать запись\" width=\"9\" height=\"9\" border=\"0\"></a>&nbsp;<a href=\"?type=mod&mod_id=2&t=u&a=d&id=".$data["id"]."\" class=\"buttons\"><img src=\"img/del.gif\" alt=\"Удалить запись\" width=\"9\" height=\"9\" border=\"0\" onClick=\"return submitdelete()\"></a></td></tr>";
		}
		$content.="</tbody></table>";
	}
	if ($a=='d') {
		$db=new sql;
		$db->connect();
		$db->query("delete from subs_users where id=$id");
		header("Location: ?type=mod&mod_id=2&t=u&a=v");
	}
	if ($a=='a') {
		$db=new sql;
		$db->connect();
		$action="?type=mod&mod_id=2&t=u&a=aa";
		$page_title="Новый подписчик";
		$onsubmit=' onClick="return validateForm();"';
		$checked=" checked";
		$subs_rs=$db->query("select * from subs_lists order by id");
		while($subs_data=$db->fetch_array($subs_rs)) {
			$lists.='		<div><input type="checkbox" name="l['.$subs_data['id'].']" value="" checked><b>'.$subs_data['title'].'</b></div><div>'.$subs_data['description'].'</div><br>';
		}
		$checked=" checked";
		eval("\$content=\"".$tpl->get("mail_user_item")."\";");
	}
	if ($a=='aa') {
		$db=new sql;
		$db->connect();
		mt_srand ((double) microtime() * 1000000);
		$salt=md5(mt_rand(100000000,999999999));
		$salt=substr($salt, 0,20);
		$approved=(isset($approved)) ? 1 : 0;
		$db->query("insert into subs_users values('', '$name', '$email', '$city', '$country', '$salt', '$approved')");
		$ret=$db->query("select * from subs_users where salt='$salt'");
		$det=$db->fetch_array($ret);
		$id=$det["id"];
		if (isset($l)) {
		foreach($l as $k=>$v) {
			$db->query("insert subs_subscribed values ('$k', '$id')");
		}
		}
		header("Location: ?type=mod&mod_id=2&t=u&a=v");
	}
	if ($a=='e') {
		$db=new sql;
		$db->connect();
		$page_title="Редактирование подписчика";
		$onsubmit=' onClick="return validateForm();"';
		$db->query("select * from subs_users where id=$id");
		$data=$db->fetch_array($db->result);
		$action="?type=mod&mod_id=2&t=u&a=ea&id=$id";
		$checked=($data["approved"]) ? " checked" : "";
		$db->query("select * from subs_subscribed where sid=$id");
		while($ld=$db->fetch_array($db->result)) {
			$l[$ld["lid"]]=1;
		}
		$subs_rs=$db->query("select * from subs_lists order by id");
		while($subs_data=$db->fetch_array($subs_rs)) {
			$lists.='		<div><input type="checkbox" name="l['.$subs_data['id'].']" value=""'.((isset($l[$subs_data['id']])) ? ' checked' : '').'><b>'.$subs_data['title'].'</b></div><div>'.$subs_data['description'].'</div><br>';
		}
		eval("\$content=\"".$tpl->get("mail_user_item")."\";");
	}
	if ($a=='ea') {
		$db=new sql;
		$db->connect();
		$approved=(isset($approved)) ? 1 : 0;
		$db->query("update subs_users set name='$name', email='$email', city='$city', country='$country', approved='$approved' where id='$id'");
		$db->query("delete from subs_subscribed where sid=$id");
		if (isset($l)) {
		foreach($l as $k=>$v) {
			$db->query("insert subs_subscribed values ('$k', '$id')");
		}
		}
		header("Location: ?type=mod&mod_id=2&t=u&a=v");
	}
}
elseif ($t=="c") {
	$bn.="&nbsp;&mdash; Настройка";
	$cn.="&nbsp;&mdash; Настройка";
	if ($a=="v") {
		$db=new sql;
		$db->connect();
		$db->query("select * from subs_config");
		$data=$db->fetch_array($db->result);
		$data["text"]=htmlspecialchars($data["text"]);
		$data["html"]=htmlspecialchars($data["html"]);
		$action="?type=mod&mod_id=2&t=c&a=a";
		eval("\$content=\"".$tpl->get("mail_conf")."\";");
	}
	if ($a=='a') {
		$db=new sql;
		$db->connect();
		$db->query("update subs_config set test_email='$test_email', text='$text', html='$html', title='$title_conf', url='$url_conf', email_from='$email_from', confirmation='$confirmation', success='$success'");
		header("Location: ?type=mod&mod_id=2&t=c&a=v");
	}
}
function conf() {
	$db=new sql;
	$db->connect();
	$db->query("select * from subs_config");
	$d=$db->fetch_array($db->result);
	$d["text"]=addslashes(str_replace("\r", "", $d["text"]));
	$d["html"]=addslashes(str_replace("\r", "", $d["html"]));
	return $d;
}
?>