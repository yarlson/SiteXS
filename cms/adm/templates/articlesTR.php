<tr>
	<td align="right"><?php echo $this->data["id"] ?></td>
	<td><?php echo $this->data["date"] ?></td>
	<td><?php echo $this->data["title"]?></td>
	<td align="center"><a href="?chid=<?php echo $this->chid ?>&action=edit&id=<?php echo $this->data["id"].$this->page ?>" title="<?php echo __("Edit") ?>"><img src="i/edit.gif" alt="<?php echo __("Edit") ?>" width="16" height="16" border="0"></a> &nbsp; <a href="?chid=<?php echo $this->chid ?>&action=delete&id=<?php echo $this->data["id"].$this->page ?>" onClick="return submit_delete();" title="<?php echo __("Delete") ?>"><img src="i/del.gif" alt="<?php echo __("Delete") ?>" width="16" height="16" border="0"></a></td>
</tr>