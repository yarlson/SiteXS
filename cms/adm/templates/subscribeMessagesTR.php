<tr>
	<td align="right">$data[id]</td>
	<td>$data[subj]</td>
	<td>$data[date_sent]</td>
	<td align="center"><a href="?chid=$chid&action=test_Messages&id=$this->id&mid=$data[id]$page" title="<?php echo __("Test") ?>"><img src="i/test.gif" alt="<?php echo __("Test") ?>" width="16" height="16" border="0"></a>&nbsp;<a href="?chid=$chid&action=send_Messages&id=$this->id&mid=$data[id]$page" title="<?php echo __("Send") ?>"><img src="i/send.gif" alt="<?php echo __("Send") ?>" width="16" height="16" border="0"></a>&nbsp;&nbsp;&nbsp;<a href="?chid=$chid&action=edit_Messages&id=$this->id&mid=$data[id]$page" title="<?php echo __("Edit") ?>"><img src="i/edit.gif" alt="<?php echo __("Edit") ?>" width="16" height="16" border="0"></a> &nbsp; <a href="?chid=$chid&action=delete_Messages&id=$this->id&mid=$data[id]$page" onClick="return submit_delete();" title="<?php echo __("Delete") ?>"><img src="i/del.gif" alt="<?php echo __("Delete") ?>" width="16" height="16" border="0"></a></td>
</tr>