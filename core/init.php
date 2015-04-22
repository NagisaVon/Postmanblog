<?php
	session_start();
	//error_reporting(0);
	error_reporting(E_ALL);
	date_default_timezone_set('Asia/Shanghai');
	
	require 'database/connect.php';
	require 'functions/general.php';
	require 'functions/users.php';
	require 'functions/articles.php';
	
	header("Content-Type: text/html; charset=UTF-8");

	if (!logged_in ()) {
		auto_login ();
	}
	if (logged_in ()) {
		$session_user_id = $_SESSION['user_id'];
		$user_data = get_user_data ($session_user_id);
	}
?>
