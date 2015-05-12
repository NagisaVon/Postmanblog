<?php
	function daily_data ($date) {
		$data = array();

		$func_num_args = func_num_args ();
		$func_get_args = func_get_args ();

		if ($func_num_args > 1) {
			unset($func_get_args[0]);
			$fields = implode (',', $func_get_args);
			$data = mysqli_fetch_assoc ($GLOBALS['con']->query ("SELECT $fields FROM daily WHERE date='$date'"));
			return $data;
		}
	}

	function new_daily ($daily_data) {
		$fields = implode (',', array_keys ($daily_data));
		$data = '\'' . implode ('\', \'', $daily_data) . '\'';
		$GLOBALS['con']->query ("INSERT INTO daily ($fields) VALUES ($data)");
	}

	function change_daily ($date, $title, $content) {
		$GLOBALS['con']->query ("UPDATE daily SET title='$title', content='$content' WHERE date='$date'");
	}

	function daily_exists ($date) {
		$result = $GLOBALS['con']->query ("SELECT * FROM daily WHERE date='".$date."'");
		return ($result->num_rows) ? true : false;
	}
?>