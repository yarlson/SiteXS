$validator
<form action="?chid=$chid&action=addParamAppend" method="post" name="param"$onsubmit>
<h3><?php echo __("New parameter addition") ?></h3>
<table width="100%" style="font-size: 100%;">
<tr><td style="font-weight: bold;"><? echo __("Variable name")?> (*)</td><td width="100%"><input type="text" name="name" class="text" style="width: 100%;" size="50" title="<? echo __("Variable name")?> " value="<?php echo $ref->name ?>"></td></tr>
<tr><td style="font-weight: bold;"><? echo __("Parameter name")?> (*)</td><td><textarea name="descr" cols="50" rows="5" style="width: 100%;" title="<? echo __("Parameter name")?>"><?php echo $ref->descr ?></textarea></td></tr>
<tr><td><? echo __("Value")?> </td><td><textarea name="text" cols="50" rows="5" style="width: 100%;"><?php echo $ref->text ?></textarea></td></tr>
</table>
<p><b>(*)</b> <?php echo __("Obligatory field") ?></p>
<p align="center"><input type="submit" value="<?php echo __("Save") ?>"></p>
</form>
