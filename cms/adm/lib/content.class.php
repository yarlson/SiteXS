<?php

class content {

	var $elements;
	
	function defaultAction () {
		global $HTTP_SERVER_VARS;
		include ("./lib/config.inc.php");
		$db= new sql;
		$db->connect();
		$result = $db->query('SELECT VERSION() AS version');
		if ($result != FALSE && $db->num_rows($result) > 0) {
			$row   = $db->fetch_array($result);
			$match = $row['version'];
		}
		else {
			$result = $db->query('SHOW VARIABLES LIKE \'version\'');
			if ($result != FALSE && $db->num_rows($result) > 0){
				$row   = $db->fetch_array($result);
				$match = $row[1];
			}
		}
		$this->MYSQL_VER=$match;
		$this->PHP_OS=PHP_OS;
		$this->PHP_VERSION=PHP_VERSION;
		$this->CMS=$admin_config["name"]." ".$admin_config["version"];
		$this->AUTHOR=$admin_config["author"];
		$this->HOME_PAGE=$admin_config["home_page"];
		$content=admin::template("info", $this);
		$this->elements["content"]=$content;
	}

}
?>
