<?php
	function array_sanitize (&$item) {// Sanitize all strings in an array
		if (is_string ($item)) {
			$item = htmlentities (mysqli_real_escape_string ($GLOBALS['con'], $item),ENT_NOQUOTES,"utf-8");
		}
	}

	function sanitize ($data) {// Sanitize the string $data
		return htmlentities (mysqli_real_escape_string ($GLOBALS['con'], $data),ENT_NOQUOTES,"utf-8");
	}

	function tf ($str) {// Text format
		return str_replace("\n","<br/>",str_replace(" ","&nbsp;",$str));
	}
?>
