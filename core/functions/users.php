<?php
	function register_user ($register_data) {
		array_walk ($register_data, 'array_sanitize');
		$register_data['password'] = md5 ($register_data['password']);
		$fields = implode (',', array_keys ($register_data));
		$data = '\'' . implode ('\', \'', $register_data) . '\'';
		$GLOBALS['con']->query ("INSERT INTO users ($fields) VALUES ($data)");
	}

	function user_data ($user_id) {
		$data = array ();
		$user_id = (int) $user_id;

		$func_num_args = func_num_args ();
		$func_get_args = func_get_args ();

		if ($func_num_args > 1) {
			unset($func_get_args[0]);
			$fields = implode (',', $func_get_args);
			$data = mysqli_fetch_assoc ($GLOBALS['con']->query ("SELECT $fields FROM users WHERE user_id='$user_id'"));
			return $data;
		}
	}

	function get_user_data ($id) {
		return user_data ($id, 'user_id', 'username', 'password', 'email', 'type');
	}

	function auto_login () {
		if (!isset($session_user_id)) {
			if (isset ($_COOKIE['user_id']) && isset ($_COOKIE['password'])) {
				require 'secure.php';
				$user_id = $_COOKIE['user_id'];
				$password = decrypt ($_COOKIE['password'], $encryption_key);
				if (login_confirm ($user_id, $password)) {
					$user_data = get_user_data ($user_id);
			        $_SESSION['user_id'] = $user_id;
			        $_SESSION['username'] = $user_data['username'];
			        $_SESSION['email'] = $user_data['email'];
			        $_SESSION['password'] = $password;
			        return true;
				}
			}
			return false;
		} else {
			return true;
		}
	}

	function logged_in () {
		return (isset($_SESSION['user_id'])) ? true : false;
	}

	function user_exists ($username) {
		$username = sanitize (strtolower ($username));
		$result = $GLOBALS['con']->query ("SELECT * FROM users WHERE username='".$username."'");
		return ($result->num_rows) ? true : false;
	}

	function user_id_exists ($user_id) {
		$user_id = (int) $user_id;
		$result = $GLOBALS['con']->query ("SELECT * FROM users WHERE user_id='".$user_id."'");
		return ($result->num_rows) ? true : false;
	}

	function user_id_from_username ($username) {
		$email = sanitize (strtolower ($username));
		$result = $GLOBALS['con']->query ("SELECT user_id FROM users WHERE username='".$username."'");
		$result->data_seek(0);
		$row = $result->fetch_row();
		return $row[0];
	}

	function user_password_from_id ($user_id) {
		$user_id = (int) $user_id;
		$result = $GLOBALS['con']->query ("SELECT password FROM users WHERE user_id='$user_id'");
		$result->data_seek (0);
		$row = $result->fetch_row();
		return $row[0];
	}

	function user_password_from_username ($username) {
		$username = sanitize (strtolower ($username));
		$result = $GLOBALS['con']->query ("SELECT password FROM users WHERE username='".$username."'");
		$result->data_seek (0);
		$row = $result->fetch_row();
		return $row[0];
	}

	function login ($username, $password) {
		$username = sanitize (strtolower ($username));
		$user_id = user_id_from_username ($username);
		return (md5($password) == user_password_from_username ($username)) ? $user_id : false;
	}

	function login_confirm ($user_id, $password) {
		$user_id = (int) $user_id;
		return (md5($password) == user_password_from_id ($user_id)) ? true : false;
	}
?>
