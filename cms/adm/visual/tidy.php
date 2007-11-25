<?php
$s=urldecode($_POST["s"]);
include_once "../lib/htmlcleaner.php";
$hc=new htmlcleaner;
$s=$hc->cleanup(stripslashes($s));
$from=array("«", "»", "%u2013", " &mdash;", " -", "cellpadding=\"0\"", "<p>&nbsp;</p>\n</td>", "<p></p>", "©", "®", "%u2122", "&nbsp; </td>");
$to=array("&laquo;", "&raquo;", "&mdash;", "&nbsp;&mdash;", "&nbsp;&mdash;", "cellpadding=\"5\"", "&nbsp;\n</td>", "", "&copy;", "&reg;", "<SUP><FONT SIZE=\"-1\">TM</FONT></SUP>","&nbsp;</td>");
$s=str_replace($from, $to, $s);
echo $s;
?>