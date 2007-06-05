<?php
$dr=preg_replace("'/$'", "", getenv("DOCUMENT_ROOT"));

include $dr."/lib/streams.php";

include $dr."/lib/gettext.php";

include $dr."/lib/l10n.php";
$step=($_GET["step"]) ? $_GET["step"] : 0;
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
a, a:visited {
	color: #00274F;
}
a:hover {
	color: #8B0000;
}
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
.big input {font-size: 100%; width: 10em;}
.link {background: #FF9200; color: white; font-size: 2em;padding: 0.5em;}
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
<p align="center"><a href="install.php?step=1" class="link"><?php echo __("Go to the first step") ?>&raquo;</?php></a></p>
<?php
	break;
	case 1:
 ob_start();
 phpinfo(INFO_MODULES);
 $s = ob_get_contents();
 ob_end_clean();
 
 $s = strip_tags($s,'<h2><th><td>');
 $s = preg_replace('/<th[^>]*>([^<]+)<\/th>/',"<info>\\1</info>",$s);
 $s = preg_replace('/<td[^>]*>([^<]+)<\/td>/',"<info>\\1</info>",$s);
 $vTmp = preg_split('/(<h2>[^<]+<\/h2>)/',$s,-1,PREG_SPLIT_DELIM_CAPTURE);
 $vModules = array();
 for ($i=1;$i<count($vTmp);$i++) {
  if (preg_match('/<h2>([^<]+)<\/h2>/',$vTmp[$i],$vMat)) {
   $vName = trim($vMat[1]);
   $vTmp2 = explode("\n",$vTmp[$i+1]);
   foreach ($vTmp2 AS $vOne) {
    $vPat = '<info>([^<]+)<\/info>';
    $vPat3 = "/$vPat\s*$vPat\s*$vPat/";
    $vPat2 = "/$vPat\s*$vPat/";
    if (preg_match($vPat3,$vOne,$vMat)) { // 3cols
     $vModules[$vName][trim($vMat[1])] = array(trim($vMat[2]),trim($vMat[3]));
    } elseif (preg_match($vPat2,$vOne,$vMat)) { // 2cols
     $vModules[$vName][trim($vMat[1])] = trim($vMat[2]);
    }
   }
  }
 }
 echo "<div>".__("Web-server").": ".$vModules["apache"]["Apache Version"]."</div>";
 echo "<div>".__("MySQL").": ".$vModules["mysql"]["Client API version"]."</div>";
 break;
}
?>
	</td>
</tr>
</table>
</body>
</html>
