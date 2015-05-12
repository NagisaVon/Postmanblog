<?php
  include 'core/init.php';
  $daily_data = daily_data (date ('Y-m-d'), 'title', 'content');
?>
<div class="bg-light lter wrapper-md" align="center">
  <h1 class="m-n font-thin h3">今天的《每日一段》</h1>
</div>
<div class="wrapper-md">
  <h2 class="m-d"><?php echo tf ($daily_data['title']); ?></h2>
  <font size="4.5"><?php echo tf ($daily_data['content']); ?></font>
  <div class="col-sm-12" align="right">
    <a onclick="loadbbar();$('#content').load('daily_all.php');window.location.href='index.php#daily_all';">
      <font color="#6C63A8">
        最近的每日一段
      </font>
    </a>
  </div>
</div>
<div class="wrapper"></div>