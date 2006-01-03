<script language="JavaScript">
function submit_delete()	{
	return confirm('<?php echo __("Delete selected record") ?>?')
}
</script>
<p><a href="?chid=$chid&action=add"><img src="i/add.gif" alt="<?php echo __("Add") ?>" width="16" height="16" border="0" hspace="3" align="absmiddle"><?php echo __("Add") ?></a></p>
<style>
ul {margin: 0px;padding-left: 20px;}
</style>
<table cellspacing="0" cellpadding="5" width="100%">
<tr>
	<th width="5%"><?php echo __("#") ?></td>
	<th width="10%"><?php echo __("Date") ?></td>
	<th width="20%"><?php echo __("Caption") ?></td>
	<th width="15%"><?php echo __("Action") ?></td>
</tr>
$newsTR
</table>
$pageBar