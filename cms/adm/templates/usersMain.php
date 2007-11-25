<script language="JavaScript">
function submit_delete()	{
	return confirm('<?php echo __("Delete selected record?") ?>')
}
</script>
<p><a href="?chid=<? echo $ref->chid ?>&action=add" class="addnew"><img src="i/add.gif" alt="<?php echo __("Add new") ?>" width="16" height="16" border="0" hspace="3" align="absmiddle"><?php echo __("Add new") ?></a></p>
<table cellspacing="0" cellpadding="5" width="100%">
<tr>
	<th width="5%"><?php echo __("#") ?></th>
	<th width="95%"><?php echo __("Name") ?></th>
	<th><?php echo __("Login") ?></th>
	<th><?php echo __("Admin") ?></th>
	<th><?php echo __("Action") ?></th>
</tr>
<?php echo $this->usersTR ?>
</table>