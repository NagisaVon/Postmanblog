<?php
	function check_id_code ($id_code) {
		$id_code = sanitize ($id_code);
		$result = $GLOBALS['con']->query ("SELECT * FROM id_code WHERE id_code='".$id_code."' AND used='0'");
		return ($result->num_rows) ? true : false;
	}
	function check_id_code_teacher ($id_code) {
		$id_code = sanitize ($id_code);
		$result = $GLOBALS['con']->query ("SELECT * FROM id_code WHERE id_code='".$id_code."' AND used='0' AND isteacher='1'");
		return ($result->num_rows) ? true : false;
	}

	function set_id_code_used ($id_code) {
		$GLOBALS['con']->query ("UPDATE id_code SET used='1' WHERE id_code='$id_code'");
	}

	function add_id_code ($code_data) {
		array_walk ($code_data, 'array_sanitize');
		$fields = implode (',', array_keys ($code_data));
		$data = '\'' . implode ('\', \'', $code_data) . '\'';
		$GLOBALS['con']->query ("INSERT INTO id_code ($fields) VALUES ($data)");
	}

	function teacher_data ($id_code) {
		$data = array ();
		$id_code = (int) $id_code;

		$func_num_args = func_num_args ();
		$func_get_args = func_get_args ();

		if ($func_num_args > 1) {
			unset($func_get_args[0]);
			$fields = implode (',', $func_get_args);
			$data = mysqli_fetch_assoc ($GLOBALS['con']->query ("SELECT $fields FROM id_code WHERE id_code='$id_code'"));
			return $data;
		}
	}
?>