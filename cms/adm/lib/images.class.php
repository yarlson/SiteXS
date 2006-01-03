<?php
include_once "lib/files.class.php";
class images extends files {
	var $root="/images";

	function images () {
		parent::files();
	}

	function upload() {
		$im=@getimagesize($_FILES["pic"]["tmp_name"]);
		if ($im[2])
			parent::upload();
		else {
			$_SESSION["warning"]="Файл <b>".$_FILES["pic"]["name"]."</b> не является графическим!";
			header("Location: ?chid=$this->chid&dir=$this->dir&w=1");
		}
	}

}
?>