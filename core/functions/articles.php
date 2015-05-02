<?php
	function new_article ($article_data) {
		//array_walk ($article_data, 'array_sanitize');
		$fields = implode (',', array_keys ($article_data));
		$data = '\'' . implode ('\', \'', $article_data) . '\'';
		$GLOBALS['con']->query ("INSERT INTO article ($fields) VALUES ($data)");
	}
	function new_comment ($comment_data) {
		array_walk ($comment_data, 'array_sanitize');
		$fields = implode (',', array_keys ($comment_data));
		$data = '\'' . implode ('\', \'', $comment_data) . '\'';
		$GLOBALS['con']->query ("INSERT INTO comment ($fields) VALUES ($data)");
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

	function article_ids ($all) {
		$result = $GLOBALS['con']->query ("SELECT id, user, type FROM article");
		$result->data_seek(0);
		$rows = array();
		while ($row = $result->fetch_assoc()) {
			if ($row['type'] == 0 || $all == true) {
				array_push($rows, $row['id']);
			}
		}
		return $rows;
	}

	function comment_ids_from_article ($article, $all) {
		$article = (int)$article;
		$result = $GLOBALS['con']->query ("SELECT id, type FROM comment WHERE article=" . $article);
		$result->data_seek(0);
		$rows = array();
		while ($row = $result->fetch_assoc()) {
			if ($row['type'] == 0 || $all == true) {
				array_push($rows, $row['id']);
			}
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
	
	function del_article ($id) {
		$id = (int) $id;
		$GLOBALS['con']->query ("DELETE FROM article WHERE id='$id'");
	}
?>
