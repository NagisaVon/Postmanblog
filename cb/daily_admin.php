<?php
  include 'core/init.php';
  if (logged_in ()) {
    if ($user_data['type'] < 2) {
      header ('Location: index.php');
    }
  } else {
    header ('Location: index.php');
  }
?>
<?php
  if (isset ($_POST['submit'])) {
    for ($i = 0; $i < 8; $i += 1) {
      $date = date ('Y-m-d', mktime (0, 0, 0, date ('m'), date ('d') + $i, date ('Y')));
      if (daily_exists ($date)) {
        change_daily ($date, $_POST['title' . $date], $_POST['content' . $date]);
      } else {
        $daily_data = array(
          'title'   => $_POST['title' . $date],
          'content' => $_POST['content' . $date],
          'date'    => $date
          );
        new_daily ($daily_data);
      }
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include ('includes/head.php'); ?>
    <title>
      CenterBrain
    </title>
    <style type="Text/CSS">
    .comments {
     width:100%;
     overflow:auto;
     word-break:break-all;
    }
    </style>
  </head>
  
  <body>
    <div class="app app-header-fixed">
      <?php include ('includes/header.php'); ?>
      <?php include ('includes/aside.php'); ?>
      <form method="POST" action="daily_admin.php">
        <div id="content" class="app-content" role="main">
          <div class="bg-light lter wrapper-md" align="center">
            <h1 class="m-b font-thin h3">《每日一段》管理</h1>
            <input type="submit" value="发布" name="submit" class="btn btn-rounded btn-lg btn-success">
          </div>
          <div class="wrapper-md">
            <?php
              $temple = '<div class="col-sm-6"><div class="panel panel-default"><div class="panel-heading font-bold">';
              for ($i = 0; $i < 8; $i += 1) {
                $date = date ('Y-m-d', mktime (0, 0, 0, date ('m'), date ('d') + $i, date ('Y')));
                if (daily_exists ($date)) {
                  $daily_data = daily_data ($date, 'title', 'content');
                  $title = $daily_data['title'];
                  $content = $daily_data['content'];
                } else {
                  $title = $content = "";
                }
                echo $temple . $date . '</div><div class="panel-body m-b">';
                ?>
                <div class="col-sm-12 m-b">
                  <input type="text" name="title<?php echo $date; ?>" placeholder="标题" class="form-control rounded" value="<?php echo $title; ?>">
                </div>
                <div class="col-sm-12 m-b">
                  <textarea name="content<?php echo $date; ?>" placeholder="内容" class="form-control comments" style="height:expression((this.scrollHeight>150)?'150px':(this.scrollHeight+5)+'px');overflow:auto;"><?php echo $content; ?></textarea>
                </div>
                <?php
                echo '</div></div></div>';
              }
            ?>
          </div>
        </div>
      </form>

      <?php include ('includes/footer.php'); ?>
    </div>
    <script src="js/app.min.js">
    </script>
  </body>
</html>
