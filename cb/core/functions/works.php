<?php
	function new_article ($article_data) {
		array_walk ($article_data, 'array_sanitize');
		$fields = implode (',', array_keys ($article_data));
		$data = '\'' . implode ('\', \'', $article_data) . '\'';
		$GLOBALS['con']->query ("INSERT INTO article ($fields) VALUES ($data)");
	}
	function new_album ($album_data) {
		array_walk ($album_data, 'array_sanitize');
		$fields = implode (',', array_keys ($album_data));
		$data = '\'' . implode ('\', \'', $album_data) . '\'';
		$GLOBALS['con']->query ("INSERT INTO album ($fields) VALUES ($data)");
	}

	function article_data ($id) {
		$data = array();
		$id = (int) $id;

		$func_num_args = func_num_args ();
		$func_get_args = func_get_args ();

		if ($func_num_args > 1) {
			unset($func_get_args[0]);
			$fields = implode (',', $func_get_args);
			$data = mysqli_fetch_assoc ($GLOBALS['con']->query ("SELECT $fields FROM article WHERE id='$id'"));
			return $data;
		}
	}
	function album_data ($id) {
		$data = array();
		$id = (int) $id;

		$func_num_args = func_num_args ();
		$func_get_args = func_get_args ();

		if ($func_num_args > 1) {
			unset($func_get_args[0]);
			$fields = implode (',', $func_get_args);
			$data = mysqli_fetch_assoc ($GLOBALS['con']->query ("SELECT $fields FROM album WHERE id='$id'"));
			return $data;
		}
	}
	function album_access ($id, $user_type) {
		$id = (int) $id;
		$result = $GLOBALS['con']->query ("SELECT user, type FROM album WHERE id='$id'");
		$result->data_seek(0);
		$row = $result->fetch_row();
		if ($row['user'] == $user_id || $row['type'] == 0 || ($row['type'] == 1 && $user_type == 1) || ($row['type'] == 2 && is_friend ($row['user'], $user_id))) {
			}
		return $row[0];
	}

	function article_id_from_album ($album) {
		$album = (int) $album;
		$result = $GLOBALS['con']->query ("SELECT id FROM article WHERE album='$album'");
		$result->data_seek(0);
		$rows = array();
		while ($row = $result->fetch_assoc()) {
			array_push($rows, $row['id']);
		}
		return $rows;
	}
	function article_id_from_album_access ($album, $user_id, $user_type) {
		$album = (int) $album;
		$result = $GLOBALS['con']->query ("SELECT id, user, type FROM article WHERE album='$album'");
		$result->data_seek(0);
		$rows = array();
		while ($row = $result->fetch_assoc()) {
			if ($row['user'] == $user_id || $row['type'] == 0 || ($row['type'] == 1 && $user_type == 1) || ($row['type'] == 2 && is_friend ($row['user'], $user_id))) {
				array_push($rows, $row['id']);
			}
		}
		return $rows;
	}
	function article_id_from_user ($user) {
		$user = (int) $user;
		$result = $GLOBALS['con']->query ("SELECT id FROM article WHERE user='$user'");
		$result->data_seek(0);
		$rows = array();
		while ($row = $result->fetch_assoc()) {
			array_push($rows, $row['id']);
		}
		return $rows;
	}
	function article_id_from_user_access ($user_id, $user_type) {
		$user_id = (int) $user_id;
		$result = $GLOBALS['con']->query ("SELECT id, user, type FROM article WHERE user='$user_id'");
		$result->data_seek(0);
		$rows = array();
		while ($row = $result->fetch_assoc()) {
			if ($row['user'] == $user_id || $row['type'] == 0 || ($row['type'] == 1 && $user_type == 1) || ($row['type'] == 2 && is_friend ($row['user'], $user_id))) {
				array_push($rows, $row['id']);
			}
		}
		return $rows;
	}
	function article_ids ($user_id, $user_type) {
		$result = $GLOBALS['con']->query ("SELECT id, user, type FROM article");
		$result->data_seek(0);
		$rows = array();
		while ($row = $result->fetch_assoc()) {
			if ($row['user'] == $user_id || $row['type'] == 0 || ($row['type'] == 1 && $user_type == 1) || ($row['type'] == 2 && is_friend ($row['user'], $user_id))) {
				array_push($rows, $row['id']);
			}
		}
		return $rows;
	}
	function album_id_from_user ($user) {
		$user = (int) $user;
		$result = $GLOBALS['con']->query ("SELECT id FROM album WHERE user='$user'");
		$result->data_seek(0);
		$rows = array();
		while ($row = $result->fetch_assoc()) {
			array_push($rows, $row['id']);
		}
		return $rows;
	}
	function album_id_from_user_by_type ($user, $type) {
		$user = (int) $user;
		$type = (int) $type;
		$result = $GLOBALS['con']->query ("SELECT id FROM album WHERE user='$user' AND type='$type'");
		$result->data_seek(0);
		$rows = array();
		while ($row = $result->fetch_assoc()) {
			array_push($rows, $row['id']);
		}
		return $rows;
	}
	function album_ids () {
		$result = $GLOBALS['con']->query ("SELECT id FROM album");
		$result->data_seek(0);
		$rows = array();
		while ($row = $result->fetch_assoc()) {
			array_push($rows, $row['id']);
		}
		return $rows;
	}

	function article_exists ($id) {
		$id = (int) $id;
		$result = $GLOBALS['con']->query ("SELECT * FROM article WHERE id='$id'");
		return ($result->num_rows) ? true : false;
	}
	function article_name_exists ($user, $name) {
		$user = (int) $user;
		$email = sanitize ($name);
		$result = $GLOBALS['con']->query ("SELECT * FROM article WHERE user='$user' AND name='".$name."'");
		return ($result->num_rows) ? true : false;
	}
	function album_exists ($id) {
		$id = (int) $id;
		$result = $GLOBALS['con']->query ("SELECT * FROM album WHERE id='$id'");
		return ($result->num_rows) ? true : false;
	}
	function album_name_exists ($user, $name) {
		$user = (int) $user;
		$email = sanitize ($name);
		$result = $GLOBALS['con']->query ("SELECT * FROM album WHERE user='$user' AND name='".$name."'");
		return ($result->num_rows) ? true : false;
	}

	function album_id_from_name ($user, $name) {
		$name = sanitize ($name);
		$result = $GLOBALS['con']->query ("SELECT id FROM album WHERE user='$user' AND name='".$name."'");
		$result->data_seek(0);
		$row = $result->fetch_row();
		return $row[0];
	}

	function del_article ($id) {
		$id = (int) $id;
		$GLOBALS['con']->query ("DELETE FROM article WHERE id='$id'");
	}
	function del_album ($id) {
		$id = (int) $id;
		$GLOBALS['con']->query ("DELETE FROM album WHERE id='$id'");
	}


	function new_comment ($comment_data) {
		array_walk ($comment_data, 'array_sanitize');
		$fields = implode (',', array_keys ($comment_data));
		$data = '\'' . implode ('\', \'', $comment_data) . '\'';
		$GLOBALS['con']->query ("INSERT INTO comment ($fields) VALUES ($data)");
	}
	function comment_data ($id) {
		$data = array();
		$id = (int) $id;

		$func_num_args = func_num_args ();
		$func_get_args = func_get_args ();

		if ($func_num_args > 1) {
			unset($func_get_args[0]);
			$fields = implode (',', $func_get_args);
			$data = mysqli_fetch_assoc ($GLOBALS['con']->query ("SELECT $fields FROM comment WHERE id='$id'"));
			return $data;
		}
	}
	function comment_id_from_article ($article) {
		$article = (int) $article;
		$result = $GLOBALS['con']->query ("SELECT id FROM comment WHERE article='$article'");
		$result->data_seek(0);
		$rows = array();
		while ($row = $result->fetch_assoc()) {
			array_push($rows, $row['id']);
		}
		return $rows;
	}
	function del_comment ($id) {
		$id = (int) $id;
		$GLOBALS['con']->query ("DELETE FROM comment WHERE id='$id'");
	}
?>