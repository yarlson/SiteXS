<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title><?php echo __("Visual Editor")." ".__("powered by")." tinyMCE"  ?></title>
<script language="javascript" type="text/javascript" src="/adm/tinymce/jscripts/tiny_mce/tiny_mce_gzip.php"></script>
<script language="javascript" type="text/javascript">

// Notice: The simple theme does not use all options some of them are limited to the advanced theme
	tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
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
	//alert(opener.document.FORMPOST.elements["<?php echo $ref ?>"].value);
function mysave() {
	opener.document.FORMPOST.elements["<?php echo $ref ?>"].value=document.FORMPOST.elements["text"].value;
	window.close();
	return false;
}
</script>
</head>

<body bottommargin="0" leftmargin="0" marginheight="0" marginwidth="0" rightmargin="0" topmargin="0">
<form name="FORMPOST" method="post" enctype="multipart/form-data" action="" style="margin: 0 0 0 0; padding: 0 0 0 0;" onsubmit="return mysave();">
<textarea name="text" id="text" style="width: 100%;height: 100%;"></textarea>
</form>
<script language="javascript" type="text/javascript">
	document.FORMPOST.elements["text"].value=opener.document.FORMPOST.elements["<?php echo $ref ?>"].value;
	//tinyMCE.setContent(opener.document.FORMPOST.elements["<?php echo $ref ?>"].value);
</script>
</body>
</html>
