<?php
class files {

	var $chid;
	var $dir;
	var $root="/download";
	var $global_dir;
	
	function files () {
		global $HTTP_GET_VARS, $HTTP_POST_VARS;
		$this->chid=$HTTP_GET_VARS["chid"];
		$this->name=$HTTP_GET_VARS["name"];
		$this->names=$HTTP_GET_VARS["names"];
		$this->from=$HTTP_GET_VARS["from"];
		$this->to=$HTTP_POST_VARS["to"];
		$this->dir=preg_replace("'(\/\.\.)+|(\.\.\/)+|(\.\.)+|/$'is", "", urldecode($HTTP_GET_VARS["dir"]));
		$this->global_dir=admin::getDocumentRoot().$this->root.$this->dir;
	}
	
	function defaultAction () {
		$dirs=explode("/", $this->dir);
		
		if ($this->dir) $localBreadCrumbs="<a href=\"?chid=".$this->chid."\">".$this->root."</a>";
		else $localBreadCrumbs=$this->root;
		
		for ($i=1; $i<sizeof($dirs);$i++) {
			$path.="/".$dirs[$i];
			if ($i==sizeof($dirs)-1)
				$localBreadCrumbs.="/<b>".$dirs[$i]."</b>";
			else
				$localBreadCrumbs.="/<a href=\"?chid=".$this->chid."&dir=".$path."\">".$dirs[$i]."</a>";
		}
		
		if ($handle = opendir($this->global_dir)) {
			while (false !== ($file = readdir($handle))) { 
				if (is_dir($this->global_dir."/$file")) $file="/".$file;
				$fa[]=$file;
			}
			natcasesort($fa);
			clearstatcache();
			foreach($fa as $key=>$value) {
				$pi=pathinfo($value);
				$ext=$pi["extension"];
				$stat=stat($this->global_dir."/".$value);
				if ($value!=="/.") {
					$ii++;
					if (substr($value, 0,1)=="/") {
						if ($value=="/..") {
							$va=explode("/", $this->dir);
							array_pop($va); $dir1=implode("/",$va);
							$value1="";
							$folder_tr.="<tr id=\"tr".$ii."\" class=\"default\"><td></td><td><a href=\"?chid=".$this->chid."&dir=$dir1\">$value</a></td><td>Папка</td><td></td><td></td></tr>\n";
						}
						else {
							$dir1=$dir;
							$value1=$value;
							$folder_tr.="<tr id=\"tr".$ii."\" class=\"default\" onclick=\"return CheckTR(this);\"><td align=\"center\"><input type=\"Checkbox\" value=\"$value\" id=\"cb".$ii."\" onclick=\"return CheckCB(this);\" name=ids class=\"check\"></td><td><a href=\"?chid=".$this->chid."&dir=$this->dir$value1\">$value</a></td><td>Папка</td><td></td><td></td></tr>\n";
						}
					}
					else {
						$files_tr.="<tr id=\"tr".$ii."\" class=\"default\" onclick=\"return CheckTR(this);\"><td align=\"center\"><input type=\"Checkbox\" id=\"cb".$ii."\" value=\"$value\" onclick=\"return CheckCB(this);\" name=ids class=\"check\"></td><td><a href=\"".$this->root.$this->dir."/$value\" target=\"_blank\">$value</a></td><td>".$this->_getType($this->global_dir."/".$value, $ext)."</td><td>".number_format($stat[7]/1000, 2, ',', ' ')." КБ</td><td>".date("d.m.Y H:i",$stat[9])."</td></tr>\n";
					}
				}
			}
			$files_tr=$folder_tr.$files_tr;
			closedir($handle);
			eval('$content="'.admin::template("files").'";');
		}
		$this->elements["content"]=$content;
	}

	function addNewDir () {
		mkdir ("$this->global_dir/$this->name", 0777);
		chmod ("$this->global_dir/$this->name", 0777);
		header("Location: ?chid=$this->chid&dir=$this->dir");
	}

	function rename () {
		rename("$this->global_dir/$this->from", "$this->global_dir/$this->to");
		header("Location: ?chid=$this->chid&dir=$this->dir");
	}

	function delete() {
		foreach ($this->name as $key => $name) {
			if (substr($name, 0, 1)=="/") {
				$rm=@rmdir("$this->global_dir$name");
				if (!$rm) $f="&fail=".(!$rm);
			}
			else {
				@unlink("$this->global_dir/$name");
			}
		}
		header("Location: ?chid=$this->chid&dir=$this->dir");
	}

	function upload () {
		if (is_uploaded_file($_FILES["pic"]["tmp_name"])) {
			$pic_name=$_FILES["pic"]["name"];
			copy($_FILES["pic"]["tmp_name"],"$this->global_dir/$pic_name");
			chmod("$this->global_dir/$pic_name", 0777);
		}
		header("Location: ?chid=$this->chid&dir=$this->dir");
	}

	function _getType($file, $ext) {
		$type=array(1 => "GIF", "JPG", "PNG", "SWF", "PSD", "BMP", "TIFF", "TIFF", "JPC", "JP2", "JPX", "JB2", "SWC", "IFF");
		$t=@getimagesize($file);
		return "Файл \"".(($type[$t[2]]) ? $type[$t[2]] : strtoupper($ext))."\"";
	}
}

?>
