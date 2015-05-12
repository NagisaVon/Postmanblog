<?php
	$host_name = "127.0.0.1";
	$db_username = "postmanb_postman";
	$db_password = "621661999";
	$db_name = "postmanb_database";

	if (!isset($GLOBALS['con'])) {
		$GLOBALS['con'] = new mysqli($host_name, $db_username, $db_password, $db_name);
		$GLOBALS['con']->query("SET NAMES UTF8");
		$GLOBALS['con']->query("CHARACTER SET UTF8");
		$GLOBALS['con']->query("COLLATION_CONNECTION='utf8_general_ci'");
	}
?>
