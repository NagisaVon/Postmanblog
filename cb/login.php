<?php
  include ('core/init.php');
  include ('core/functions/secure.php');

  if (logged_in ()) {
    header ('Location: index.php');
  }
  $active = $exists = $login = true;
  $email = $password = "";
  if (isset($_POST['email']) && isset($_POST['password']))
  {
    $email = strtolower ($_POST['email']);
    $password = $_POST['password'];
    //printf ("User ID: %d<p/>", user_id_from_email ($email));
    if (!user_exists ($email)) {
      $exists = false;
    //} else if (!user_active ($email)) {
    //  $active = false;
    } else {
      $login = login ($email, $password);
      if (!($login === false)) {
        $_SESSION['user_id'] = $login;
        $_SESSION['email'] = $email;
        $_SESSION['nickname'] = nickname_from_email ($email);
        $_SESSION['password'] = $password;
        if (isset ($_POST['remember'])) {
          setcookie ('user_id', $login, time () + 86400 * 90, '/');
          setcookie ('password', encrypt ($password, $encryption_key), time () + 86400 * 90, '/');
        }
        header ('Location:index.php');
        exit ();
      }
      else {
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="zh">
  <!-- head -->
  <?php include 'includes/head.php'; ?>
  <head>
    <title>
      登录 | CenterBrain
    </title>
  </head>
  <!-- /head -->
  
  <body>
    <div class="app app-header-fixed  ">
      <div class="container w-xxl w-auto-xs" ng-controller="SigninFormController"
      ng-init="app.settings.container = false;">
        <a href="index.php" class="navbar-brand block m-t">
          CenterBrain
        </a>
        <div class="m-b-lg">
          <div class="wrapper text-center">
            <strong>
              登录
            </strong>
          </div>
          <form action="login.php" method="post" name="form" class="form-validation">
            <div class="text-danger wrapper text-center" ng-show="authError">
            </div>
            <div class="list-group list-group-sm">
              <div class="list-group-item">
                <input type="email" name="email" placeholder="邮箱" value="<?php echo $email; ?>" class="form-control no-border" ng-model="user.email" required>
              </div>
              <font color="red"><?php if(!$exists) { echo "　·用户不存在"; } ?></font>
              <font color="red"><?php if(!$active) { echo "　·用户未激活"; } ?></font>
              <div class="list-group-item">
                <input type="password" name="password" placeholder="密码" class="form-control no-border" ng-model="user.password" required>
              </div>
              <font color="red"><?php if($login === false) { echo "　·密码错误"; } ?></font>
            </div>
            <div class="checkbox m-b-md m-t-none">
              <label class="i-checks">
                <input type="checkbox" ng-model="agree" name="remember" checked>
                <i></i>
                下次自动登陆（在网吧类公共场所不推荐）
              </label>
            </div>
            <button type="submit" class="btn btn-lg btn-primary btn-block" ng-click="login()" ng-disabled='form.$invalid'-->
              登录
            </button>
            <div class="text-center m-t m-b">
              <a href="forgotpwd.php" ui-sref="access.forgotpwd"><font color="#6C63A8">忘记密码？</font></a>
            </div>
            <div class="line line-dashed">
            </div>
            <p class="text-center">
              <small>
                还没有CenterBrain账号？
              </small>
            </p>
            <a href="register.php" class="btn btn-lg btn-default btn-block">
              注册
            </a>
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
