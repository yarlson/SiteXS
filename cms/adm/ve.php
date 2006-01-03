<?php
header("Content-type: text/html; charset=windows-1251");
include_once("lib/adm.class.php");
$field=urldecode($_GET["f"]);
eval("\$content=\"".admin::template("ve")."\";");
echo $content;
?>