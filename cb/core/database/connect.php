<?php
	$host_name = "bdm127370642.my3w.com";
	$db_username = "bdm127370642";
	$db_password = "31415926";
	$db_name = "bdm127370642_db";

	if (!isset($GLOBALS['con'])) {
		$GLOBALS['con'] = new mysqli($host_name, $db_username, $db_password, $db_name);
		$GLOBALS['con']->query("SET NAMES UTF8");
		$GLOBALS['con']->query("CHARACTER SET UTF8");
		$GLOBALS['con']->query("COLLATION_CONNECTION='utf8_general_ci'");
	}
?>
