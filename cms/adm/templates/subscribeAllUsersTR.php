<tr>
	<td align="right">$data[id]</td>
	<td>$data[name]</td>
	<td>$data[email]</td>
	<td align="center"><a href="?chid=$chid&action=edit_AllUsers&id=$data[id]$page" title="<?php echo __("Редактировать") ?>"><img src="i/edit.gif" alt="<?php echo __("Редактировать") ?>" width="16" height="16" border="0"></a> &nbsp; <a href="?chid=$chid&action=delete_AllUsers&id=$data[id]$page" onClick="return submit_delete();" title="<?php echo __("Удалить") ?>"><img src="i/del.gif" alt="<?php echo __("Удалить") ?>" width="16" height="16" border="0"></a></td>
</tr>