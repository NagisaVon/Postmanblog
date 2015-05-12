<?php
	include 'core/init.php';
	if (isset ($_POST['name']) && isset ($_POST['subject']) && isset ($_POST['from'])) {
		$GLOBALS['con']->query ("UPDATE problem SET name='" . sanitize ($_POST['name']) . "', content='" . sanitize ($_POST['content']) . 
			"', datetime='" . date('Y-m-d H:i:s') . "', subject='" . $_POST['subject'] . "' WHERE id='" . $_POST['from'] . "'");
	}
?>
