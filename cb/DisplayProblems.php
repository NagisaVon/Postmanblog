<?php
  if (isset ($_GET['page'])) {
    include 'core/init.php';
    $page = (int) $_GET['page'];
    if (isset ($_GET['all'])) {
      $all_problems = problem_ids ();
    } else {
      $all_problems = problem_id_from_user ($user_data['user_id']);
    }
    $all_problems = array_reverse ($all_problems);
    $problem_num = count ($all_problems);
    $page_num = 10;
    $min = ($page - 1) * $page_num;
    $max = $page * $page_num;
    if ($problem_num >= $min) {
      ?>
      <ul class="list-group list-group-lg no-radius m-b-none m-t-n-xxs">
      <?php
      $to = ($max < $problem_num) ? $max : $problem_num;
      for ($i = $min; $i < $to; $i++) {
        $problem_data = problem_data ($all_problems[$i], 'id', 'user', 'name', 'content', 'subject', 'datetime');
        $id = $problem_data['id'];
        ?>
        <li class="list-group-item clearfix b-l-3x b-l-info">
          <div class="pull-right text-sm text-muted">
            <span class="hidden-xs"><?php echo $problem_data['datetime']; ?></span>
            <i class="fa fa-paperclip m-l-sm"></i>
          </div>
          <div class="clear">
            <div><a class="text-md" href="problem.php?id=<?php echo $id; ?>"><?php echo $problem_data['name']; ?></a><span class="label bg-light m-l-sm "><?php echo $h_subject[$problem_data['subject']]; ?></span></div>
            <div class="text-ellipsis m-t-xs"><?php echo $problem_data['content']; ?></div>
          </div>
        </li>
      <?php } ?>
      </ul>
    <?php
    }
  }
?>
