<?php
	error_reporting (0);
	require_once ("core/email.class.php");
	$smtp = new smtp ("smtp.163.com", "25", true, "centerbrain_email", "31415926");
	$smtp->debug = false;
	$smtp->sendmail ("chenwei2000121@163.com", "centerbrain_email@163.com", "Hi", "啦啦啦","HTML");
?>
