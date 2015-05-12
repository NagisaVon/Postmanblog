<?php
  include 'core/init.php';
  if (isset ($_GET['id']) && problem_exists($_GET['id'])) {
  } else {
    header ("Location: index.php");
    exit ();
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include ('includes/head.php'); ?>
    <title>
      CenterBrain
    </title>
    <script type="text/javascript">
    $("content").ready(function(){$("#content").load("loadProblem.php?id=<?php echo $_GET['id'] ?>");});
    </script>
  </head>
  
  <body>
    <div class="app app-header-fixed">
      <?php include 'includes/header.php'; include 'includes/aside.php'; ?>
      <div id="content" class="app-content tesss" role="main" style="word-wrap:break-word;">
        <div class="butterbar active"><span class="bar"></span></div>
        <div class="wrapper-md" align="center"><h2>加载中......</h2></div>
      </div>
      <?php include 'includes/footer.php'; ?>
    </div>
    <script src="js/app.min.js">
    </script>
  </body>
</html>
