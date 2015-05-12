<?php
	include 'core/init.php';
	if (isset ($_GET['all'])) {
		echo count (article_ids ($user_data['user_id'], $user_data['type']));
	} else if ($_GET['album'] >= 0) {
		echo count (article_id_from_album_access ($_GET['album'], $user_data['user_id'], $user_data['type']));
	} else {
		echo count (article_id_from_user_access ($user_data['user_id'], $user_data['type']));
	}
?>