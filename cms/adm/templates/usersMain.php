<script language="JavaScript">
function submit_delete()	{
	return confirm('<?php echo __("Удалить выбранную запись") ?>?')
}
</script>
<p><a href="?chid=$chid&action=add"><img src="i/add.gif" alt="<?php echo __("Добавить") ?>" width="16" height="16" border="0" hspace="3" align="absmiddle"><?php echo __("Добавить") ?></a></p>
<table cellspacing="0" cellpadding="5" width="100%">
<tr>
	<th width="5%"><?php echo __("№") ?></th>
	<th width="95%"><?php echo __("ФИО") ?></th>
	<th><?php echo __("Логин") ?></th>
	<th><?php echo __("Админ") ?></th>
	<th><?php echo __("Действие") ?></th>
</tr>
$usersTR
</table>
<p><a href="?chid=$chid&action=add"><img src="i/add.gif" alt="<?php echo __("Добавить") ?>" width="16" height="16" border="0" hspace="3" align="absmiddle"><?php echo __("Добавить") ?></a></p>