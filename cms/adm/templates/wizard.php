<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Wizard</title>
	<style>
	body {background: AppWorkspace; margin: 0; font-family: 'MS Sans Serif', sans-serif;font-size: 12px;}
	input {font-family: 'MS Sans Serif', sans-serif;font-size: 11px;}
	table {font-size: 12px;}
	</style>
</head>

<body style="">
<table cellspacing="0" cellpadding="0" width="100%" style="height: 100%;">
<tr>
	<td style="height: 100%;" valign="middle" align="center">
<form action="wizard.php?action=$action" method="post" id="s" name="s">
<table cellspacing="0" cellpadding="10" width="400">
<tr>
	<td style="background: Window; border-bottom: 1px solid ButtonShadow;font-weight: bold;">$caption</td>
</tr>
<tr>
	<td style="background: ButtonFace; border-top: 1px solid ButtonHighlight; border-bottom: 1px solid ButtonShadow;height: 200px;">
$content
	</td>
</tr>
<tr>
	<td style="background: ButtonFace; border-top: 1px solid ButtonHighlight;" align="right"><input type="button" value="&lt; <?php echo __("Назад") ?>" style="width: auto;" onclick="javascript: history.go(-1);">&nbsp;&nbsp;<input type="submit" value="<?php echo __("Далее") ?> &gt;" style="width: auto;"></td>
</tr>
</table>
</form>
	</td>
</tr>
</table>

</body>
</html>
