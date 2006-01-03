<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>HTML VisualEd</title>
<SCRIPT language="JavaScript" type="text/javascript">
function onLoad() {
document.FORMPOST.text.value=opener.FORMPOST.elements["$field"].value;
document.ieeditor.MENU_FILE_OPEN_onclick();
}
function onSave() {
opener.FORMPOST.elements["$field"].value=document.FORMPOST.text.value;
}

</SCRIPT>
</head>

<body bottommargin="0" leftmargin="0" marginheight="0" marginwidth="0" rightmargin="0" topmargin="0" onLoad="onLoad()">
<form></form>
<form name="FORMPOST" method="post" enctype="multipart/form-data" action="$form_action" style="margin: 0 0 0 0; padding: 0 0 0 0;">
<textarea name="text" id="text" rows="0" cols="0" style="visibility:hidden;">$data[text]</textarea>
<input type="hidden" name="fc" value="$fc">
<input type="hidden" name="template" value="$template">
<input type="hidden" name="id" value="$id">
<input type="hidden" name="lid" value="$lid">
<input type="hidden" name="tpl" value="$tp">
<input type="hidden" name="pid" value="$data[pid]">
<iframe name="ieeditor" src="visual/ieeditort.html" width="100%" height="100%" style="border: solid gray 1px; margin-top: -40px;"></iframe>
</form>
<form action="preview.php" method="post" target="_blank" name="POST" style="visibility:hidden;margin: 0 0 0 0;">
<input type="hidden" name="ct" value="">
<input type="hidden" name="tt" value="">
</form>

</body>
</html>
