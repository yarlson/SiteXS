<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
<style type="text/css">
BODY, TABLE {
	font : 10px Tahoma, Verdana, Geneva, Arial, Helvetica, sans-serif;
}
LI {
	list-style-type : none;
}
</style>
</head>
<body bottommargin="0" leftmargin="0" marginheight="0" marginwidth="0" rightmargin="0" topmargin="0" bgcolor="#FFFFFF">
<script language="JavaScript">
<!--
function onSelect() {
	var index;
	for (var i=0; i<document.formpost.sel.length; i++) {
		if (document.formpost.sel[i].checked) {
			index=document.formpost.sel[i].value;
			break;
		}
	}
	parent.frmLinkPick.LinkUrl.value=index;
}
//-->
</script>
<form action="" name="formpost" id="formpost">
$options
</form>
<script language="JavaScript">
<!--
for (var i=0; i<document.formpost.sel.length; i++) {
	if (move) {
		document.formpost.sel[i].focus();
		break;
	}
	if (document.formpost.sel[i].checked)
		var move=true;
}
//-->
</script>
</body>
</html>
