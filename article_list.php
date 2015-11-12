<?php
	include 'core/init.php';
	$all_articles = array_reverse (article_ids (isset ($user_data))); // Get all articles that current user can read.
	$article_count = count ($all_articles);
	if (isset ($_GET['page'])) {
		$page = $_GET['page'];
	} else {
		$page = 1;
	}
	define('VISIBLE_COUNT', 10); // define a constant VISIBLE_COUNT, means how many posts can show in one page.
?>

<!DOCTYPE html>
<html>
<head>
	<?php include 'includes/head.php'; ?>
	<title>All Posts | Postman's Blog</title>
</head>

<body class="blog">

<!-- HEADER
================================================== -->
<?php include 'includes/header.php'; ?>

<!--big container include article , comment except footer-->
<div class="container_12">

<div class="article">

<div class="grid_8" >


<!-- Page Buttons
================================================== -->
Page: <?php // Page buttons
			$page_count = ceil($article_count / VISIBLE_COUNT);
			for ($i = 1; $i <= $page_count; $i++) {
				if ($i == $page) {
					echo '<strong>' . $page . '</strong>';
				} else {
					echo '<u><a href="article_list.php?page=' . $i . '">' . $i . '</a></u>';
				}
				echo '　';
			}
		?>

<!-- BLOG POST
================================================== -->
<?php 
	$min = ($page - 1) * VISIBLE_COUNT;
	$max = ($page * VISIBLE_COUNT < $article_count) ? $page * VISIBLE_COUNT : $article_count;
	for ($i = $min; $i < $max; $i++) {
		$article_data = article_data ($all_articles[$i], 'name', 'datetime');
		echo '<h3><a href="article.php?id=' . $all_articles[$i] . '">' . $article_data['name'] . '</a></h4>Post at: ' . $article_data['datetime'] . '<br/><br/>';
		echo '<hr>';
	}
?>

<!-- BLOG POST
================================================== 
			<h1><a href="http://originalthemes.co/published/blog-single.html">Blog Post with Sidebar</a></h1>

			<div class="meta">
				<span class="post_author_intro">by</span> 
				<span class="post_author">Mark McManus</span> 
				<span class="post_date_intro">on</span> 
				<span class="post_date" title="2013-08-05">August 5, 2013</span>
			</div>
			
			<img class="post-image" src="img/blog-post-image.jpg" alt="Example Blog Image">

			<p>We have created this demo version in order to show you the
			structure of the Author Theme. It has some of the components from
			the full version, 2 great samples and documentation. You can also
			find 2 images of a Macbook and an iPad, which you can use in your
			project. We hope you will like your first introduction to the
			Author Theme.</p><a class="blue button read-more" href="http://originalthemes.co/published/blog-single.html">Read
			more...</a>

			<div class="clear"></div>-->

<!-- Page Buttons
================================================== -->
Page: <?php // Page buttons
			for ($i = 1; $i <= $page_count; $i++) {
				if ($i == $page) {
					echo '<strong>' . $page . '</strong>';
				} else {
					echo '<u><a href="article_list.php?page=' . $i . '">' . $i . '</a></u>';
				}
				echo '　';
			}
		?>

</div><!--for grid_8-->
</div><!--for article-->

<!-- SIDEBAR
================================================== -->		
<?php include 'includes/sidebar.php'; ?>


</div><!--for container_12-->

<!-- FOOTER
================================================== -->
<?php include 'includes/footer.php'; ?>

</body>
</html>
