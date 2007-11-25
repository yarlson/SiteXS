<?php
header("Content-type: text/html; charset=utf-8");
$dr=preg_replace("'/$'", "", getenv("DOCUMENT_ROOT"));
include $dr."/lib/streams.php";
include $dr."/lib/gettext.php";
include $dr."/lib/l10n.php";
include_once("lib/adm.class.php");
$field=urldecode($_GET["f"]);
$content=admin::template("ve", $field);
echo $content;
?>