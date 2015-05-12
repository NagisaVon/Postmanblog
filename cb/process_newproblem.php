<?php
	include 'core/init.php';
	if (isset ($_POST['release']) && isset ($_POST['user']) && isset ($_POST['name']) && isset ($_POST['subject']) && isset ($_POST['type'])) {
		$problem_data = array(
			'name'     => $_POST['name'],
			'content'  => $_POST['content'],
			'datetime' => date('Y-m-d H:i:s'),
			'type'     => $_POST['type'],
			'subject'  => (int) $_POST['subject'],
			'user'     => $user_data['user_id']
			);
		echo new_problem ($problem_data);
		die();
	}
?>
