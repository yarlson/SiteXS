<style type="text/css">
		tr.default  {
			background-color: #F8F8F3;
		}
		tr.selected td {
			background-color: #EFEFE4;
		}
		#buttonBar {text-align: center; padding-top: 1em;}
		#buttonBar ul {border: 1px solid silver;font-size: 85%; font-family: tahoma; height: 2em; float: left; margin: 0; padding: 1em;}
		#buttonBar img {margin-right: 0.5em;}
		#buttonBar li {float: left; list-style-type: none;margin: 0 1em;; padding: 0;}
</style>
<script language="JavaScript" type="text/javascript" src="check.js"></script>
<script language="JavaScript" type="text/javascript" src="oWnd.js"></script>
<script type="text/javascript" language="JavaScript">
<!--
var cur_dir="<?php echo $ref->dir ?>";
var mb;
var chid=<?php echo $ref->chid ?>;
-->
</script>
<script language="JavaScript" type="text/javascript">
<!--
function delete_onclick(name) {
	var thisCheckBoxes=document.getElementsByTagName("input");
	var files="";
	var names="";
	var j=0;
	for (i = 1; i < thisCheckBoxes.length; i++){
		if (thisCheckBoxes[i].name=="ids") {
			if (thisCheckBoxes[i].checked) {
				j++;
				files+="&name[]="+thisCheckBoxes[i].value;
				names+="\n"+thisCheckBoxes[i].value.replace("\/", "");
			}
		}
	}
	if (j)
		if (confirm("<?php echo __("Delete") ?> "+((j==1) ? "<?php echo __("file") ?>" : "files")+ ":" + names+"?")) document.location="?chid=" + chid + "&dir="+cur_dir+"&action=delete&name="+files;
	return false;
}

function rename_onclick(){
	var thisCheckBoxes=document.getElementsByTagName("input");
	for (i = 1; i < thisCheckBoxes.length; i++){
		if (thisCheckBoxes[i].name=="ids") {
			if (thisCheckBoxes[i].checked) {
				var html="<div align=\"right\"><a href=\"\" style=\"font-family: wingdings; color: silver; text-decoration: none;font-size: 20px;\" onclick=\"mb.style.display='none';return false;\"><img src=\"i/close.gif\" width=\"7\" height=\"7\"></a></div><h1 style=\"background: #EFEFE4; font-size: 140%; font-weight: normal;padding: 5px\"><?php echo __("Rename") ?></h1><form action=\"?chid=" + chid + "&action=rename&from=" + thisCheckBoxes[i].value.replace('\/', "") + "&dir="+cur_dir+"\" name=\"FP\" method=\"post\"><table cellspacing=\"0\" cellpadding=\"5\" class=\"noborder\"><tr><td><?php echo __("Old name") ?>&nbsp;&nbsp;&nbsp;</td><td valign=\"top\" width=\"100%\">" + thisCheckBoxes[i].value.replace('\/', "") + "</td><td></td></tr><tr><td><?php echo __("New name") ?>&nbsp;&nbsp;&nbsp;</td><td valign=\"top\" width=\"100%\"><input name=\"to\" maxlength=\"30\" size=\"30\" value=\"" + thisCheckBoxes[i].value.replace('\/', "") + "\"></td><td></td></tr><tr><td style=\"font-size: 80%;font-family: tahoma; color: gray;\" colspan=\"2\"><?php echo __("No more than 30 characters") ?>. Only Latin letters, numbers, underscores (_) and hyphen (-)</td></tr><tr><td colspan=\"2\"><input type=\"submit\" value=\"<?php echo __("Save") ?>\">&nbsp;<input type=\"button\" value=\"<?php echo __("Cancel") ?>\" onClick=\"mb.style.display='none';\"></td></tr></table></form><script>document.FP.name.focus();</script>";
				openWnd(400, html);
				break;
			}
		}
	}
}

function add_onclick(){
	var html="<div align=\"right\"><a href=\"\" style=\"font-family: wingdings; color: silver; text-decoration: none;font-size: 20px;\" onclick=\"mb.style.display='none';return false;\"><img src=\"i/close.gif\" width=\"7\" height=\"7\"></a></div><h1 style=\"background: #EFEFE4; font-size: 140%; font-weight: normal;padding: 5px\"><?php echo __("New folder") ?></h1><form action=\"#\" name=\"FORMPOST\" onsubmit=\"return false;\"><table cellspacing=\"0\" cellpadding=\"5\" class=\"noborder\"><tr><td><?php echo __("Name") ?>&nbsp;&nbsp;&nbsp;</td><td valign=\"top\" width=\"100%\"><input name=\"name\" maxlength=\"30\" size=\"30\"></td><td></td></tr><tr><td style=\"font-size: 80%;font-family: tahoma; color: gray;\" colspan=\"2\"><?php echo __("No more than 30 characters") ?>. <?php echo __("Only Latin letters, numbers, underscores (_) and hyphen (-)") ?></td></tr><tr><td colspan=\"2\"><input type=\"button\" value=\"<?php echo __("Save") ?>\" onClick=\"if (FORMPOST.name.value) {window.location='?chid=" + chid + "&action=addNewDir&name='+FORMPOST.name.value+'&dir="+cur_dir+"';}\">&nbsp;<input type=\"button\" value=\"<?php echo __("Cancel") ?>\" onClick=\"mb.style.display='none';\"></td></tr></table></form>";
	openWnd(400, html);
}

