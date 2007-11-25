<?php
if ($_GET["step"]==2 && !($_POST["dbhost"] && $_POST["dbname"] && $_POST["dbuser"])) header("Location: install.php?step=1");

$dr=preg_replace("'/$'", "", getenv("DOCUMENT_ROOT"));

include $dr."/lib/streams.php";
include $dr."/lib/gettext.php";
include $dr."/lib/l10n.php";

$step=($_GET["step"]) ? $_GET["step"] : 0;

function show_error($message) {
	echo "<div class=\"warning\">".__("Oops!")." ".$message."</div></div><p align=\"center\"><a href=\"#\" class=\"link\" onclick=\"javascript:history.go(-1);return false;\">&laquo;".__("Back")."</a></p>";
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>SiteXS <?php echo __("installation") ?></title>
	<style>
	body {
	font-size: 82%;
	margin: 0;
	font-family: tahoma;
}
table, p, div {
	font-size: 100%;;
}
h1 {font-size: 2em;}
img {
	border: none;
}
#content {
	background: #FFF;
	min-height: 300px;
	_height: 300px;
	height: auto;
	margin: 1em 20px;
	padding: 1em;
}
.big {font-size: 2em;}
.big input {font-size: 100%; min-width: 10em;_width: 10em;}
.link {background: #FF9200; color: white; font-size: 2em;padding: 0.5em;color: white}
a.link {color: white;}
	</style>
</head>

<body>

<table cellspacing="0" cellpadding="5" width="100%" style="height: 100%;">
<tr>
	<td colspan="2" align="center" id="content">
<div class="big">
<?php
switch ($step) {
	case 0:
?>
<h1><?php echo __("Welcome to SiteXS installation!") ?></h1>
</div>
<p align="center"><a href="install.php?step=1" class="link"><?php echo __("Proceed to the first step") ?>&raquo;</?php></a></p>
<?php
	break;
	case 1:
?>
	<h1>First step</h1>
	<form action="install.php?step=2" method="post">
	<table>
	<tr>
		<td><?php echo __("DB host:port") ?></td><td><input name="dbhost" value="localhost:3306"></td>
	</tr>
	<tr>
		<td><?php echo __("DB name") ?></td><td><input name="dbname"></td>
	</tr>
	<tr>
		<td><?php echo __("DB user") ?></td><td><input name="dbuser"></td>
	</tr>
	<tr>
		<td><?php echo __("DB password") ?></td><td><input name="dbpassword" type="password"></td>
	</tr>
	</table>
	<p><input type="submit" value="<?php echo __("Proceed to the next step") ?>&raquo;" size="20" class="link"></p>
	</form>
	</div>
<?php
		break;
	case 2:
		$db=@mysql_connect($_POST["dbhost"], $_POST["dbuser"], $_POST["dbpassword"]);
		if ($db) {
			$db_sel=@mysql_select_db($_POST["dbname"], $db);
			if (!$db_sel) $db_cr=@mysql_query("create database ".$_POST["dbname"], $db);
			if (mysql_affected_rows($db)) $db_sel=@mysql_select_db($_POST["dbname"], $db);
			if ($db_sel){
				$templine = '';
				$lines = file("adm/sitexs.sql");
				mysql_query("SET NAMES 'utf8'", $db);
				foreach ($lines as $line_num => $line) {
					if (substr($line, 0, 2) != '--' && $line != '') {
						$templine .= $line;
						if (substr(trim($line), -1, 1) == ';') {
							mysql_query($templine, $db);
							$templine = '';
						}
					}
				}
				if(is_writable("lib/db.conf.php")) {
					$f=fopen("lib/db.conf.php", "w+");
					$conf=array("<?php", "\$DB[\"host\"]=\"".$_POST["dbhost"]."\";", "\$DB[\"dbName\"]=\"".$_POST["dbname"]."\";", "\$DB[\"user\"]=\"".$_POST["dbuser"]."\";", "\$DB[\"pass\"]=\"".$_POST["dbpassword"]."\";", "?>");
					foreach ($conf as $line) {
						fwrite($f, $line."\n");
					}
					fclose($f);
					$pass=substr(md5(microtime()), 0,8);
					mysql_query("update users set pass=md5('".$pass."') where login='admin'", $db);
					echo "<h1>".__("Congratulations")."!</h1>";
					echo "<h1>".__("Done")."!</h1></div>";
					echo "<p style=\"margin: 0 0 3em 0;\">".__("Use")." ".__("login").": <b>admin</b> ".__("and password").": <b>".$pass."</b></p>";
?>
					<p align="center"><a href="/adm/" class="link"><?php echo __("Sign in") ?>&raquo;</a></p>
<?php
					
				}
				else {
					show_error(__("Cannot write to lib/db.conf.php!"));
				}
			}
			else {
				show_error(__("Cannot select or create db!"));
			}
		}
		else {
			show_error(__("Cannot connect to MySQL server!"));
		}
	break;
}
?>

	</td>
</tr>
</table>
</body>
</html>
