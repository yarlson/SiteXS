<tr>
	<td align="right" width="5%">$i</td>
	<td width="100%">$data[name]</td>
	<td>$data[login]</td>
	<td align="center">$im</td>
	<td align="center"><a href="?chid=$chid&action=edit&id=$data[id]" title="<?php echo __("Редактировать") ?>"><img src="i/edit.gif" alt="<?php echo __("Редактировать") ?>" width="16" height="16" border="0"></a> &nbsp; <a href="?chid=$chid&action=delete&id=$data[id]" onClick="return submit_delete();" title="<?php echo __("Удалить") ?>"><img src="i/del.gif" alt="<?php echo __("Удалить") ?>" width="16" height="16" border="0"></a></td>
</tr>