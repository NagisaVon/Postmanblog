<?php
	function new_problem ($problem_data) {
		array_walk ($problem_data, 'array_sanitize');
		$fields = implode (',', array_keys ($problem_data));
		$data = '\'' . implode ('\', \'', $problem_data) . '\'';
		$GLOBALS['con']->query ("INSERT INTO problem ($fields) VALUES ($data)");
		return $GLOBALS['con']->insert_id;
	}

	function problem_data ($id) {
		$data = array();
		$id = (int) $id;

		$func_num_args = func_num_args ();
		$func_get_args = func_get_args ();

		if ($func_num_args > 1) {
			unset($func_get_args[0]);
			$fields = implode (',', $func_get_args);
			$data = mysqli_fetch_assoc ($GLOBALS['con']->query ("SELECT $fields FROM problem WHERE id='$id'"));
			return $data;
		}
	}

	function problem_id_from_user ($user) {
		$user = (int) $user;
		$result = $GLOBALS['con']->query ("SELECT id FROM problem WHERE user='$user'");
		$result->data_seek(0);
		$rows = array();
		while ($row = $result->fetch_assoc()) {
			array_push($rows, $row['id']);
		}
		return $rows;
	}
	function problem_ids () {
		$result = $GLOBALS['con']->query ("SELECT id FROM problem");
		$result->data_seek(0);
		$rows = array();
		while ($row = $result->fetch_assoc()) {
			array_push($rows, $row['id']);
		}
		return $rows;
	}

	function problem_exists ($id) {
		$id = (int) $id;
		$result = $GLOBALS['con']->query ("SELECT * FROM problem WHERE id='$id'");
		return ($result->num_rows) ? true : false;
	}

	function del_problem ($id) {
		$id = (int) $id;
		$GLOBALS['con']->query ("DELETE FROM problem WHERE id='$id'");
	}
	
	function new_answer ($answer_data) {
		array_walk ($answer_data, 'array_sanitize');
		$fields = implode (',', array_keys ($answer_data));
		$data = '\'' . implode ('\', \'', $answer_data) . '\'';
		$GLOBALS['con']->query ("INSERT INTO answer ($fields) VALUES ($data)");
	}
	function answer_data ($id) {
		$data = array();
		$id = (int) $id;

		$func_num_args = func_num_args ();
		$func_get_args = func_get_args ();

		if ($func_num_args > 1) {
			unset($func_get_args[0]);
			$fields = implode (',', $func_get_args);
			$data = mysqli_fetch_assoc ($GLOBALS['con']->query ("SELECT $fields FROM answer WHERE id='$id'"));
			return $data;
		}
	}
	function answer_id_from_problem ($problem) {
		$problem = (int) $problem;
		$result = $GLOBALS['con']->query ("SELECT id FROM answer WHERE problem='$problem'");
		$result->data_seek(0);
		$rows = array();
		while ($row = $result->fetch_assoc()) {
			array_push($rows, $row['id']);
		}
		return $rows;
	}
?>