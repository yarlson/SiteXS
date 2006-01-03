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
<form action="?chid=$chid&action=$action&lid=$lid" method="post" name="FORMPOST"$onsubmit>
<input name="fields[id]" size="20" value="$data[id]" type="Hidden">
<p align="center"><input type="button" value="<?php echo __("Back") ?>" style="width: auto;" onclick="javascript: history.go(-1);">&nbsp;&nbsp;<input type="submit" value="<?php echo __("Save") ?>" style="width: auto;"></p>
	<table border="0" cellspacing="0" cellpadding="5" width="100%">
		<tr>
			<th width="20%"><?php echo __("Field") ?></th>
			<th width="80%"><?php echo __("Value") ?></th>
		</tr>
		<tr>
			<td><?php echo __("#") ?></td>
			<td><input maxlength="20" name="id" size="20" value="$data[id]" disabled></td>
		</tr>
		<tr>
			<td><?php echo __("date") ?></td>
			<td><select name="date[day]">$select[day]</select>&nbsp;<select name="date[month]">$select[month]</select>&nbsp;<select name="date[year]">$select[year]</select></td>
		</tr>
		<tr>
			<td><b><?php echo __("Caption") ?>&nbsp;*</b></td>
			<td><input maxlength="255" name="fields[title]" size="40" value="$data[title]" title="<?php echo __("Caption") ?>"></td>
		</tr>
		<tr id="trText">
			<td><?php echo __("Текст") ?></td>
			<td><textarea cols="40" name="fields[text]" rows="20">$data[text]</textarea><br><a href="#" onClick="return showVE('$data[id]', 'fields[text]');"><?php echo __("Visual editor") ?></a></td>
		</tr>
	</table>
<p><b>*&nbsp;&mdash; <?php echo __("Must be filled") ?></b></p>
<p align="center"><input type="button" value="<?php echo __("Back") ?>" style="width: auto;" onclick="javascript: history.go(-1);">&nbsp;&nbsp;<input type="submit" value="<?php echo __("Save") ?>" style="width: auto;"></p>
</form>