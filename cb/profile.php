<?php
  include 'core/init.php';
  if (isset ($_GET['user_id']) === true && empty ($_GET['user_id']) === false) {
    $user_id = (int) $_GET['user_id'];
    if (user_id_exists ($user_id)) {
      $profile_data = get_user_data ($user_id);
      $profile_page = $GLOBALS['web_url'] . '/' . $profile_data['user_id'];
    } else {
      header ('Location: http://centerbrain.cn/404.shtml');
      exit ();
    }
  } else {
    header ('Location: index.php');
    exit (); 
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include ('includes/head.php'); ?>
    <title>
      <?php echo $profile_data['nickname']; ?> | CenterBrain
    </title>
  </head>
  
  <body>
    <div class="app app-header-fixed">
      <?php include ('includes/header.php'); ?>
      <?php include ('includes/aside.php'); ?>

      <div id="content" class="app-content" role="main">
        <div class="app-content-body">
          <div class="bg-light lter wrapper-md" align="center">
            <h1 class="m-n font-thin h3"><?php echo $profile_data['nickname']; ?>的个人主页 <font size="3">beta</font></h1>
          </div>
          <div class="wrapper-md">
            <div class="panel panel-default">
              <div class="panel-heading font-bold">
                <h1 class="m-n font-thin h3">用户ID：<?php echo $profile_data['user_id']; ?></h1>
              </div>
              <div class="panel-body">
                <?php if (file_exists('img/profile/' . $profile_data['user_id'] . '.png')) { ?>
                  <img src="img/profile/<?php echo $profile_data['user_id']; ?>.png">
                <?php } else { ?>
                  <img src="img/profile/default-p.jpg">
                <?php } ?>
                <h3>邮箱：<?php echo $profile_data['email']; ?></h3>
                <h3>昵称：<?php echo $profile_data['nickname']; ?></h3>
                <h3>主页：<a href="<?php echo $profile_page; ?>"><font color="#6C63A8"><?php echo $profile_page; ?></font></a></h3>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php include ('includes/footer.php'); ?>
    </div>
    <script src="js/app.min.js">
    </script>
  </body>
</html>