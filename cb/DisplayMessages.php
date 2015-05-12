<?php
  if (isset ($_GET['user_id']) && isset ($_GET['page'])) {
    include 'core/init.php';
    $page = (int) $_GET['page'];
    $all_messages = array_reverse(message_id_from_user ($_GET['user_id']));
    $message_num = count ($all_messages);
    $page_num = 20;
    $min = ($page - 1) * $page_num;
    $max = $page * $page_num;
    if ($message_num >= $min) {
      ?>
      <ul class="list-group list-group-lg no-radius m-b-none m-t-n-xxs">
      <?php
      $to = ($max < $message_num) ? $max : $message_num;
      for ($i = $min; $i < $to; $i++) {
        $message_data = message_data ($all_messages[$i], 'id', 'content', 'link', 'datetime', 'state');
        if ($message_data['state'] == 0) {
        	$state = "未读";
        } else {
        	$state = "已读";
        }
        $GLOBALS['con']->query ("UPDATE message SET state='1' WHERE id='" . $message_data['id'] . "'");
        ?>
        <li class="list-group-item clearfix b-l-3x b-l-info">
          <div class="pull-right text-sm text-muted">
            <span class="hidden-xs"><?php echo $message_data['datetime']; ?></span>
            <i class="fa fa-paperclip m-l-sm"></i>
          </div>
          <div class="clear">
            <div><a class="text-md" href="<?php echo $message_data['link']; ?>"><?php echo $message_data['content']; ?></a><span class="label bg-light m-l-sm"><?php echo $state; ?></span></div>
          </div>
        </li>
      <?php } ?>
      </ul>
    <?php
    }
  }
?>
