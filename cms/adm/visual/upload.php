<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1251">
<STYLE TYPE="text/css">
 BODY   {font-family:Verdana; font-size:8pt; background:menu}
 INPUT  {font-family:Verdana; font-size:8pt;}
</STYLE>
</head>

<body bottommargin="0" leftmargin="0" marginheight="0" marginwidth="0" rightmargin="0" topmargin="0">
<?php
if ($submit) {
if (is_uploaded_file($UPLOAD)) {
	$UPLOAD_name=$HTTP_POST_FILES["UPLOAD"]["name"];
	if ($type=="images") {
		if (preg_match("'.jpeg$|.jpg$|.gif|.png'", $UPLOAD_name)) {
			if ($process) {
				$sz=getimagesize($UPLOAD);
				$width=$sz[0];
				$height=$sz[1];
				$nw=300;
				$nsw=150;
				if ($width>$nw) {
					$new_width=$nw;
					$new_height=(int) ($height*$nw/$width);
					$im=imagecreatetruecolor($new_width, $new_height);
					$im1=imagecreatefromjpeg ($UPLOAD);
					imagecopyresampled ($im, $im1, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
					imagejpeg ($im, getenv("DOCUMENT_ROOT")."/$type$path/$UPLOAD_name");
					chmod(getenv("DOCUMENT_ROOT")."/$type$path/$UPLOAD_name", 0777);
				}
				else {
					copy($UPLOAD,getenv("DOCUMENT_ROOT")."/$type$path/$UPLOAD_name");
					chmod(getenv("DOCUMENT_ROOT")."/$type$path/$UPLOAD_name", 0777);
				}
				
				if ($width>$nsw) {
					$new_width=$nsw;
					$new_height=(int) ($height*$nsw/$width);
					$im=imagecreatetruecolor($new_width, $new_height);
					$im1=imagecreatefromjpeg ($UPLOAD);
					imagecopyresampled ($im, $im1, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
					imagejpeg ($im, getenv("DOCUMENT_ROOT")."/$type/small/$UPLOAD_name");
					chmod(getenv("DOCUMENT_ROOT")."/$type/small/$UPLOAD_name", 0777);
				}
				else {
					copy($UPLOAD,getenv("DOCUMENT_ROOT")."/$type/small/$UPLOAD_name");
					chmod(getenv("DOCUMENT_ROOT")."/$type/small/$UPLOAD_name", 0777);
				}
			}
			else {
				copy($UPLOAD,getenv("DOCUMENT_ROOT")."/$type$path/$UPLOAD_name");
				chmod(getenv("DOCUMENT_ROOT")."/$type$path/$UPLOAD_name", 0777);
			}
		}
		else {
			echo "<script language=\"JavaScript\">alert('Wrong file type! Only JPEG(.jpeg, ,jpg) or GIF(.gif) images are allowed.');</script>";
		}
	}
	else {
		if (!preg_match("'.php$|.pl$|.cgi'", $UPLOAD_name)) {
			copy($UPLOAD,getenv("DOCUMENT_ROOT")."/$type$path/$UPLOAD_name");
			chmod(getenv("DOCUMENT_ROOT")."/$type$path/$UPLOAD_name", 0777);
		}
		else {
			echo "<script language=\"JavaScript\">alert('Wrong file type! PHP, PL, CGI files are not allowed!');</script>";
		}
	}
}
echo "<script language=\"JavaScript\">parent.IMGPICK.document.location=top.IMGPICK.document.location;</script>";
}
?>
<form enctype="multipart/form-data" name="NEWIMAGE" style="margin: 0px 0px 0px 0px;" method="post">
<input type="hidden" name="path" value="<?php echo $path ?>">
<b>Загрузите <?php if ($type=="images") echo "новое изображение"; else echo "новый файл"; ?>:</b>
<fieldset style="padding : 5px;">
<input type="file" name="UPLOAD"> <input type="submit" name="submit" value="Загрузить"><?php if ($type=="images") echo "&nbsp;<input type=\"checkbox\" name=\"process\" value=\"1\">&nbsp; Обработать"?>
</fieldset>
</form>
</body>
</html>
