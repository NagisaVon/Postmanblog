<?php
	function file_data ($id) {
		$data = array();
		$id = (int) $id;

		$func_num_args = func_num_args ();
		$func_get_args = func_get_args ();

		if ($func_num_args > 1) {
			unset($func_get_args[0]);
			$fields = implode (',', $func_get_args);
			$data = mysqli_fetch_assoc ($GLOBALS['con']->query ("SELECT $fields FROM files WHERE id='$id'"));
			return $data;
		}
	}

	function file_id_from_user ($user) {
		$user = (int) $user;
		$result = $GLOBALS['con']->query ("SELECT id FROM files WHERE from_id='$user'");
		@$result->data_seek(0);
		$rows = array();
		while ($row = $result->fetch_assoc()) {
			array_push($rows, $row['id']);
		}
		return $rows;
	}
?>