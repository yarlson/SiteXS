<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>$page_title</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<table cellspacing="0" cellpadding="5" width="100%" style="height: 100%;">
<tr>
	<td colspan="2">
<table cellspacing="0" cellpadding="5" width="100%">
<tr>
	<td><img src="i/logo.gif" alt="" width="102" height="40" border="0"></td>
	<td id="login" align="right"><?php echo __("Current user") ?>: <strong><a href="?chid=9&action=edit&id=$this->user_id"><?php echo $ref->user ?></a></strong>&nbsp; &nbsp;<a href="?action=logout" style="font-size: 11px;"><img src="i/logout.gif" alt="" width="16" height="16" hspace="6" border="0" align="absmiddle"><?php echo __("Log out") ?></a></td>
</tr>
</table>
	</td>
</tr>
<tr>
	<td colspan="2" style="padding: 0px;"><div id="menu"><?php echo $ref->elements["menu"] ?></div></td>
</tr>
<tr>
	<td valign="top" id="subMenu"><div><?php echo $ref->elements["subMenu"] ?></div></td>
	<td id="content" valign="top" style="height: 100%;" width="100%">
<p><?php echo $ref->elements["title"] ?></p>
<?php echo $ref->content ?>
	</td>
</tr>
</table>
</body>
</html>
