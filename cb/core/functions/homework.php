<?php
	function new_homework ($homework_data) {
		array_walk ($homework_data, 'array_sanitize');
		$fields = implode (',', array_keys ($homework_data));
		$data = '\'' . implode ('\', \'', $homework_data) . '\'';
		$GLOBALS['con']->query ("INSERT INTO homework ($fields) VALUES ($data)");
	}

	function homework_data ($id) {
		$data = array();
		$id = (int) $id;

		$func_num_args = func_num_args ();
		$func_get_args = func_get_args ();

		if ($func_num_args > 1) {
			unset($func_get_args[0]);
			$fields = implode (',', $func_get_args);
			$data = mysqli_fetch_assoc ($GLOBALS['con']->query ("SELECT $fields FROM homework WHERE id='$id'"));
			return $data;
		}
	}

	function homework_id_from_teacher ($teacher) {
		$teacher = (int) $teacher;
		$result = $GLOBALS['con']->query ("SELECT id FROM homework WHERE teacher='$teacher'");
		$result->data_seek(0);
		$rows = array();
		while ($row = $result->fetch_assoc()) {
			array_push($rows, $row['id']);
		}
		return $rows;
	}

	function homework_id_from_subject ($subject) {
		$subject = (int) $subject;
		$result = $GLOBALS['con']->query ("SELECT id FROM homework WHERE subject='$subject'");
		$result->data_seek(0);
		$rows = array();
		while ($row = $result->fetch_assoc()) {
			array_push($rows, $row['id']);
		}
		return $rows;
	}

	function homework_exists ($id) {
		$id = (int) $id;
		$result = $GLOBALS['con']->query ("SELECT * FROM homework WHERE id='$id'");
		return ($result->num_rows) ? true : false;
	}

	function del_homework ($id) {
		$id = (int) $id;
		$GLOBALS['con']->query ("DELETE FROM homework WHERE id='$id'");
	}
?>
