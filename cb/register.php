<?php
  include 'core/init.php';
  $nickname = $email = $password = "";
  $nickname_empty = $email_empty = $exists = false;
  $passwordOK = $captchaOK = true;

  if (isset ($_POST['submit-user'])) {
    include ('config/class.hash.php');

    $nickname = trim ($_POST['nickname']);
    $email = trim ($_POST['email']);
    $password = $_POST['password'];
    $p_math = $_POST['p_math'];
    $p_english = $_POST['p_english'];
    $p_normal = $_POST['p_normal'];

    if (user_exists ($email)) {
      $exists = true;
    } else if (strlen ($password) < 6) {
      $passwordOK = false;
    } else if ($nickname == "") {
      $nickname_empty = true;
    } else if ($email == "") {
      $email_empty = true;
    } else if ($_POST['captcha'] != $_SESSION['cap_code']) {
      $captchaOK = false;
    } else {
      $register_data = array(
        'nickname'   => $nickname,
        'email'      => strtolower ($email),
        'email_code' => md5 ($email + microtime ()),
        'password'   => $password,
        'p_math'     => $p_math,
        'p_english'  => $p_english,
        'p_normal'   => $p_normal
      );
      register_user ($register_data);

      header ('Location: pages/register_success.php');
      exit ();
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'includes/head.php'; ?>
    <title>
      注册 | CenterBrain
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
              注册看看
            </strong>
          </div>
          <form name="form" action="register.php" method="post" class="form-validation">
            <div class="text-danger wrapper text-center" ng-show="authError"></div>
            <div class="list-group list-group-sm">
              <div class="list-group-item">
                <input type="text" placeholder="昵称" name="nickname" value="<?php echo $nickname; ?>" class="form-control no-border" ng-model="user.name" required>
              </div>
              <font color="red"><?php if($nickname_empty) { echo "　·昵称不得为空"; } ?></font>
              <div class="list-group-item">
                <input type="email" placeholder="邮箱（请填写可用邮箱）" name="email" value="<?php echo $email; ?>" class="form-control no-border" ng-model="user.email" required>
              </div>
              <font color="red"><?php if($email_empty) { echo "　·邮箱不得为空"; } ?></font>
              <font color="red"><?php if($exists) { echo "　·该邮箱已被注册"; } ?></font>
              <div class="list-group-item">
                <input type="password" placeholder="密码（最少6位）" name="password" class="form-control no-border" ng-model="user.password" required>
              </div>
              <font color="red"><?php if(!$passwordOK) { echo "　·密码不得最少6位"; } ?></font>
            </div>
            <div>
              <div class="col-sm-2">
              </div>
              <div class="col-sm-5">
                <input type="text" name="captcha" id="captcha" maxlength="6" class="form-control">
              </div>
              <img src="core/captcha.php"/>
              <div class="col-sm-5">
              </div>
            </div>
            <div class="col-sm-8" align="center">
              <font color="red"><?php if(!$captchaOK) { echo "·验证码错误"; } ?></font>
            </div>
            <div class="line line-dashed b-b line-lg pull-in"></div>
            <div>行政：　<select name="p_normal" class="m-l-n" id="p_normal">
                <?php include 'config/class.normal.php'; ?>
              </select>　数学：　<select name="p_math" class="m-l-n" id="p_math">
                <?php include 'config/class.math.php'; ?>
              </select>　英语：　<select name="p_english" class="m-l-n" id="p_english">
                <?php include 'config/class.english.php'; ?>
              </select>
            </div>
            <div class="line line-dashed b-b line-lg pull-in"></div>
            <div class="checkbox m-b-md m-t-none">
              <label class="i-checks">
                <input type="checkbox" ng-model="agree" required>
                <i></i>
                同意<a href="pages/terms.html" target="_blank"><font color="#6C63A8">CenterBrain公约</font></a>
              </label>
            </div>
            <button name="submit-user" type="submit" class="btn btn-lg btn-primary btn-block" ng-disabled='form.$invalid'>
              注册
            </button>
            <div align="center">
              <a class="btn btn-sm btn-default" href="register_teacher.php"><font color="#6C63A8">我是教师</font></a>
            </div>
            <div class="line line-dashed">
            </div>
            <p class="text-center">
              <small>
                已经有CenterBrain账号？
              </small>
            </p>
            <a href="login.php" ui-sref="access.signin" class="btn btn-lg btn-default btn-block">
              登录
            </a>
          </form>
        </div>
        <div class="text-center" ng-include="'tpl/blocks/page_footer.html'">
          <p>
            <small class="text-muted">
              <?php include 'includes/copyright.php'; ?>
            </small>
          </p>
        </div>
      </div>
    </div>
    <script src="js/app.min.js">
    </script>
  </body>
</html>