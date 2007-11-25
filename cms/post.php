<?php
session_start();
$dr= "D:\\vhosts\\yarlson.net.ru\\mifs";

include $dr."/lib/db.conf.php";
include $dr."/lib/mysql.class.php";
include $dr."/lib/modules/".$_POST["type"].".class.php";

$mod= new $_POST["type"]("", "", "");
if (method_exists($mod, "_POST")) {
	$mod->_POST($_POST);
}
?>