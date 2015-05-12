<?php
	include 'core/init.php';
	if (isset ($_POST['release']) && isset ($_POST['user']) && isset ($_POST['name']) && isset ($_POST['type'])) {
		if (album_name_exists ($user_data['user_id'], $_POST['name'])) {
			echo "你已经有一个名为《" . $_POST['name'] . "》的专辑了";
			die ();
		} else {
			$album_data = array(
				'user'     => $user_data['user_id'],
				'name'     => $_POST['name'],
				'note'     => $_POST['note'],
				'datetime' => date('Y-m-d H:i:s'),
				'type'     => $_POST['type']
				);
			new_album ($album_data);
		}
	}
?>