<?php
  if (isset ($_GET['aid']) && isset ($_GET['page'])) {
    include 'core/init.php';
    $page = (int) $_GET['page'];
    $article_data = article_data ($_GET['aid'], 'user');
    $all_comments = array_reverse (comment_id_from_article ($_GET['aid']));
    $comment_num = count ($all_comments);
    $page_num = 10;
    $min = ($page - 1) * $page_num;
    $max = $page * $page_num;
    $to = ($max < $comment_num) ? $max : $comment_num;
    for ($i = $min; $i < $to; $i++) {
      $comment_data = comment_data ($all_comments[$i], 'comment', 'datetime', 'user');
      ?>
      <a href="<?php echo $GLOBALS['web_url'] . '/' . $comment_data['user']; ?>" class="pull-left thumb-sm avatar">
        <?php if (file_exists('img/profile/' . $comment_data['user'] . '.png')) { ?>
          <img src="img/profile/<?php echo $comment_data['user']; ?>.png">
        <?php } else { ?>
          <img src="img/profile/default-p.jpg">
        <?php } ?>
      </a>
      <div class="m-l-xxl panel b-a">
        <div class="panel-heading pos-rlt">
          <?php if (isset ($user_data) && ($user_data['user_id'] == $comment_data['user'] || $user_data['type'] != 0 || $user_data['user_id'] == $article_data['user'])) { ?>
            <a onclick="delete_comment(<?php echo $all_comments[$i]; ?>);" class="btn btn-default btn-sm pull-right"><font color="red">删除</font></a>
          <?php } ?>
          <span class="arrow left pull-up"></span>
          <?php echo tf ($comment_data['comment']); ?>
          <div class="text-muted"><?php echo $comment_data['datetime']; ?></div>
        </div>
      </div>
    <?php }
    if ($comment_num == 0) {
      echo '<h4>　　暂无 :(</h4>';
    }
  }
?>