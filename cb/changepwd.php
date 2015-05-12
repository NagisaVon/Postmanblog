<?php
  include ('core/init.php');
  protect_D1 ();

  $incorrect = false;
  $passwordOK = true;

  if (isset ($_POST['old_password'])) {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $password = $_SESSION['password'];

    if ($old_password != $password) {
      $incorrect = true;
    } else if (strlen ($new_password) < 6) {
      $passwordOK = false;
    } else {
      $new_password = md5 ($new_password);
      change_password ($session_user_id, $new_password);
      header ('Location: pages/password_changed.php');
      exit ();
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'includes/head.php'; ?>
    <title>
      修改密码 | CenterBrain
    </title>
  </head>
  
  <body>
    <div class="app app-header-fixed  ">
      <div class="container w-xxl w-auto-xs" ng-controller="SignupFormController"
      ng-init="app.settings.container = false;">
        <a href="index.php" class="navbar-brand block m-t">
          CenterBrain
        </a>
        <div class="m-b-lg">
          <div class="wrapper text-center">
            <strong>
              修改密码
            </strong>
          </div>
          <form name="form" action="changepwd.php" method="post" class="form-validation">
            <div class="text-danger wrapper text-center" ng-show="authError"></div>
            <div class="list-group list-group-sm">
              <div class="list-group-item">
                <input type="password" placeholder="原密码" name="old_password" class="form-control no-border" ng-model="user.password" required>
              </div>
              <font color="red"><?php if($incorrect) { echo "　·原密码错误"; } ?></font>
              <div class="list-group-item">
                <input type="password" placeholder="新密码（最少6位）" name="new_password" class="form-control no-border" ng-model="user.password" required>
              </div>
              <font color="red"><?php if(!$passwordOK) { echo "　·新密码不得最少6位"; } ?></font>
            </div>
            <button type="submit" class="btn btn-lg btn-primary btn-block" ng-click="signup()" ng-disabled='form.$invalid'>
              修改
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