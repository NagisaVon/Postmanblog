<?php
  if (isset ($_GET['page'])) {
    include 'core/init.php';
    $page = (int) $_GET['page'];
    if (isset ($_GET['all'])) {
      $all_articles = article_ids ($user_data['user_id'], $user_data['type']);
    } else if (isset ($_GET['album'])) {
      $all_articles = article_id_from_album_access ($_GET['album'], $user_data['user_id'], $user_data['type']);
    } else {
      $all_articles = article_id_from_user_access ($user_data['user_id'], $user_data['type']);
    }
    $all_articles = array_reverse ($all_articles);
    $article_num = count ($all_articles);
    $page_num = 10;
    $min = ($page - 1) * $page_num;
    $max = $page * $page_num;
    if ($article_num >= $min) {
      ?>
      <ul class="list-group list-group-lg no-radius m-b-none m-t-n-xxs">
      <?php
      $to = ($max < $article_num) ? $max : $article_num;
      for ($i = $min; $i < $to; $i++) {
        $article_data = article_data ($all_articles[$i], 'id', 'user', 'name', 'content', 'type', 'datetime');
        $id = $article_data['id'];
        $writer_data = user_data ($article_data['user'], 'nickname');
        ?>
        <li class="list-group-item clearfix b-l-3x b-l-info">
          <div class="pull-right text-sm text-muted">
            <span class="hidden-xs"><?php echo $article_data['datetime']; ?></span>
            <i class="fa fa-paperclip m-l-sm"></i>
          </div>
          <div class="clear">
            <div><a class="text-md" href="article.php?id=<?php echo $id; ?>"><?php echo $article_data['name']; ?></a><span class="label bg-light m-l-sm "><?php echo $writer_data['nickname']; ?></span></div>
            <div class="text-ellipsis m-t-xs"><?php echo $article_data['content']; ?></div>
          </div>
        </li>
      <?php } ?>
      </ul>
    <?php
    }
  }
?>
