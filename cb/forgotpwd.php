<?php
  include 'core/init.php';
  if (logged_in ()) {
    header ('Location: index.php');
  }
  $active = $exists = true;
  $email = "";
  if (isset($_POST['email']))
  {
    $email = trim (strtolower ($_POST['email']));
    if (!user_exists ($email)) {
      $exists = false;
    } else if (!user_active ($email)) {
      $active = false;
    } else {
      $nickname = nickname_from_email ($email);
      $email_code = md5 ($email + microtime ());
      change_email_code ($email, $email_code);
      email ($email, '重设你的CenterBrain账号密码', "Hi, " . $nickname . "<p/>　　点击下面的“重设密码”链接来重设您账号的密码。<p/>   <a href='" . $GLOBALS['web_url'] . "/pages/resetpwd.php?email=" . $email . "&email_code=" . $email_code . "'>重设密码</a><p/>　　——CenterBrain");
      header ('Location: pages/sendemail_forgotpwd.php');
      exit ();
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include ('includes/head.php'); ?>
    <title>
      忘记密码 | CenterBrain
    </title>
  </head>
  
  <body>
    <div class="app app-header-fixed">
      <div class="container w-xl w-auto-xs" ng-init="app.settings.container = false;">
        <a href="index.php" class="navbar-brand block m-t">
          CenterBrain
        </a>
        <div class="m-b-lg">
          <div class="wrapper text-center">
            <strong>
              请输入你的邮箱
            </strong>
          </div>
          <form name="reset" action="forgotpwd.php" method="post" ng-init="isCollapsed=true">
            <div class="list-group list-group-sm">
              <div class="list-group-item">
                <input name="email" type="email" placeholder="邮箱" ng-model="email" class="form-control no-border" required>
              </div>
              <font color="red"><?php if(!$exists) { echo "　·用户不存在"; } ?></font>
              <font color="red"><?php if(!$active) { echo "　·用户未激活"; } ?></font>
            </div>
            <button type="submit" ng-disabled="reset.$invalid" class="btn btn-lg btn-primary btn-block" ng-click="isCollapsed = !isCollapsed">
              发送
            </button>
          </form>
        </div>
        <div class="text-center" ng-include="'tpl/blocks/page_footer.html'">
          <p>
            <small class="text-muted">
              <?php include ('includes/copyright.php'); ?>
            </small>
          </p>
        </div>
      </div>
    </div>
    <script src="js/app.min.js">
    </script>
  </body>
</html>