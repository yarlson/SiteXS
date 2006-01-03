<style type="text/css">
textarea, input {font-family: tahoma;width: 100%;font-size: 100%;}
</style>
<script language="JavaScript" type="text/javascript">
function showVE(id, field) {
	var w=window.open("ve.php?id="+id+"&f="+field, '','statusbar=yes,scrollbars=no,toolbars=no,menubar=yes,resizable=yes');
	return false;
}
</script>
$validator
<h3>$header</h3>
$message
$this->navBar
<form action="?chid=$this->chid&action=$action&lid=$lid" method="post" name="FORMPOST"$onsubmit>
<input name="fields[id]" size="20" value="$data[id]" type="Hidden">
	<table border="0" cellspacing="0" cellpadding="5" width="100%">
		<tr>
			<th width="20%"><?php echo __("Поле") ?></th>
			<th width="80%"><?php echo __("Значение") ?></th>
		</tr>
		<tr>
			<td><?php echo __("№") ?></td>
			<td><input maxlength="20" name="id" size="20" value="$data[id]" disabled></td>
		</tr>
		<tr>
			<td><b><?php echo __("Заголовок") ?>&nbsp;*</b></td>
			<td><input maxlength="255" name="fields[title]" size="40" value="$data[title]" title="<?php echo __("Заголовок") ?>"></td>
		</tr>
		<tr>
			<td><?php echo __("Период") ?></td>
			<td><input maxlength="255" name="fields[period]" size="40" value="$data[period]"></td>
		</tr>
		<tr>
			<td><?php echo __("Описание") ?></td>
			<td><textarea cols="40" name="fields[description]" rows="20">$data[description]</textarea><br><a href="#" onClick="return showVE('$data[id]', 'fields[description]');"><?php echo __("Визуальный редактор") ?></a></td>
		</tr>
	</table>
<p><b>*&nbsp;&mdash; <?php echo __("Обязательные поля") ?></b></p>
<p align="center"><input type="button" value="<?php echo __("Назад") ?>" style="width: auto;" onclick="javascript: history.go(-1);">&nbsp;&nbsp;<input type="submit" value="<?php echo __("Сохранить") ?>" style="width: auto;"></p>
</form>