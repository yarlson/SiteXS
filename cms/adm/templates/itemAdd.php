<style type="text/css">
textarea, input {font-family: tahoma;width: 100%;font-size: 100%;}
</style>
<link rel="stylesheet" href="we/wikiedit.css" type="text/css">
<script language="javascript" type="text/javascript" src="/adm/tinymce/jscripts/tiny_mce/tiny_mce_gzip.php"></script>
<script language="javascript" type="text/javascript">

// Notice: The simple theme does not use all options some of them are limited to the advanced theme
	tinyMCE.init({
		mode : "specific_textareas",
		textarea_trigger : "convert_this",
		theme : "advanced",
		width : "100%",
		plugins : "table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,zoom,flash,searchreplace,print,contextmenu,paste,directionality,fullscreen",
		theme_advanced_buttons1_add_before : "save,newdocument,separator",
		theme_advanced_buttons1_add : "fontselect,fontsizeselect",
		theme_advanced_buttons2_add : "separator,insertdate,inserttime,preview,separator,forecolor,backcolor",
		theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,search,replace,separator",
		theme_advanced_buttons3_add_before : "tablecontrols,separator",
		theme_advanced_buttons3_add : "emotions,iespell,flash,advhr,separator,print,separator,ltr,rtl,separator,fullscreen",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_path_location : "bottom",
	    plugin_insertdate_dateFormat : "%Y-%m-%d",
	    plugin_insertdate_timeFormat : "%H:%M:%S",
		extended_valid_elements : "img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",
		external_link_list_url : "example_data/example_link_list.js",
		external_image_list_url : "example_data/example_image_list.js",
		flash_external_list_url : "example_data/example_flash_list.js",
		file_browser_callback : "mcFileManager.filebrowserCallBack",
		paste_auto_cleanup_on_paste : true,
		paste_convert_headers_to_strong : true,
		language : "<?php echo __("en") ?>"
	});

</script>
<?php echo $ref->validator ?>
<h3><?php echo $ref->header ?></h3>
<?php echo $ref->message ?>
<form action="?chid=<?php echo $ref->chid ?>&action=<?php echo $ref->action ?>&lid=<?php echo $ref->lid ?>" method="post" name="FORMPOST"<?php echo $ref->onsubmit ?>>
<input type="hidden" name="fields[pid]" value="<?php echo $ref->data[pid] ?>">
<p align="center"><input type="button" value="<?php echo __("Cancel") ?>" style="width: auto;" onclick="javascript: history.go(-1);">&nbsp;&nbsp;<input type="submit" value="<?php echo __("Save") ?>" class="save"></p>
<table border="0" cellspacing="0" cellpadding="5" width="100%">
		<tr>
			<th><?php echo __("Field") ?></th>
			<th><?php echo __("Value") ?></th>
		</tr>
<?php echo $ref->id ?>
		<tr>
			<td class="nw"><?php echo __("Type") ?></td>
			<td>
			<select name="fields[type]">
			<option></option>
<?php echo $ref->types ?>
			</select>
		</tr>
		<tr>
			<td class="nw"><?php echo __("Date") ?></td>
			<td><select name="date[day]"><?php echo $ref->select[day] ?></select>&nbsp;<select name="date[month]"><?php echo $ref->select[month] ?></select>&nbsp;<select name="date[year]"><?php echo $ref->select[year] ?></select></td>
		</tr>
		<tr>
			<td class="nw"><b><?php echo __("Title") ?>&nbsp;*</b></td>
			<td><input maxlength="255" name="fields[title]" size="40" value="<?php echo $ref->data[title] ?>" title="<?php echo __("Caption") ?>"></td>
		</tr>
		<tr>
			<td class="nw"><?php echo __("Subtitle") ?></td>
			<td><textarea cols="40" name="fields[subtitle]" rows="7"><?php echo $ref->data[subtitle] ?></textarea></td>
		</tr>
		<tr>
			<td class="nw"><b><?php echo __("Page URL") ?>&nbsp;*</b></td>
			<td><input maxlength="100" name="fields[url]" size="40" value="<?php echo $ref->data[url] ?>" title="<?php echo __("Page URL") ?>"></td>
		</tr>
		<tr id="trText">
			<td class="nw"><?php echo __("Text") ?></td>
			<td><textarea cols="40" name="fields[text]" rows="20" id="text" convert_this="true"><?php echo $ref->data[text] ?></textarea></td>
		</tr>
		<tr>
			<td class="nw"><?php echo __("State") ?></td>
			<td>
				<select name="fields[state]">
					<option value="0"<?php echo $this->state_selected[0] ?> style="color: red;"><?php echo __("Hidden") ?></option>
					<option value="1"<?php echo $this->state_selected[1] ?> style="color: blue;"><?php echo __("Published") ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td class="nw"><?php echo __("Menu") ?></td>
			<td>
				<select name="fields[menu]">
					<?php echo $this->menus ?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="nw"><?php echo __("META Keywords") ?></td>
			<td><textarea cols="40" name="fields[keywords]" rows="3"><?php echo $ref->data[keywords] ?></textarea></td>
		</tr>
		<tr>
			<td class="nw"><?php echo __("META Description") ?></td>
			<td><textarea cols="40" name="fields[description]" rows="3"><?php echo $ref->data[description] ?></textarea></td>
		</tr>
	</table>
<p><b>*&nbsp;&mdash; <?php echo __("Required fields") ?></b></p>
<p align="center"><input type="button" value="<?php echo __("Cancel") ?>" style="width: auto;" onclick="javascript: history.go(-1);">&nbsp;&nbsp;<input type="submit" value="<?php echo __("Save") ?>" class="save"></p>
</form>