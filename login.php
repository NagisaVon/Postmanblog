<?php
	include 'core/init.php'; // include all functions
	$message = ""; // the error messages
	if (isset ($_POST['submit'])) {
		if (!isset ($_POST['username'])) { //find error
			$message .= "Please input your username.<br/>";
		} if (!isset ($_POST['password'])) {
			$message .= "Please input your password.<br/>";
		}
		if ($message == "") { // no errors
			$username = strtolower ($_POST['username']); // to lower string
			$password = $_POST['password'];
			if (user_exists ($username)) {
				if (md5 ($password) == user_password_from_username ($username)) {
					$login = login ($username, $password);
					if (!($login === false)) { // everything good
						$_SESSION['user_id'] = $login;
						$_SESSION['username'] = $username;
						$_SESSION['password'] = $password;
						if (isset ($_POST['remember'])) { // remember me
							setcookie ('user_id', $login, time () + 86400 * 90, '/');
							setcookie ('password', encrypt ($password, $encryption_key), time () + 86400 * 90, '/');
						}
						header ('Location:index.php');
						exit; // make sure the following code will NOT be execute
					}
				} else {
					$message .= "Password incorrect.</br>";
				}
			} else { // the username is not exists
				$message .= "User not exists.<br/>";
			}
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include 'includes/head.php'; ?>
		<title>Login | Postman's Blog</title>
	</head>
	<body>
		<p/>
		<div align="center">
			<h3>Login</h3>
			<form action="login.php" method="POST">
				<input name="username" type="required" placeholder="Your username" required>
				<input name="password" type="password" placeholder="Your password" required>
				<input name="submit" type="submit" value="Login">
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