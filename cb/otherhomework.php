<?php
  include 'core/init.php';
  if (isset ($_SESSION['user_id'])) {
    //Do something
  } else {
    header ("Location: landing.php");
    exit ();
  }
?>
<!DOCTYPE html>
<div class="bg-light lter wrapper-md" align="center">
  <h1 class="m-n font-thin h3">所有班级的作业</h1>
</div>
<div class="wrapper-md">
  <div class="panel panel-default">
    <div class="panel-heading font-bold">
      数学
    </div>
    <?php
      $temple = '<a class="btn btn-lg btn-rounded" href="allhomework.php?subject=1&class=';
      foreach ($a_math as $key => $value) {
        echo $temple . $key . '">' . $value . '班</a>';
      }
    ?>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading font-bold">
      英语
    </div>
    <?php
      $temple = '<a class="btn btn-lg btn-rounded" href="allhomework.php?subject=2&class=';
      foreach ($a_english as $key => $value) {
        echo $temple . $key . '">' . $value . '班</a>';
      }
    ?>
  </div>
</div>
