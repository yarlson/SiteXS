<?php
$GLOBALS['now'] = gmdate('D, d M Y H:i:s') . ' GMT';
header('Expires: ' . $GLOBALS['now']); // rfc2616 - Section 14.21
header('Last-Modified: ' . $GLOBALS['now']);
header('Cache-Control: no-store, no-cache, must-revalidate, pre-check=0, post-check=0, max-age=0'); // HTTP/1.1
header('Pragma: no-cache'); // HTTP/1.0
?>
<HTML>
<HEAD>
<TITLE>Ссылки</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1251">
<STYLE TYPE="text/css">
 BODY   {margin-left:10; font-family:Verdana; font-size:12; background:menu}
 BUTTON {width:5em}
 TABLE  {font-family:Verdana; font-size:12}
 P      {text-align:center}
 SPAN.help    {font-family:Verdana; font-size:9;}
 SELECT    {font-family:Verdana; font-size:10;}
</STYLE>

<SCRIPT LANGUAGE=JavaScript>
<!--
function IsDigit()
{
  return ((event.keyCode >= 48) && (event.keyCode <= 57))
}
// -->
</SCRIPT>
<SCRIPT LANGUAGE=JavaScript FOR=window EVENT=onload>
<!--
for ( elem in window.dialogArguments ) {
    switch( elem ) {

	    case "LinkUrl":
			if (window.dialogArguments["LinkUrl"] == "") { // If no value is passed in, set a default.
				document.frmLinkPick.LinkUrl.value = "http://www.domain.com/folder/file.html";
			} else {
				document.frmLinkPick.LinkUrl.value = window.dialogArguments["LinkUrl"];
			}
	      break;

	    case "LinkLabel":
			document.frmLinkPick.LinkLabel.value = window.dialogArguments["LinkLabel"];
			break;

	    case "LinkTarget":
			if (window.dialogArguments["LinkTarget"] == "") { // If no value is passed in, set a default.
				document.frmLinkPick.LinkTarget.value = "_self";
			} else {
				document.frmLinkPick.LinkTarget.value = window.dialogArguments["LinkTarget"];
			}
	      break;
    }
}
// -->
</SCRIPT>

<SCRIPT LANGUAGE=JavaScript FOR=Ok EVENT=onclick>
<!--
	var arr = new Array();

	if (document.frmLinkPick.LinkUrl.value.substr(0,1)=='/'){
    // attach the BASE so that it will be converted to relative links
		arr["LinkUrl"] =  document.frmLinkPick.LinkUrl.value;
	} else {
		arr["LinkUrl"] =  document.frmLinkPick.LinkUrl.value;
	}

	arr["LinkLabel"] = document.frmLinkPick.LinkLabel.value;

	// if no target was selected, we'll automatically assign it as "_self"
	if (document.frmLinkPick.LinkTarget.value == "") {
		arr["LinkTarget"] = "_self";
	} else {
		arr["LinkTarget"] = document.frmLinkPick.LinkTarget[document.frmLinkPick.LinkTarget.selectedIndex].value;
	}

	if (document.frmLinkPick.LinkUrl.value == "http://www.domain.com/folder/file.html") {
		alert('You did not enter a valid link. Click the "Cancel" button if you do not want to add a new link.');
	} else {
		window.returnValue = arr;
		window.close();
	}
// -->
</SCRIPT>
</HEAD>
<BODY>
<FORM NAME="frmLinkPick" method="post" action="">
<TABLE CELLSPACING=10>
 <TR>
  <TD VALIGN="top" align="left"><strong>Выберите документ</strong>
<br>
<table>
	<tr>
		<td><iframe name="LNKPICK" src="links.php?id=<?php echo (($id) ? $id : 0); ?>" style="border: solid black 1px; width: 340px; height:240px; z-index:1"></iframe></td>
		<td>
			<iframe src="upload.php?type=download" marginheight="0" marginwidth="0" hspace="0" vspace="0" frameborder="0" width="100%" style="height: 50px;" name="UPLOAD"></iframe>
			<iframe name="IMGPICK" src="fl.php?dir=<?php echo urlencode($dir);?>&f=2" style="border: solid black 1px; width: 340px; height:190px; z-index:1;margin: 0px 0px 0px 0px;" marginheight="0" marginwidth="0" frameborder="0" vspace="0" hspace="0"></iframe>
		</td>
	</tr>
</table>
</TD>
</TR>
<TR>
<TD VALIGN="middle" align="left" nowrap><b>URL: </b><span class="help">Адрес документа или папки</span><br><INPUT TYPE=TEXT SIZE=40 NAME=LinkUrl style="width : 100%;" value="">
</TD>
</TR>
<TD VALIGN="middle" align="left" nowrap>Где открыть ссылку?
<SELECT NAME=LinkTarget>
<option value="_self">В том же фрейме (_self)</option>
<option value="_top">В том же окне (_top)</option>
<option value="_blank">В новом окне (_blank)</option>
</SELECT></TD>
</TR>
<TR>
<TD VALIGN="top" align="center">
<BUTTON ID=Ok>   OK   </BUTTON>
<BUTTON ONCLICK="window.close();">Отмена</BUTTON>
</TD>
</TR>
</TABLE>
<INPUT TYPE=HIDDEN NAME=LinkLabel value="">
</FORM>

</BODY>
</HTML>
