<?php
	function new_message ($message_data) {
		array_walk ($message_data, 'array_sanitize');
		$fields = implode (',', array_keys ($message_data));
		$data = '\'' . implode ('\', \'', $message_data) . '\'';
		$GLOBALS['con']->query ("INSERT INTO message ($fields) VALUES ($data)");
	}

	function send_message ($content, $link, $type, $user) {
		$message_data = array(
			'content'  => $content,
			'link'     => $link,
			'type'     => $type,
			'user'     => $user,
			'datetime' => date ('Y-m-d H:i:s'));
		new_message ($message_data);
	}

	function message_data ($id) {
		$data = array();
		$id = (int) $id;

		$func_num_args = func_num_args ();
		$func_get_args = func_get_args ();

		if ($func_num_args > 1) {
			unset($func_get_args[0]);
			$fields = implode (',', $func_get_args);
			$data = mysqli_fetch_assoc ($GLOBALS['con']->query ("SELECT $fields FROM message WHERE id='$id'"));
			return $data;
		}
	}
	function message_id_from_user ($user) {
		$user = (int) $user;
		$result = $GLOBALS['con']->query ("SELECT id, type, user FROM message");
		$result->data_seek(0);
		$rows = array();
		while ($row = $result->fetch_assoc()) {
			if ($row['type'] == 1 || $row['user'] == $user)
			array_push($rows, $row['id']);
		}
		return $rows;
	}
	function message_id_from_user_unread ($user) {
		$user = (int) $user;
		$result = $GLOBALS['con']->query ("SELECT id, type, user, state FROM message");
		$result->data_seek(0);
		$rows = array();
		while ($row = $result->fetch_assoc()) {
			if ($row['state'] == 0 && ($row['type'] == 1 || $row['user'] == $user))
			array_push($rows, $row['id']);
		}
		return $rows;
	}
?>