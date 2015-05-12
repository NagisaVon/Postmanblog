<?php
	if (isset ($_GET['id'])) {
		include 'core/init.php';
		$file_data = file_data ($_GET['id'], 'name', 'url');
		header("Content-Type: text/html; charset=UTF-8");
		header("Content-Type: application/force-download");
		header("Content-Disposition: attachment; filename=" . $file_data['name']);
		echo readfile('http://' . $file_data['url']);
		?><script type="text/javascript">window.close();</script><?php
	}
?>
