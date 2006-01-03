<?php
$GLOBALS['now'] = gmdate('D, d M Y H:i:s') . ' GMT';
header('Expires: ' . $GLOBALS['now']); // rfc2616 - Section 14.21
header('Last-Modified: ' . $GLOBALS['now']);
header('Cache-Control: no-store, no-cache, must-revalidate, pre-check=0, post-check=0, max-age=0'); // HTTP/1.1
header('Pragma: no-cache'); // HTTP/1.0
header("Content-Type: text/html; charset=windows-1251");
include_once("../lib/adm.class.php");
$cur_dir="/images$dir";
$d=admin::getDocumentRoot()."/images$dir";
if ($handle = opendir($d)) {
$fa=array();
    /* This is the correct way to loop over the directory. */
    while (false !== ($file = readdir($handle))) { 
		$file=rawurlencode($file);
        if (is_dir("$d/".urldecode($file))) $file="%%%%/".$file;
		array_push($fa, $file);
    }
	sort($fa);
	foreach($fa as $k => $v)
		$fa[$k]=preg_replace("'^\%\%\%\%'", "", $v);
	$it[1]="GIF";
	$it[2]="JPEG";
	$it[3]="PNG";
	foreach($fa as $key=>$value) {
		$ext_a=explode(".", $value);
		$ext=$ext_a[sizeof($ext_a)-1];
		if ($value!=="/."  && ($ext=="gif" || $ext=="jpg" || $ext=="jpeg" || $ext=="png" || substr($value, 0,1)=="/")) {
			if (substr($value, 0,1)=="/") {
				if ($value=="/..") {
					$va=explode("/", $dir);
					array_pop($va); $dir1=implode("/",$va);
					$value1="";
				}
				else {
					$dir1=$dir;
					$value1=$value;
				}
				$image_manager_tr.="<tr><td><b><a href=\"im.php?dir=$dir1$value1&fake=".time()."\" onClick=\"javascript:parent.UPLOAD.document.NEWIMAGE.path.value='$dir1$value1';\">$value</a></td><td>".$lang["Folder"]."</b></td></tr>\n";
			}
			else {
				$size = getimagesize ("$d/".urldecode($value));
				$fs=stat("$d/".urldecode($value));
				$a=print_copy_link("$d/".$value,urldecode($value));
				$image_manager_tr.="<tr><td>".$a."</td><td align=\"right\">".($fs[7]/1000)."K</td></tr>\n";
			}
		}
	}
    closedir($handle);
	chdir("../");
	eval('$image_manager="'.admin::template("im").'";');
	echo $image_manager;
}

function print_copy_link($path, $name) {
  global $server_path, $HTTP_SERVER_VARS;
  $imgsize=GetImageSize(urldecode($path));
  $width=$imgsize[0];
  $height=$imgsize[1];
  $path=ereg_replace("/+","/",$path);
  $path=ereg_replace(admin::getDocumentRoot(),"http://".$HTTP_SERVER_VARS["HTTP_HOST"]."",$path);
  //$name=ereg_replace("\....$","",$name); // remove the extension in the name
  //$name=ucfirst(ereg_replace("_"," ",$name)); // replace underscores by spaces and capitalize
  $str.= "<a href=\"#\" onClick=\"top.document.forms[0].elements['ImgUrl'].value='$path';";
  $str.= "top.document.forms[0].elements['ImgWidth'].value=$width;";
  $str.= "top.document.forms[0].elements['ImgHeight'].value=$height;";
  $str.= "top.document.PREVIEWPIC.src='$path'; return false;\">$name</a>";
  return $str;
}
?>