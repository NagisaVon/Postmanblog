<?php
	include 'core/init.php';
	if (isset ($_GET['all'])) {
		echo count (album_ids ());
	} else {
		echo count (album_id_from_user_by_type ($_GET['user_id'], $_GET['type']));
	}
?>