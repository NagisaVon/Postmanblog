<?php
	session_start();
	//error_reporting(0);
	error_reporting(E_ALL);
	date_default_timezone_set('Asia/Shanghai');
	
	require 'config/class.hash.php';
	require 'database/connect.php';
	require 'functions/general.php';
	require 'functions/users.php';
	require 'functions/teachers.php';
	require 'functions/homework.php';
	require 'functions/chats.php';
	require 'functions/daily.php';
	require 'functions/works.php';
	require 'functions/problems.php';
	require 'functions/messages.php';
	require 'functions/files.php';
	require 'qiniu/autoload.php';

	header("Content-Type: text/html; charset=UTF-8");
	$GLOBALS['web_url'] = 'http://centerbrain.cn';

	if (!logged_in ()) {
		auto_login ();
	}
	if (logged_in ()) {
		$session_user_id = $_SESSION['user_id'];
		$user_data = get_user_data ($session_user_id);
		if ($user_data['id_code'] != "") {
			$teacher_data = teacher_data ($user_data['id_code'], 'subject', 'class', 'diclass', 'type');
		}
	}
?>
