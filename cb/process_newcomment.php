<?php
	include 'core/init.php';
	if (isset ($_POST['user']) && isset ($_POST['comment']) && isset ($_POST['article'])) {
		$comment_data = array(
			'comment'  => $_POST['comment'],
			'user'     => $_POST['user'],
			'article'  => $_POST['article'],
			'datetime' => date('Y-m-d H:i:s'));
		$article_data = article_data ($_POST['article'], 'name', 'user');
		if ($article_data['user'] != $user_data['user_id']) {
			send_message ('你的文章 ' . $article_data['name'] . ' 被别人评论', 'article.php?id=' . $_POST['article'], 0, $article_data['user']);
		}
		new_comment ($comment_data);
	} else if (isset ($_POST['delete'])) {
		$comment_data = comment_data ($_POST['delete'], 'comment', 'user', 'article');
		if ($comment_data['user'] != $user_data['user_id']) {
			send_message ('你的评论 ' . $comment_data['comment'] . ' 被删除', 'article.php?id=' . $comment_data['article'], 0, $comment_data['user']);
		}
		del_comment ($_POST['delete']);
	}
?>
