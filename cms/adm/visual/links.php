<?php
$GLOBALS['now'] = gmdate('D, d M Y H:i:s') . ' GMT';
header('Expires: ' . $GLOBALS['now']); // rfc2616 - Section 14.21
header('Last-Modified: ' . $GLOBALS['now']);
header('Cache-Control: no-store, no-cache, must-revalidate, pre-check=0, post-check=0, max-age=0'); // HTTP/1.1
header('Pragma: no-cache'); // HTTP/1.0
include_once("../lib/adm.class.php");
define("_QUERY", "select id, pid, title, url from chapters");
define("_LANG", "$lng");
$db=new sql;
$db->connect();
$form_action="add.php?pid=$pid&lid=$lid";
$cid=$id;
$open_nodes=get_open_nodes($id);
$options=get_tree(0, $open_nodes);
eval("\$content=\"".admin::template("links", "","","../")."\";");
//eval('$item="'.$tpl->get("main").'";');
echo $content;
function get_open_nodes($id) {
	$db=new sql;
	$db->connect();
	if ($id) {
	$res=$db->query(_QUERY." where id=$id order by sortorder");
	while ($db->num_rows($res)>0) {
		$data=$db->fetch_array($res);
		$open_nodes[$data["id"]]=true;
		$res=$db->query(_QUERY." where id=".$data["pid"]);
	}
	}
	return $open_nodes;
}

function get_tree($id=0, $open_nodes, $level=0, $url="") {
	global $cid;
	$furl=$url;
	$level++;
	$style=($level==1) ? " style=\"margin-left: 0px; padding-left: 0px;\"" : "";
	$db=new sql;
	$db->connect();
	$res=$db->query(_QUERY." where pid=$id order by sortorder");
	if ($db->num_rows($res)>0) {
		$s.="<ul$style>\n";
		while ($data=$db->fetch_array($res)) {
			$gc=got_child($data["id"]);
			$img=($gc) ? (($open_nodes[$data["id"]]) ? "minus" : "plus") : "dot";
			$img1=($gc) ?  (($open_nodes[$data["id"]]) ? "folderopen" : "folder") :"page";
			$pid=($open_nodes[$data["id"]]) ? $data["pid"] : $data["id"];
			$checked=($data["id"]==$cid) ? " checked" : "";
			$url.="/".$data["url"];
			$a_o=($gc) ?  "<a href=\"?id=$pid\" class=\"$class\" id=\"tree\">" :"";
			$a_c=($gc) ?  "</a>" :"";
			$s.= "<li>$a_o<img src=\"../i/".$img.".gif\" alt=\"\" border=\"0\" align=\"absmiddle\" height=\"20\" width=\"20\" style=\"margin: 3px;\"><input type=\"radio\" name=\"sel\" id =\"sel\" value=\"".$url."/\" align=\"middle\" style=\"border-width: 0px\" onClick=\"onSelect()\"$checked><img src=\"../i/$img1.gif\" alt=\"\" border=\"0\" align=\"absmiddle\" height=\"20\" width=\"20\" style=\"margin: 3px;\"><span id=\"name".$data["id"]."\">".$data["title"]."</span>$a_c</li>\n";
			if ($open_nodes[$data["id"]]) $s.=get_tree($data["id"], $open_nodes, $level, $url);
			else $url=$furl;
		}
		$s.="</ul>\n";
		return $s;
	}
	else {
		return;
	}
}
function got_child($id) {
	$db=new sql;
	$db->connect();
	$res=$db->query(_QUERY." where pid=$id");
	if ($db->num_rows($res)>0) {
		return true;
		exit;
	}
	else {
		return false;
		exit;
	}
}
?>