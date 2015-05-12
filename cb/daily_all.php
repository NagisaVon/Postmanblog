<?php include 'core/init.php'; ?>
<div class="bg-light lter wrapper-md" align="center">
  <h1 class="m-n font-thin h3">最近七天的《每日一段》</h1>
</div>
<?php
  for ($i = 1; $i < 8; $i += 1) {
    $daily_data = daily_data (date ('Y-m-d', mktime (0, 0, 0, date ('m'), date ('d') - $i, date ('Y'))), 'title', 'content', 'date');
    ?>
    <div class="wrapper-md">
      <h5 class="m-d"><?php echo $daily_data['date'] ?></h5>
      <h2 class="m-d"><?php echo tf($daily_data['title']); ?></h2>
      <h4 class="m-d"><?php echo tf($daily_data['content']); ?></h4>
    </div>
    <?php
  }
?>