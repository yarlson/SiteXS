<style type="text/css">
textarea, input {font-family: tahoma;width: 100%;font-size: 100%;}
</style>
<script language="JavaScript">
function showVE(id, field) {
	var w=window.open("ve.php?id="+id+"&f="+field, '','statusbar=yes,scrollbars=no,toolbars=no,menubar=yes,resizable=yes');
	return false;
}
</script>
<table width="100%" class="noborder">
	<tr>
		<td width="100%" style="padding-left: 0px;"><h3 style="margin: 0px;"><?php echo __("������ ��������") ?></h3></td>
		<td>
<ul style="list-style-type: none;font-size: 11px;">
	<li><a href="?chid=$this->chid"><img src="i/subs_lists.gif" alt="" width="16" height="16" border="0" hspace="5" align="middle"><?php echo __("������ ��������") ?><img src="i/rarr.gif" alt="" hspace="3" align="middle"></a></li>
	<li><a href="?chid=$this->chid&action=show_AllUsers"><img src="i/subs_users.gif" alt="" width="16" height="16" border="0" hspace="5" align="middle"><?php echo __("����������") ?><img src="i/rarr.gif" alt="" hspace="3" align="middle"></a></li>
</ul></td>
	</tr>
</table>
$validator
<form action="?chid=$this->chid&action=apply_conf" method="post" name="FORMPOST" $onsubmit>
<p align="center"><input type="submit" value="<?php echo __("���������") ?>" style="width: auto;" onclick="return validateForm();"></p>
<table border="0">
<tr>
	<th><?php echo __("����") ?></th>
	<th><?php echo __("��������") ?></th>
</tr>
<tr>
	<td><?php echo __("E-mail ��") ?></td>
	<td><input type="text" name="fields[email_from]" value="$data[email_from]"></td>
</tr>
<tr>
	<td><b><?php echo __("E-mail ��� �������� ��������") ?>&nbsp;*</b></td>
	<td><input type="text" name="fields[test_email]" value="$data[test_email]"></td>
</tr>
<tr>
	<td><b><?php echo __("������������� URL ��������") ?>&nbsp;*</b></td>
	<td><input type="text" name="fields[url]" value="$data[url]"></td>
</tr>
<tr>
	<td><b><?php echo __("��������� ������") ?>&nbsp;*</b></td>
	<td><textarea tabindex="0" name="fields[text]" rows="7" cols="40" title="<?php echo __("��������� ������") ?>">$data[text]</textarea></td>
</tr>
<tr>
	<td><b><?php echo __("HTML-������") ?> *</b></td>
	<td><textarea tabindex="1" name="fields[html]" rows="7" cols="40" title="<?php echo __("HTML-������") ?>">$data[html]</textarea><br><a href="#" onClick="return showVE('$data[id]', 'fields[html]');"><?php echo __("���������� ��������") ?></a></td>
</tr>

<tr>
	<td><b><?php echo __("�������������") ?> *</b></td>
	<td><textarea tabindex="2" name="fields[confirm]" rows="7" cols="40" title="<?php echo __("�������������") ?>">$data[confirm]</textarea><br><a href="#" onClick="return showVE('$data[id]', 'fields[confirm]');"><?php echo __("���������� ��������") ?></a></td>
</tr>
</table>
<p align="center"><input type="submit" value="<?php echo __("���������") ?>" style="width: auto;"></p>
</form>
