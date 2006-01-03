<script language="JavaScript">
function submit_delete()	{
	return confirm('Удалить выбранную запись?')
}
</script>
<p><a href="?chid=$chid&action=add"><img src="i/add.gif" alt="Добавить" width="16" height="16" border="0" hspace="3" align="absmiddle">Добавить</a></p>
<style>
ul {margin: 0px;padding-left: 20px;}
</style>
<table cellspacing="0" cellpadding="5" width="100%">
<tr>
	<th width="5%">№</td>
	<th width="10%">Проект</td>
	<th width="20%">Компания</td>
	<th width="15%">Действие</td>
</tr>
$projectsTR
</table>
$pageBar