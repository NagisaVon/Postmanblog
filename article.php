<?php
	// what's this
	if (!isset ($_GET)) {
		header ('Location: index.php');
		exit;
	}
	
	include 'core/init.php';
	
	$article_data = article_data ($_GET['id'], 'name', 'content', 'datetime', 'type', 'user');
	// can't view without login
	if ($article_data['type'] == 1 && !isset ($user_data)) {
		header ('Location: index.php');
		exit;
	}
	// set writer data
	$writer_data = user_data ($article_data['user'], 'username');
	
	if (isset ($_GET['page'])) {
		$page = $_GET['page'];
	} else {
		$page = 1;
	}
	define('VISIBLE_COUNT', 7); // define a constant VISIBLE_COUNT, means how many posts can show in one page.
?>

<?php // handle new comment
	if (isset ($_POST['submit'])) {
		$message = "";
		if (!isset ($_POST['nickname'])) {
			$message .= "Please choose a nickname for you :)<br/>";
		} if (isset ($_POST['comment_content']) && trim ($_POST['comment_content']) == "") {
			$message .= "You nickname can't be empty.<br/>";
		} if (!isset ($_POST['comment_content']) || (isset ($_POST['comment_content']) && trim ($_POST['comment_content']) == "")) {
			$message .= "You comment can't be empty.<br/>";
		}
		if ($message == "") {
			$comment_data = array(
				'name'     => $_POST['nickname'],
				'content'  => $_POST['comment_content'],
				'datetime' => date ('Y-m-d H:i:s'),
				'type'     => $_POST['type'],
				'ip'       => $_SERVER["REMOTE_ADDR"], // get user's IP
				'article'  => $_GET['id']);
			new_comment ($comment_data);
			echo '<script type="text/javascript">document.getElementById("comments").scrollIntoView();</script>';
			unset ($_POST);
		}
	}
?>

<!DOCTYPE html>

<head>
	<?php include 'includes/head.php'; ?>
	<?php echo "<title>" . $article_data['name'] . " | Postman's Blog . </title> " ; ?>
</head>

<body class="blog single">

<!-- HEADER
================================================== -->
<?php include 'includes/header.php'; ?>

<!--big container include article , comment except footer-->
<div class="container_12">

<!-- BLOG POST
================================================== -->	
	<div id="article">
		
		<div class="grid_8" >
			<!-- Show meta -->
			<h1 align="center"><?php echo $article_data['name']; ?></h1>
			<div align="center" class="meta">
				<span> Writer: <?php echo $writer_data['username']; ?>  </span>
				<span> Post at: <?php echo $article_data['datetime']; ?> </span>
			</div>
		
			<!-- Show article -->
			<p> <?php echo tf ($article_data['content']); ?> </p>
			<hr>
			
			<!-- Show comments -->
			<h2>Comments:</h2>
			<?php
				$all_comments = array_reverse (comment_ids_from_article ($_GET['id'], isset ($user_data))); // Get all comments that current user can read.
				$comment_count = count ($all_comments);
			?>
			<?php if ($comment_count > 0) { ?>
			Page: <?php // Page buttons
			$page_count = ceil ($comment_count / VISIBLE_COUNT);
			for ($i = 1; $i <= $page_count; $i++) {
				if ($i == $page) {
					echo '<strong>' . $page . '</strong>';
				} else {
					echo '<u><a href="article.php?id=' . $_GET['id'] . '&page=' . $i . '">' . $i . '</a></u>';
				}
				echo '　';
			}
			?>
			<br/><br/>
			<?php 		
				$min = ($page - 1) * VISIBLE_COUNT;
				$max = ($page * VISIBLE_COUNT < $comment_count) ? $page * VISIBLE_COUNT : $comment_count;
				for ($i = $min; $i < $max; $i++) {
					$comment_data = comment_data ($all_comments[$i], 'name', 'content', 'datetime');
					echo $comment_data['name'] . ' Says:<br/>　' . $comment_data['content'] . '<br/>At: ' . $comment_data['datetime'] . '<br/><br/>';
				}
			?>
				
			Page: <?php // Page buttons
				for ($i = 1; $i <= $page_count; $i++) {
					if ($i == $page) {
						echo '<strong>' . $page . '</strong>';
					} else {
						echo '<u><a href="article.php?id=' . $_GET['id'] . '&page=' . $i . '">' . $i . '</a></u>';
					}
					echo '　';
				}
			?>
			
			<?php } else { ?>
				None right now :(
			<?php } ?>
			<hr>


			<!-- Comment form -->
			<div id="comment-form">
				<h3>Write a comment</h3>

				<form action="article.php?id=<?php echo $_GET['id']; ?>&page=1" class="contact-form" method="post">
					<label><span>Your Name :</span></label> 
					<input id="name" name="nickname" placeholder="Your Nickname" type="text" value="<?php if (isset ($_POST['nickname'])) { echo $_POST['nickname']; } ?>" required>
					
					<label><span>Message :</span></label> 
					<textarea id="message" name="comment_content" placeholder="Write something" style='border: 1px solid #94BBE2;width:90%;' rows="10" onpropertychange='this.style.posHeight=this.scrollHeight' onfocus='textarea.style.posHeight=this.scrollHeight'><?php if (isset ($_POST['comment_content'])) { echo $_POST['comment_content']; } ?></textarea>

					<div class="clear"></div>
					<select name="type">
						<option value="0">Public</option>
						<option value="1">Private</option>
					</select>
					<input class="button" type="submit"	name="submit" value="Send">
					
				</form>
				<?php
					if (isset ($message) && $message != "") {
					echo '<font color="red">Error Messages:<br/>' . $message . '</font>'; // echo all error messages if the login process was unsuccessful
					}
				?>

			</div>

		</div> <!--for grid-->
	
	</div> <!-- for artical -->

<!-- SIDEBAR
================================================== -->		
<?php include 'includes/sidebar.php'; ?>

</div> <!--for container-->

<!-- FOOTER
================================================== -->
<?php include 'includes/footer.php'; ?>

</body>
</html>
