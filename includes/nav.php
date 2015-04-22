<li><a href="index.php">Home</a></li>
<li><a href="article_list.php">Blog</a></li>
<?php 
	if (!isset ($user_data)) {
		echo '<li><a href="login.php">Log in</a><ul>';
		echo '<li><a href="register.php">Register</a></li>';
		echo '</ul></li>';
	}
	else{ 
		echo '<li><a href="profile.php">' . $user_data['username'] . '</a><ul>';
		echo '<li><a href="logout.php">Logout</a></li>';
		echo '</ul></li>';
	}
?>
<?php
	if (isset ($user_data) && $user_data['type'] == 0) {
		echo '<li><a href="admin/new_article.php">Admin</a></li>';
	}
?>
<!--<li><a href="works.html">Works</a></li>
<li><a href="contact.html">Contact</a></li>-->
