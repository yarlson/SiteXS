<script language="JavaScript" type="text/javascript">
function showVE(id, field) {
	var w=window.open("ve.php?f="+field, '','statusbar=yes,scrollbars=no,toolbars=no,menubar=yes,resizable=yes');
	return false;
}
var wE=new Array();
var i;
</script>

<form action="?chid=<?php echo $this->chid ?>&action=append" method="post" name="FORMPOST">
<p><a href="?chid=<?php echo $this->chid ?>&action=addParam" class="addnew"><img src="i/add.gif" alt="<?php echo __("Add new") ?>" width="16" height="16" border="0" hspace="3" align="absmiddle"><?php echo __("Add new") ?></a></p>
<p align="center"><input type="submit" value="<?php echo __("Save") ?>" class="save"></p>
<table width="100%" style="font-size: 100%;font-weight: bold;">
<?php echo $this->confItem ?>
</table>
<p align="center"><input type="submit" value="<?php echo __("Save") ?>" class="save"></p>
</form>
