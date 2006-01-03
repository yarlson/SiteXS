<script language="JavaScript" type="text/javascript">
function showVE(id, field) {
	var w=window.open("ve.php?f="+field, '','statusbar=yes,scrollbars=no,toolbars=no,menubar=yes,resizable=yes');
	return false;
}
var wE=new Array();
var i;
</script>
<link rel="stylesheet" href="we/wikiedit.css" type="text/css">
<script language="JavaScript" src="we/protoedit.js"></script>
<script language="JavaScript" src="we/wikiedit2.js"></script>
<form action="?chid=$chid&action=append" method="post" name="FORMPOST">
<p><a href="?chid=$chid&action=addParam"><?php echo __("Add new parameter") ?></a></p>
<table width="100%" style="font-size: 100%;font-weight: bold;">
<?php echo $confItem ?>
</table>
<p align="center"><input type="submit" value="<?php echo __("Save") ?>"></p>
</form>
