<?php
$dr=preg_replace("'/$'", "", getenv("DOCUMENT_ROOT"));
include $dr."/lib/streams.php";
include $dr."/lib/gettext.php";
include $dr."/lib/l10n.php";
include_once "lib/adm.class.php";
$admin=new admin();
$GLOBALS['now'] = gmdate('D, d M Y H:i:s') . ' GMT';
header('Expires: ' . $GLOBALS['now']); // rfc2616 - Section 14.21
header('Last-Modified: ' . $GLOBALS['now']);
header('Cache-Control: no-store, no-cache, must-revalidate, pre-check=0, post-check=0, max-age=0'); // HTTP/1.1
header('Pragma: no-cache'); // HTTP/1.0
header("Content-Type: text/html; charset=windows-1251");
echo $admin->getAll();
?>