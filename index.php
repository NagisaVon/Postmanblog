<?php
	include 'core/init.php';
?>
<!DOCTYPE html>
<html>

<head>
	<?php include 'includes/head.php'; ?>
	<title>Postman's Blog</title>
</head>

<body class="home">

<!-- Header
================================================== -->
<?php include 'includes/header.php'; ?>

<div id="header">
	<div class="container_12">

		<div class="grid_12">
			<h1 class="special">	
				Interesting blogs and great design<br>
				It will be finish in October 2015<br>
				Thanks everybody for supporting.<br>
			</h1>	
		</div>
	</div>
</div>

<!-- Blog Posts
================================================== -->
<div id="blogs" align="center">
	<br/>

	<h1>Recent Posts</h1>
	<?php
		$result = $GLOBALS['con']->query ("SELECT * FROM article ORDER BY id DESC");
		$result->data_seek(0);
		$js = 0;
		while ($row = $result->fetch_assoc()) {
			if (isset ($user_data) || $row['type'] == 0) {
				?><font size="5"><a href="article.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></font><br/><?php
				$js++;
				if ($js == 5) {
					break;
				}
			}
		}
	?>
	<br/>
	<a href="article_list.php">All Posts</a>
	<br/><br/><br/>
</div>

<!-- AUTHOR
================================================== -->
<div id="author">
	<div class="container_12">
		<div class="grid_3"><img class="author" src="img/icon.jpg" alt="Postman Icon"></div>

		<div class="grid_9">
			<h2>Liu Chang - Author and Programmer</h2>
			<p>Personal introduction coming soon.</p>
			<ul class="social">
				<li><a href="http://twitter.com"><img alt="Twitter" src="img/social/twitter.png"></a></li>
				<li><a href="http://facebook.com"><img alt="Facebook" src="img/social/facebook.png"></a></li>
				<li><a href="http://youtube.com"><img alt="YouTube" src="img/social/youtube.png"></a></li>
				<li><a href="http://linkedin.com"><img alt="LinkedIn" src="img/social/linkedin.png"></a></li>
				<li><a href=""><img alt="RSS Feed" src="img/social/rss.png"></a></li>
			</ul>
		</div>
	</div>
</div>
		
<!-- Footer
================================================== -->
<?php include 'includes/footer.php'; ?>

<!-- JAVASCRIPT
================================================== -->
<?php include 'includes/js.php'; ?>
	
</body>
</html>

