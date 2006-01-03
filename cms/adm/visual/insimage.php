<HTML>
<HEAD>
<TITLE>Картинки</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1251">
<STYLE TYPE="text/css">
 BODY   {margin-left:10; font-family:Verdana; font-size:8pt; background:menu}
 BUTTON {width:5em;font-family:Verdana; font-size:8pt;}
 TABLE, INPUT  {font-family:Verdana; font-size:8pt;}
 P      {text-align:center}
</STYLE>
<SCRIPT LANGUAGE=JavaScript>
<!--
var imgCaptions = new Array();
var imgHeights = new Array();
var imgWidths = new Array();
imgCaptions[0] = "";
imgHeights[0] = "0";
imgWidths[0] = "0";

function IsDigit()
{
  return ((event.keyCode >= 48) && (event.keyCode <= 57));
}
function showPreview()
{
if (document.frmImagePick.ImgUrl.value != "") {
 document.PREVIEWPIC.src=document.frmImagePick.ImgUrl.value ;
 document.frmImagePick.ImgHeight.value = document.PREVIEWPIC.height;
 document.frmImagePick.ImgWidth.value = document.PREVIEWPIC.width;
 }
else
  document.PREVIEWPIC.src='images/imgpreview.gif';
}
// -->
</SCRIPT>
<SCRIPT LANGUAGE=JavaScript FOR=PREVIEWPIC EVENT=onreadystatechange>
<!--
if(readyState == "complete"){
	PREVIEWPIC.style.visibility = "visible";
	if(document.readyState == "complete"){
	 document.frmImagePick.ImgHeight.value = document.PREVIEWPIC.height;
	 document.frmImagePick.ImgWidth.value = document.PREVIEWPIC.width;
	}
}
//-->
</SCRIPT>
<SCRIPT LANGUAGE=JavaScript FOR=window EVENT=onload>
<!--
  for ( elem in window.dialogArguments )
  {
    switch( elem )
    {
    case "ImgUrl":
      document.frmImagePick.ImgUrl.value=window.dialogArguments["ImgUrl"];
      showPreview();
      break;
    case "AltText":
      document.frmImagePick.AltText.value = window.dialogArguments["AltText"];
      break;
    case "ImgBorder":
      document.frmImagePick.ImgBorder.value = window.dialogArguments["ImgBorder"];
      break;
    case "HorSpace":
      document.frmImagePick.HorSpace.value = window.dialogArguments["HorSpace"];
      break;
    case "VerSpace":
      document.frmImagePick.VerSpace.value = window.dialogArguments["VerSpace"];
      break;
    case "ImgHeight":
      document.frmImagePick.ImgHeight.value = window.dialogArguments["ImgHeight"];
      break;
    case "ImgWidth":
      document.frmImagePick.ImgWidth.value = window.dialogArguments["ImgWidth"];
      break;
    case "ImgAlign":
      for(i=1;i<(document.frmImagePick.ImgAlign.length-1);i++)
        if(document.frmImagePick.ImgAlign[i].value==window.dialogArguments["ImgAlign"])
          document.frmImagePick.ImgAlign.selectedIndex = i;
      break;
    }
  }
// -->
</SCRIPT>

<SCRIPT LANGUAGE=JavaScript FOR=Ok EVENT=onclick>
<!--
  var arr = new Array();
  if (document.PREVIEWPIC.src=='images/imgpreview.gif'){
    alert('You did not select a valid image. Page not updated.');
    arr=null;
  } else {
  arr["AltText"] = document.frmImagePick.AltText.value;
  arr["HorSpace"] = document.frmImagePick.HorSpace.value;
  arr["VerSpace"] = document.frmImagePick.VerSpace.value;
  arr["ImgUrl"] = document.frmImagePick.ImgUrl.value;
  arr["ImgBorder"] = document.frmImagePick.ImgBorder.value;
  arr["ImgAlign"] = document.frmImagePick.ImgAlign[document.frmImagePick.ImgAlign.selectedIndex].value;
  arr["ImgHeight"] = document.frmImagePick.ImgHeight.value;
  arr["ImgWidth"] = document.frmImagePick.ImgWidth.value;
  arr["ImgAlign"] = document.frmImagePick.ImgAlign[document.frmImagePick.ImgAlign.selectedIndex].value;
  }
  window.returnValue = arr;
  window.close();
