<?php
  include 'core/init.php';
  $pid = $_GET['id'];
  $problem_data = problem_data ($pid, 'name', 'user', 'content', 'type', 'subject', 'datetime');
  $problem_user_data = user_data ($problem_data['user'], 'nickname');
?>
<div class="bg-light lter wrapper-md" align="center">
  <h3 align="center">题目：<?php echo $problem_data['name']; ?><?php if (isset ($user_data) && $user_data['user_id'] == $problem_data['user']) { ?>　<a onclick="$('#content').load('editproblem.php?id=<?php echo $pid; ?>');" class="btn btn-sm btn-rounded btn-info">编辑</a> <?php } ?></h3>
  <div align="center" class="m-b">
发布时间 ：<?php echo $problem_data['datetime']; ?>
　　出题者 ：<font color="#6C63A8"><a class="btn-sm btn-default btn-rounded" href="<?php echo $GLOBALS['web_url']; ?>/<?php echo $problem_data['user']; ?>"><?php echo $problem_user_data['nickname']; ?></a></font>
　　科目 ：<?php echo $h_subject[$problem_data['subject']]; ?>
  </div>
</div>
<div class="wrapper-md">
  <font size="4.5"><?php echo tf ($problem_data['content']); ?></font>
</div>
