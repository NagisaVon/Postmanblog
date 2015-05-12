<?php
	include 'core/init.php';
	if (isset ($_POST['release']) && isset ($_POST['user']) && isset ($_POST['name']) && isset ($_POST['album']) && isset ($_POST['type'])) {
		$article_data = array(
			'user'     => $user_data['user_id'],
			'name'     => $_POST['name'],
			'content'  => $_POST['content'],
			'datetime' => date('Y-m-d H:i:s'),
			'type'     => $_POST['type'],
			'album'    => (int) album_id_from_name($user_data['user_id'], $_POST['album'])
			);
		new_article ($article_data);
	}
?>
