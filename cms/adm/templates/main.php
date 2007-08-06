<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title><?php echo $ref->page_title ?></title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="header">
<div><?php echo __("Current user") ?>: <strong><a href="?chid=7&action=edit&id=<?php echo $this->user_id ?>"><?php echo $ref->user ?></a></strong>&nbsp; &nbsp;<a href="?action=logout" style="font-size: 11px;"><img src="i/logout.gif" alt="" width="16" height="16" hspace="6" border="0" align="absmiddle"><?php echo __("Log out") ?></a></div>
<?php if ($ref->id>1) { ?><a href="./"><?php } ?><img src="i/logo.gif" alt="" width="101" height="44" border="0"><?php if ($ref->id>1) { ?></a><?php } ?>
</div>
<div id="container">
<div id="menu"><?php echo $ref->elements["menu"] ?></div>
<div id="subMenu"><?php echo $ref->elements["subMenu"] ?></div>
<div id="content">
<?php echo $ref->elements["title"] ?>
<?php echo $ref->content ?>
</div>
</div>
</body>
</html>
