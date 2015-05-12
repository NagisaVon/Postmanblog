<?php
	include 'core/init.php';
	if (isset($_GET['type'])) {
		if ($_GET['type'] == 0) {
			display_messages0($_GET['ida'], $_GET['idb']);
		} else if ($_GET['type'] == 1) {
			display_messages1($user_data['user_id']);
		}
	}
?>