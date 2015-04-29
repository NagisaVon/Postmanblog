<?php
	$host_name = "localhost";
	$db_username = "postmanblogwest";
	$db_password = "621661999";
	$db_name = "postmanblogwest";

	if (!isset($GLOBALS['con'])) {
		$GLOBALS['con'] = new mysqli($host_name, $db_username, $db_password, $db_name);
		$GLOBALS['con']->query("SET NAMES UTF8");
		$GLOBALS['con']->query("CHARACTER SET UTF8");
		$GLOBALS['con']->query("COLLATION_CONNECTION='utf8_general_ci'");
	}
?>
