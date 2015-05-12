<?php
	include 'core/init.php';
	if (isset ($_GET['all'])) {
		echo count (message_id_from_user ($_GET['user_id']));
	} else {
		echo count (message_id_from_user_unread ($_GET['user_id']));
	}
?>