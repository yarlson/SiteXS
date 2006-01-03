<script language="JavaScript">
function submit_delete()	{
	return confirm('<?php echo __("Удалить выбранную запись") ?>?')
}
</script>
<table width="100%" class="noborder">
<tr>
	<td><h3 style="margin: 0px;"><?php echo __("Список рассылки") ?> &laquo;$listName&raquo;</h3></td>
	<td style="font-size: 11px;" align="right"><a href="?chid=$this->chid"><img src="i/larr.gif" alt="" hspace="3" align="middle"><?php echo __("Списки рассылок") ?></a></td>
</tr>
</table>
$this->navBar
<table width="100%" cellspacing="0" cellpadding="0" id="inside">
<tr>
	<td>
<p><a href="?chid=$chid&action=add_Messages&id=$this->id"><img src="i/add.gif" alt="<?php echo __("Добавить") ?>" width="16" height="16" border="0" hspace="3" align="absmiddle"><?php echo __("Добавить") ?></a></p>
<style>
ul {margin: 0px;padding-left: 20px;}
</style>
<table cellspacing="0" cellpadding="5" width="100%">
<tr>
	<th width="5%"><?php echo __("№") ?></th>
	<th width="60%"><?php echo __("Тема") ?></th>
	<th width="20%"><?php echo __("Отправлено") ?></th>
	<th width="15%"><?php echo __("Действие") ?></th>
</tr>
$subscribeMessagesTR
</table>
$pageBar
</td>
</tr>
</table>