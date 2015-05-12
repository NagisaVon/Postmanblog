<?php
	function array_sanitize (&$item) {
		if (is_string ($item)) {
			$item = htmlentities (mysqli_real_escape_string ($GLOBALS['con'], $item),ENT_NOQUOTES,"utf-8");
		}
	}

	function sanitize ($data) {
		return htmlentities (mysqli_real_escape_string ($GLOBALS['con'], $data),ENT_NOQUOTES,"utf-8");
	}

	function day_len ($d1, $d2) {//How many days are there to $d2 from $d1? P.S. $d1 should be today
		return (int) (intval((date ('Y', $d2)) - intval(date ('Y', $d1))) * 365 + intval(date ('z', $d2)) - intval(date ('z', $d1)));
	}

	function iabs ($num) {
		return ($num < 0) ? -$num : $num;
	}

	function get_uday_str ($date) {
		require 'config/class.hash.php';
		$date = mktime(0, 0, 0, (int) substr($date, 5, 2), (int) substr($date, 8, 2), (int) substr($date, 0, 4)); 
		$today = mktime (0, 0, 0, (int) date ('m'), (int) date ('d'), (int) date ('Y'));
		$uday = day_len ($today, $date);
		$nday = date ('N', $date);
		if (iabs ($uday) < 3) {
			return $h_uday[$uday];
		} else if (date ('W') == date ('W', $date)) {
			return $h_day[$nday];
		} else if (iabs ((int) date ('W') - (int) date ('W', $date)) < 2) {
			$str = "";
			if (iabs ($uday) > 7 || ($uday > 0 && $nday < date ('N')) || ($uday < 0 && $nday > date ('N'))) {
				$str = ($uday > 0) ? $h_week['1'] : $h_week['-1'];
			}
			$str .= $h_day[$nday];
			return $str;
		} else {
			return date ("Y-m-d", $date);
		}
	}


	function array_class_math (&$item) {
		require 'config/class.hash.php';
		$item = $a_math[$item];
	}

	function array_class_english (&$item) {
		require 'config/class.hash.php';
		$item = $a_english[$item];
	}

	function array_class_normal (&$item) {
		require 'config/class.hash.php';
		$item = $a_normal[$item];
	}

	function array_to_int (&$item) {
		$item = (int) $item;
	}

	function tf ($str) {
		return str_replace("\n","<br/>",str_replace(" ","&nbsp;",$str));
	}
?>
