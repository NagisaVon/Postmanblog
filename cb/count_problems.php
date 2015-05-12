<?php
	include 'core/init.php';
	if (isset ($_GET['all'])) {
		echo count (problem_ids ());
	} else {
		echo count (problem_id_from_user ($user_data['user_id']));
	}
?>
