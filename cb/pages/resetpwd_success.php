<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include ('../includes/head.php'); ?>
  <link rel="stylesheet" href="../css/app.min.css" type="text/css" />
    <title>
      密码已重设 | CenterBrain
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
              密码已重设
            </strong>
          </div>
          <div collapse="isCollapsed" class="m-t">
            <div class="alert alert-success">
              <h3>您的密码已重设，请登陆。</h3>
            </div>
          <a href="../login.php" ui-sref="access.signin" class="btn btn-lg btn-block btn-success">
            登录
          </a>
          </div>
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