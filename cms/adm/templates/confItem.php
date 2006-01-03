<tr><td valign="top" width="30%"><?php echo $ref->data["descr"] ?></td><td width="70%"><textarea name="<?php echo $ref->data["name"] ?>" cols="50" rows="5" style="width: 100%;" id="<?php echo $ref->data["name"] ?>"><?php echo $ref->data["text"] ?></textarea>
<script type="text/javascript">
i++;
wE[i] = new WikiEdit(); wE[i].init('<?php echo $ref->data["name"] ?>','','CCSclassForTextOnToolbar');
</script>
</td></tr>