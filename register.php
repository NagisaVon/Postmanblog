<?php
	include 'core/init.php'; // include all functions
	$message = ""; // the error messages
	if (isset ($_POST['submit'])) {
		if (!isset ($_POST['username'])) { //find error
			$message .= "Please input your username.<br/>";
		} if (!isset($_POST['email'])) {
			$message .= "Please input your email.<br/>";
		} if (!isset ($_POST['password'])) {
			$message .= "Please input your password.<br/>";
		} if (!isset ($_POST['confirm'])) {
			$message .= "Please confirm your password.<br/>";
		} if ($_POST['confirm'] != $_POST['password']) {
			$message .= "Password doesn't match the confirmation.<br/>";
		} if (user_exists ($_POST['username'])) {
			$message .= "User already exists";
		}
		if ($message == "") { 
			$usertype = '1';
			$register_data = array(
				'username'     => $_POST['username'],
				'email'		   => $_POST['email'],
				'password'     => $_POST['password'],
				'type'         => $usertype);
			register_user ($register_data);
			$login = login ($_POST['username'], $_POST['password']);
			if (!($login === false)) { // everything good
						$_SESSION['user_id'] = $login;
						$_SESSION['username'] = $_POST['username'];
						$_SESSION['password'] = $_POST['password'];
						//if (isset ($_POST['remember'])) { // remember me
						setcookie ('user_id', $login, time () + 86400 * 90, '/');
						require 'core/functions/secure.php';
						setcookie ('password', encrypt ($_POST['password'], $encryption_key), time () + 86400 * 90, '/');
						header ('Location:index.php');
						exit; // make sure the following code will NOT be execute
			}
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include 'includes/head.php'; ?>
		<title>Register | Postman's Blog</title>
	</head>
	<body>
		<!-- Header
		================================================== -->
		<?php include 'includes/header.php'; ?>
		<p/>
		<div align="center">
			<h3>Register</h3>
			<form action="register.php" method="POST">
				<input name="username" type="required" placeholder="Your username" required>
				<input name="email" type="required" placeholder="Your email address" required>
				<input name="password" type="password" placeholder="Your password" required>
				<input name="confirm" type="password" placeholder="Confirm you password" required>
				<input name="submit" type="submit" value="Confirm">
			</form>
			<p/>
			<?php
				if (isset ($message) && $message != "") {
					echo '<font color="red">Error Messages:<br/>' . $message . '</font>'; // echo all error messages if the login process was unsuccessful
				}
			?>
		</div>
	</body>
</html>