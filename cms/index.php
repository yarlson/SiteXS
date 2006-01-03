<?php


$dr= preg_replace("'/$'", "", getenv("DOCUMENT_ROOT"));

include_once $dr."/lib/streams.php";
include_once $dr."/lib/gettext.php";
include_once $dr."/lib/l10n.php";

include_once $dr."/lib/db.conf.php";
include_once $dr."/lib/mysql.class.php";
include_once $dr."/lib/page.class.php";

$page=new page;

$page->parseURI();$page->findPath();$page->sendHeader();$page->getElements();$page->getConfig();


if ($page->get["version"]=="forprint") 
	$template_name="mainPr";
elseif ($page->dirs["id"][$page->dirs["count"]-1]!=1)
	$template_name="second";
else
	$template_name="main";

$main=$page->template($template_name, $page);

echo $main;

?>