<?php
	function check_email_code ($email, $email_code) {
		$result = $GLOBALS['con']->query ("SELECT * FROM users WHERE email='".$email."' AND email_code='".$email_code."' AND active='1'");
		return ($result->num_rows) ? true : false;
	}

	function activate ($email, $email_code) {
		$email = sanitize ($email);
		$email_code = sanitize ($email_code);

		$result = $GLOBALS['con']->query ("SELECT * FROM users WHERE email='".$email."' AND email_code='".$email_code."' AND active='0'");
		if ($result->num_rows) {
			$GLOBALS['con']->query ("UPDATE users SET active='1' WHERE email='$email'");
			return true;
		} else {
			return false;
		}
	}

	function resetpwd ($email, $password) {
		$email = sanitize ($email);
		$password = md5 ($password);

		$GLOBALS['con']->query ("UPDATE users SET password='$password' WHERE email='$email'");
	}

	function email ($to, $title, $body) {
		error_reporting (0);
		require_once ("email.class.php");
		$smtp = new smtp ("smtp.163.com", "25", true, "centerbrain_email", "31415926");
		$smtp->debug = false;
		$smtp->sendmail ($to, "centerbrain_email@163.com", $title, $body, "HTML");
		error_reporting (ALL);
	}

	function protect_D1 () {
		if (!logged_in ()) {
			header ('Location: index.php');
		}
	}

	function protect_D2 () { 
		if (!logged_in ()) {
			header ('Location: ../index.php');
		}
	}

	function change_email_code ($email, $email_code) {
		$email = sanitize ($email);
		$GLOBALS['con']->query ("UPDATE users SET email_code='$email_code' WHERE email='$email'");
	}

	function change_password ($user_id, $password) {
		$user_id = (int) $user_id;
		$password = sanitize ($password);
		$GLOBALS['con']->query ("UPDATE users SET password='$password' WHERE user_id='$user_id'");
	}

	function change_profile ($user_id, $nickname, $email) {
		$user_id = (int) $user_id;
		$nickname = sanitize ($nickname);
		$email = sanitize ($email);
		$GLOBALS['con']->query ("UPDATE users SET nickname='$nickname', email='$email' WHERE user_id='$user_id'");
	}

	function change_profile_class ($user_id, $p_normal, $p_math, $p_english) {
		$user_id = (int) $user_id;
		$p_math = (int) $p_math;
		$p_english = (int) $p_english;
		$GLOBALS['con']->query ("UPDATE users SET p_normal='$p_normal', p_math='$p_math', p_english='$p_english' WHERE user_id='$user_id'");
	}

	function change_user_id_code ($user_id, $id_code) {
		$GLOBALS['con']->query ("UPDATE users SET id_code='$id_code' WHERE user_id='$user_id'");
	}

	function register_user ($register_data) {
		array_walk ($register_data, 'array_sanitize');
		$register_data['password'] = md5 ($register_data['password']);
		$fields = implode (',', array_keys ($register_data));
		$data = '\'' . implode ('\', \'', $register_data) . '\'';
		$GLOBALS['con']->query ("INSERT INTO users ($fields) VALUES ($data)");

		//email ($register_data['email'], '激活你的CenterBrain账号', "Hi, " . $register_data['nickname'] . "<p/>　　您的账号还属于未激活状态，点击下面的“激活账号”链接来激活您的账号。<p/>   <a href='" . $GLOBALS['web_url'] . "/pages/activate.php?email=" . $register_data['email'] . "&email_code=" . $register_data['email_code'] . "'>激活账号</a><p/>　　——CenterBrain");
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
		return user_data ($id, 'user_id', 'email', 'password', 'nickname', 'type', 'p_math', 'p_english', 'p_normal', 'id_code');
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
			        $_SESSION['email'] = $user_data['email'];
			        $_SESSION['nickname'] = $user_data['nickname'];
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

	function user_exists ($email) {
		$email = sanitize (strtolower ($email));
		$result = $GLOBALS['con']->query ("SELECT * FROM users WHERE email='".$email."'");
		return ($result->num_rows) ? true : false;
	}

	function user_id_exists ($user_id) {
		$user_id = (int) $user_id;
		$result = $GLOBALS['con']->query ("SELECT * FROM users WHERE user_id='".$user_id."'");
		return ($result->num_rows) ? true : false;
	}

	function user_active ($email) {
		$email = sanitize (strtolower ($email));
		$result = $GLOBALS['con']->query ("SELECT * FROM users WHERE email='".$email."'");// AND active='1'");
		return ($result->num_rows) ? true : false;
	}

	function user_id_from_email ($email) {
		$email = sanitize (strtolower ($email));
		$result = $GLOBALS['con']->query ("SELECT user_id FROM users WHERE email='".$email."'");
		$result->data_seek(0);
		$row = $result->fetch_row();
		return $row[0];
	}

	function email_from_user_id ($user_id) {
		$user_id = (int) $user_id;
		$result = $GLOBALS['con']->query ("SELECT email FROM users WHERE user_id='$user_id'");
		$result->data_seek(0);
		$row = $result->fetch_row();
		return $row[0];
	}

	function nickname_from_email ($email) {
		$email = sanitize (strtolower ($email));
		$result = $GLOBALS['con']->query ("SELECT nickname FROM users WHERE email='".$email."'");
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

	function user_password_from_email ($email) {
		$email = sanitize (strtolower ($email));
		$result = $GLOBALS['con']->query ("SELECT password FROM users WHERE email='".$email."'");
		$result->data_seek (0);
		$row = $result->fetch_row();
		return $row[0];
	}

	function login ($email, $password) {
		$email = sanitize (strtolower ($email));
		$user_id = user_id_from_email ($email);
		return (md5($password) == user_password_from_email ($email)) ? $user_id : false;
	}

	function login_confirm ($user_id, $password) {
		$user_id = (int) $user_id;
		return (md5($password) == user_password_from_id ($user_id)) ? true : false;
	}

	function is_friend ($a, $b) {
		$a = (int) $a;
		$b = (int) $b;
		$result = $GLOBALS['con']->query ("SELECT * FROM friend WHERE a='$a' AND b='$b'");
		if ($result->num_rows) {
			return true;
		}
		$result = $GLOBALS['con']->query ("SELECT * FROM friend WHERE a='$b' AND b='$a'");
		return ($result->num_rows) ? true : false;
	}
?>