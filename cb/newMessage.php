<?php
	include 'core/init.php';
	if (isset ($_POST['ChatText'])) {
		$chat_data = array(
			'user_id'  => (int) $_POST['user_id'],
			'to_id'    => (int) $_POST['to_id'],
			'type'     => (int) $_POST['type'],
			'text'     => $_POST['ChatText'],
			'datetime' => date ('Y-m-d G:i:s')
			);
		new_chat ($chat_data);
	}
?>