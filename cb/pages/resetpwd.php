<?php
	include ('../core/init.php');
  if (logged_in ()) {
    header ('Location: ../index.php');
  }
	if (isset ($_GET['email']) && isset ($_GET['email_code'])) {
    $passwordOK = $repasswordOK = true;
		$email = trim (sanitize ($_GET['email']));
		$email_code = trim (sanitize ($_GET['email_code']));
    if (check_email_code ($email, $email_code) === false) {
			header ('Location: ../index.php');
      exit ();
		} else if (isset ($_POST['password'])) {
      if (strlen ($_POST['password']) < 6) {
        $passwordOK = false;
      } else if ($_POST['password'] !== $_POST['repassword']) {
        $repasswordOK = false;
      } else {
  			resetpwd ($email, $_POST['password']);
        header ('Location: resetpwd_success.php');
        exit ();
      }
		}
	} else {
		header ('Location: ../index.php');
    exit ();
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include ('../includes/head.php'); ?>
  <link rel="stylesheet" href="../css/app.min.css" type="text/css" />
    <title>
      重设密码 | CenterBrain
    </title>
  </head>
  <body>
    <div class="app app-header-fixed  ">
      <div class="container w-xxl w-auto-xs" ng-init="app.settings.container = false;">
        <a href="../index.php" class="navbar-brand block m-t">
          CenterBrain
        </a>
        <div class="m-b-lg">
          <div class="wrapper text-center">
            <strong>
              重设密码
            </strong>
          </div>
          <form name="form" action="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']; ?>" method="post" class="form-validation">
            <div class="text-danger wrapper text-center" ng-show="authError"></div>
            <div class="list-group list-group-sm">
              <div class="list-group-item">
                <input type="password" placeholder="新密码（最少6位）" name="password" class="form-control no-border" ng-model="user.password" required>
              </div>
              <font color="red"><?php if(!$passwordOK) { echo "　·密码不得最少6位"; } ?></font>
              <div class="list-group-item">
                <input type="password" placeholder="重复输入（与刚才的密码相同）" name="repassword" class="form-control no-border" ng-model="user.password" required>
              </div>
              <font color="red"><?php if(!$repasswordOK) { echo "　·两次输入内容不同"; } ?></font>
            </div>
            <button type="submit" class="btn btn-lg btn-primary btn-block" ng-click="signup()" ng-disabled='form.$invalid'>
              重设
            </button>
          </form>
        </div>
        <div class="text-center" ng-include="'tpl/blocks/page_footer.html'">
          <p>
            <small class="text-muted">
              <?php include ('../includes/copyright.php'); ?>
            </small>
          </p>
        </div>
      </div>
    </div>
    <script src="js/app.min.js">
    </script>
  </body>
</html>