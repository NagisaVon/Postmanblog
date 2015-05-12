<?php
	include ('core/init.php');
    setcookie ("user_id", "", time () - 1, '/');
    setcookie ("password", "", time () - 1, '/');
	session_destroy ();
	header ("Location:landing.php");
?>