function upload_onclick(){
	var html="<div align=\"right\"><a href=\"\" style=\"font-family: wingdings; color: silver; text-decoration: none;font-size: 20px;\" onclick=\"mb.style.display='none';return false;\"><img src=\"i/close.gif\" width=\"7\" height=\"7\"></a></div><h1 style=\"background: #EFEFE4; font-size: 140%; font-weight: normal;padding: 5px\" id=\"bd\"><?php echo __("Upload new file") ?></h1><form action=\"?chid=" + chid + "&action=upload&dir="+cur_dir+"\" name=\"FORMPOST\" onsubmit=\"document.all.bd.innerHTML='<?php echo __("Uploading") ?>...';\" method=\"post\" enctype=\"multipart/form-data\"><table cellspacing=\"0\" cellpadding=\"5\" class=\"noborder\"><tr><td><?php echo __("Choose a file") ?>&nbsp;&nbsp;&nbsp;</td><td valign=\"top\" width=\"100%\"><input name=\"pic\" maxlength=\"30\" size=\"30\" type=\"File\"></td><td></td></tr><tr><td style=\"font-size: 80%;font-family: tahoma; color: gray;\" colspan=\"2\"><?php echo __("No more than 30 characters") ?>. <?php echo __("Only Latin letters, numbers, point (.), underscore (_) and hyphen (-)") ?></td></tr><tr><td colspan=\"2\"><input type=\"submit\" value=\"<?php echo __("Save") ?>\">&nbsp;<input type=\"button\" value=\"<?php echo __("Cancel") ?>\" onClick=\"mb.style.display='none';\"></td></tr></table></form>";
	openWnd(440, html);
}
-->
</script>
<div id="messagebox" style="display: none;background: #FBFBFB;border: 3px solid silver;padding: 1em;"></div>
<span style="background-color: #F8F8F3;">&nbsp;&nbsp;<?php echo __("Current dir") ?>&nbsp;&mdash; <?php echo $ref->localBreadCrumbs ?>&nbsp;&nbsp;</span>
<form action="?type=files&action=upload&dir=$dir" method="post" name="post" id="post" enctype="multipart/form-data">
<div id="buttonBar">
<ul>
	<li><a href="#"  onClick="return add_onclick();"><img src="i/folderAdd.gif" alt="<?php echo __("New dir")?>" width="16" height="16" border="0" align="bottom"><?php echo __("New dir")?></a></li><li><a href="#" onClick="return rename_onclick()"><img src="i/rename.gif" alt="<?php echo __("Rename")?>" width="16" height="16" border="0" align="bottom"><?php echo __("Rename")?></a></li><li><a href="#" onClick="return delete_onclick()"><img src="i/delete.gif" alt="<?php echo __("Delete")?>" width="16" height="16" border="0" align="bottom"><?php echo __("Delete")?></a></li><li><a href="#" onClick="return upload_onclick()"><img src="i/upload.gif" alt="<?php echo __("Upload new file")?>" width="16" height="16" border="0" align="bottom"><?php echo __("Upload new file")?></a></li>
</ul>
</div>
<div class="clear"></div>
</form>
<form action="" method="" name="file" id="file" enctype="multipart/form-data">
<table cellpadding="3" cellspacing="1" width="100%" style="font-size: 90%;">
<tr align="center">
	<th width="5%"><input title="<?php echo __("Check all")?>" onclick="CheckAll(this,'ids')" type="Checkbox" name="ids"></th>
	<th width="55%"><?php echo __("Name")?></th>
	<th width="15%"><?php echo __("Type")?></th>
	<th width="10%"><?php echo __("Size")?></th>
	<th width="15%"><?php echo __("Changed")?></th>
</tr>
<colgroup>
<col><col style="font-weight: bold;"><col><col align="right"><col align="center">
</colgroup>
<?php echo $ref->files_tr ?>
</table>

</form>