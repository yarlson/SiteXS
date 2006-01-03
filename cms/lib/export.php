#!/usr/local/bin/php
<?php
$socket = fsockopen("m-2.m-2.ru", 80);

fputs($socket,"GET /subscribe/news.asp HTTP/1.0\nHOST: m-2.m-2.ru\n\n");

while(fgets($socket,31337)!="\r\n" && !feof($socket)){

unset($buffer); }
include "/www/vhosts/award.m-2.ru/adm/lib/htmlcleaner.php";
include "/www/vhosts/award.m-2.ru/lib/db.conf.php";
include "/www/vhosts/award.m-2.ru/lib/mysql.class.php";
$db=new sql;
$db->connect();
$hc=new htmlcleaner;
$s=$hc->cleanup(stripslashes($s));
while(!feof($socket)) {
	$buffer.=fread($socket, 1024);
}
$lines=explode("\n", $buffer);
foreach ($lines as $key => $value) {
	if (trim($value)) {
		$tmp=explode("|||", trim($value));
		preg_match("'(\d{1,2})\.(\d{1,2})\.(\d{1,4}) (\d{1,2}):(\d{1,2}):(\d{1,2})'", $tmp[1], $time_arr);
		$tmp[1]= mktime($time_arr[4], $time_arr[5], $time_arr[6], $time_arr[2], $time_arr[1], $time_arr[3]);
		$tmp[3]=str_replace("\\n", "||||||||n", $tmp[3]);
		$tmp[3]=$hc->cleanup(stripslashes($tmp[3]));
		$tmp[3]=str_replace("||||||||n", "\\n", $tmp[3]);
		$res=$db->query("select id from news where matID=$tmp[0]");
		if (!$db->num_rows($res)) {
			$db->query("insert into news set time='$tmp[1]', title='$tmp[2]', text='$tmp[3]', matID='$tmp[0]'");
		}
		$arr[]=$tmp;
	}
}
print_r ($arr);

?>