// -->
</SCRIPT>

</HEAD>

<BODY bottommargin="0" marginheight="0" leftmargin="0" marginwidth="0" rightmargin="0" topmargin="0">
<FORM NAME="frmImagePick" method="post" action="" enctype="multipart/form-data" style="margin: 0px 0px 0px 0px;">
<TABLE CELLSPACING="0" border="0" cellpadding="2">
<tr>
<td nowrap colspan="2">
<iframe src="upload.php?type=images" marginheight="0" marginwidth="0" hspace="0" vspace="0" frameborder="0" width="100%" style="height: 5em;" name="UPLOAD"></iframe>
</td>
</tr>
<TR>
<TD VALIGN="top" align="left" nowrap><b>И/или выберите картинку из списка: </b><br>
<iframe name="IMGPICK" src="im.php?dir=<?php echo urlencode($dir);?>&f=2" style="border: solid black 1px; width: 220px; height:230px; z-index:1;margin: 0px 0px 0px 0px;" marginheight="0" marginwidth="0" frameborder="0" vspace="0" hspace="0"></iframe>
</TD>
<TD VALIGN="top" align="center" nowrap>
<p>
<br>
<span style="background-color:gray;overflow:auto;width:250px;height:233px;border-width:1px;
border-style:solid;border-color:threeddarkshadow white white threeddarkshadow;">
<IMG ID="PREVIEWPIC" NAME="PREVIEWPIC" bgcolor="#ffffff" src="images/imgpreview.gif" alt="Preview" align="absmiddle" valign="middle"></span>
</p>
</TD></TR>
<TR>
<TD VALIGN="top" align="left" colspan="2" nowrap>
<table cellpadding="0" cellspacing="0"><tr><td>
<b>Или введите полный адрес (URL):</b><br>
<INPUT TYPE=TEXT SIZE=40 NAME=ImgUrl style="width : 300px;" value=""  onChange="showPreview()">
<br>Alt текст:<br>
<INPUT TYPE=TEXT SIZE=40 NAME=AltText style="width : 300px;">
</td>
<td valign="bottom">
&nbsp;<BUTTON ID=Ok>   OK   </BUTTON>
&nbsp;
<BUTTON ONCLICK="window.close();" ID=Cancel>Отмена</BUTTON>
</td>
</tr></table>
</TD>
</TR>
<TR>
<TD VALIGN="top" align="left" colspan="2">
<table border=0 cellpadding=2 cellspacing=2>
<tr>
<td nowrap>
<fieldset style="padding : 2px;"><legend> Layout </legend>
<table border=0 cellpadding=2 cellspacing=2>
<tr>
<td>Выравнивание:</td>
<td><select NAME=ImgAlign style="width : 80px;font-family:Verdana; font-size:8pt;">
<option value=""></option>
<option value="left">Left</option>
<option value="right">Right</option>
<option value="top">Top</option>
<option value="middle">Middle</option>
<option value="bottom">Bottom</option>
</select>
</td>
</tr>
<tr>
<td nowrap>Толщина границы:</td>
<td><INPUT TYPE=TEXT SIZE=2 value="0" NAME=ImgBorder  ONKEYPRESS="event.returnValue=IsDigit();" style="width : 80px;"></td>
</tr>
</table>
</fieldset>
</td>
<td nowrap>
<fieldset style="padding : 5px;"><legend> Отступ </legend>
<table border=0 cellpadding=2 cellspacing=1>
<tr>
<td>Горизонтальный:</td>
<td><INPUT TYPE=TEXT SIZE=2 value="0" NAME=HorSpace  ONKEYPRESS="event.returnValue=IsDigit();" style="width : 80px;"> </td>
</tr>
<tr>
<td>Вертикальный:</td>
<td><INPUT TYPE=TEXT SIZE=2 value="0" NAME=VerSpace  ONKEYPRESS="event.returnValue=IsDigit();" style="width : 80px;"></td>
</tr>
</table>
</fieldset>
</td>
</tr>
</table>
</TD>
</TR>
</TABLE>
<INPUT TYPE=HIDDEN SIZE=5 value="0" NAME=ImgHeight>
<INPUT TYPE=HIDDEN SIZE=5 value="0" NAME=ImgWidth>
</FORM>

</BODY>
</HTML>
