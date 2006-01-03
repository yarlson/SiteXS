<?php
class modules {

	function defaultAction() {
		include "lib/config.inc.php" ;
		foreach ($nav as $key => $value) {
			if ($_GET["chid"]==$value[0]) $sub[]=$key;
		}
		foreach ($sub as $key => $value) {
			$im = ($nav[$value][3]) ? $nav[$value][3] : "dot.gif";
			$name="<img src=\"i/".$im."\" alt=\"\" border=\"0\" align=\"absmiddle\" hspace=\"6\" width=\"16\" height=\"16\">".$nav[$value][1]."";
			$this->elements["content"].="<h4><a href=\"?chid=$value\">".$name."</a></h4>";
		}
	}

}

?>