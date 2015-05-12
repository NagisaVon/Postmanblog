<?php
	include 'core/init.php';
	if (isset ($_POST['from']) && isset ($_POST['name']) && isset ($_POST['type'])) {
			$GLOBALS['con']->query ("UPDATE article SET name='" . sanitize ($_POST['name']) . "', content='" . sanitize ($_POST['content']) . "', datetime='" . date('Y-m-d H:i:s') . "', type='" . $_POST['type'] . "' WHERE id='" . $_POST['from'] . "'");
		}
?>
