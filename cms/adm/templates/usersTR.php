<tr>
	<td align="right" width="5%"><? echo $ref->i ?></td>
	<td width="100%"><? echo $ref->data["name"] ?></td>
	<td><? echo $ref->data["login"] ?></td>
	<td align="center"><? echo $ref->im ?></td>
	<td align="center" style="white-space: nowrap;"><a href="?chid=<? echo $ref->chid ?>&action=edit&id=<? echo $ref->data["id"] ?>" title="<?php echo __("Edit") ?>"><img src="i/edit.gif" alt="<?php echo __("Edit") ?>" width="16" height="16" border="0"></a> &nbsp; <a href="?chid=<? echo $ref->chid ?>&action=delete&id=<? echo $ref->data["id"] ?>" onClick="return submit_delete();" title="<?php echo __("Delete") ?>"><img src="i/del.gif" alt="<?php echo __("Delete") ?>" width="16" height="16" border="0"></a></td>
</tr>