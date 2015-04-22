<?php
	include 'core/init.php';
	if (!isset ($user_data)) {
		header ('Location: index.php');
		exit;
	}
	if (isset ($_POST['submit'])) { // if form has been post
		$message = "";
		if (!isset ($_POST['article_name']) || (isset ($_POST['article_name']) && trim ($_POST['article_name']) == "")) { // if name is empty
			$message .= "Please input the name of this article.<br/>";
		} if (!isset ($_POST['article_content']) || (isset ($_POST['article_content']) && trim ($_POST['article_content']) == "")) { // if content is empty
			$message .= "Please input the content of this article.<br/>";
		} if ($message == "") {
			$article_data = array(
				'name'     => $_POST['article_name'],
				'content'  => $_POST['article_content'],
				'datetime' => date ('Y-m-d H:i:s'),
				'type'     => $_POST['type'],
				'user'     => $user_data['user_id']);
			new_article ($article_data);
			header ('Location: article_list.php');
			exit;
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
		<a href="index.php">Home</a>
		<p/>
		<div align="center">
			<h3>New article</h3>
			<form action="new_article.php" method="POST">
				<input name="article_name" type="text" style="width:90%;" placeholder="The title of this article" required><br/>
    			<textarea name="article_content" type="text" placeholder="Write something" style='border: 1px solid #94BBE2;width:90%;' rows="20" onpropertychange='this.style.posHeight=this.scrollHeight' onfocus='textarea.style.posHeight=this.scrollHeight'></textarea><br/>
				<select name="type">
					<option value="0">Public</option>
					<option value="1">Private</option>
				</select>
				<input type="submit" name="submit" value="Release">
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