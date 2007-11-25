<style type="text/css">
textarea, input {font-family: tahoma;width: 100%;font-size: 100%;}
</style>
<h3><?php echo $this->header ?></h3>
<?php echo $this->validator ?>
<form action="?chid=<?php echo $this->chid ?>&action=<?php echo $this->action ?>" method="post" name="FORMPOST"<?php echo $this->onsubmit ?>>
<p align="center"><input type="button" value="<?php echo __("Cancel") ?>" style="width: auto;" onclick="javascript: history.go(-1);">&nbsp;&nbsp;<input type="submit" value="<?php echo __("Save") ?>" class="save" /></p>
<input name="fields[id]" value="<?php echo $this->data["id"] ?>" type="hidden">
<table border="0" width="100%" cellspacing="0" cellpadding="5">

<tr>
<th style="width: 30%;"><?php echo __("Field") ?></th>

<th style="width: 70%;"><?php echo __("Value") ?></th>
</tr>

<tr>
<td><b><?php echo __("Id") ?> *</b></td>

<td><input maxlength="20" name="id" tabindex="1" value="<?php echo $this->data["id"] ?>" title="<?php echo __("Id") ?>" disabled></td>
</tr>

<tr>
<td><b><?php echo __("Login") ?> *</b></td>

<td><input maxlength="20" name="fields[login]" tabindex="1" value="<?php echo $this->data["login"] ?>" title="<?php echo __("Login") ?>"></td>
</tr>

<tr>
<td><b><?php echo __("Name") ?> *</b></td>

<td><input maxlength="150" name="fields[name]" size="40" tabindex="5" value="<?php echo $this->data["name"] ?>" title="<?php echo __("Name") ?>"></td>
</tr>

<tr>
<td><?php echo __("E-mail") ?></td>

<td><input maxlength="150" name="fields[email]" size="40" tabindex="6" value="<?php echo $this->data["email"] ?>"></td>
</tr>

<tr>
<td><?php echo __("Description") ?></td>

<td><textarea cols="40" name="fields[description]" rows="7" tabindex="7"><?php echo $this->data["description"] ?></textarea></td>
</tr>

<tr>
<td><?php echo __("Admin") ?></td>

<td><input type="checkbox" name="fields[admin]" value="1" style="width: 2em;"></td>
</tr>

</table>
<p><b>*&nbsp;&mdash; <?php echo __("Required fields") ?></b></p>
<h3><?php echo __("Change password") ?></h3>
<table border="0" width="100%" cellspacing="0" cellpadding="5">
<tr>
<td width="30%"><?php echo __("New password") ?></td>

<td><input maxlength="150" name="fields[pass]" size="40" tabindex="2" type="Password" title="<?php echo __("Password") ?>"></td>
</tr>

<tr>
<td><?php echo __("Confirmation") ?></b></td>

<td><input maxlength="150" name="confirm" size="40" tabindex="4" type="Password" title="<?php echo __("Confirmation") ?>"></td>
</tr>
</table>
<p align="center"><input type="button" value="<?php echo __("Cancel") ?>" style="width: auto;" onclick="javascript: history.go(-1);">&nbsp;&nbsp;<input type="submit" value="<?php echo __("Change") ?>" class="save" /></p>
</form>
