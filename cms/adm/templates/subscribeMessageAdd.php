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
<table width="100%" class="noborder">
<tr>
	<td width="100%"><h3 style="margin: 0px;"><?php echo __("Список рассылки") ?> &laquo;$listName&raquo;</h3></td>
	<td style="font-size: 11px;" align="right"><a href="?chid=$this->chid"><img src="i/larr.gif" alt="" hspace="3" align="middle"><?php echo __("Списки рассылок") ?></a></td>
</tr>
</table>
$this->navBar
<table width="100%" cellspacing="0" cellpadding="0" id="inside">
<tr>
	<td>
<h3>$header</h3>
$message
<form action="?chid=$this->chid&action=$action&id=$this->id" method="post" name="FORMPOST"$onsubmit>
<input name="fields[lid]" size="20" value="$this->id" type="Hidden">
<p align="center"><input type="button" value="<?php echo __("Назад") ?>" style="width: auto;" onclick="javascript: history.go(-1);">&nbsp;&nbsp;<input type="submit" value="<?php echo __("Сохранить") ?>" style="width: auto;"></p>
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
			<td><input maxlength="255" name="fields[subj]" size="40" value="$data[subj]" title="<?php echo __("Заголовок") ?>"></td>
		</tr>
		<tr>
			<td><?php echo __("Текст") ?></td>
			<td><textarea cols="40" name="fields[text]" rows="20">$data[text]</textarea></td>
		</tr>
		<tr>
			<td>HTML</td>
			<td><textarea cols="40" name="fields[html]" rows="20">$data[html]</textarea><br><a href="#" onClick="return showVE('$data[id]', 'fields[html]');"><?php echo __("Визуальный редактор") ?></a></td>
		</tr>
	</table>
<p><b>*&nbsp;&mdash; <?php echo __("Обязательные поля") ?></b></p>
<p align="center"><input type="button" value="<?php echo __("Назад") ?>" style="width: auto;" onclick="javascript: history.go(-1);">&nbsp;&nbsp;<input type="submit" value="<?php echo __("Сохранить") ?>" style="width: auto;"></p>
</form>
</td>
</tr>
</table>