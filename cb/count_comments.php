<?php
	include 'core/init.php';
	echo count (comment_id_from_article ($_GET['aid']));
?>