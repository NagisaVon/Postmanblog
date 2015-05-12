<header id="header" class="app-header navbar" role="menu">
  <!-- navbar header -->
  <div class="navbar-header bg-dark">
    <button class="pull-right visible-xs dk" ui-toggle="show" target=".navbar-collapse">
      <i class="glyphicon glyphicon-cog">
      </i>
    </button>
    <button class="pull-right visible-xs" ui-toggle="off-screen" target=".app-aside"
    ui-scroll="app">
      <i class="glyphicon glyphicon-align-justify">
      </i>
    </button>
    <!-- brand -->
    <a href="index.php" class="navbar-brand text-lt">
      <img src="img/logo.png">
      <span class="hidden-folded m-l-xs">
        CenterBrain
      </span>
    </a>
    <!-- / brand -->
  </div>
  <!-- / navbar header -->

  <!-- navbar collapse -->
  <div class="collapse pos-rlt navbar-collapse box-shadow bg-white-only">
    <!-- buttons -->
    <div class="nav navbar-nav hidden-xs">
      <a href="#" class="btn no-shadow navbar-btn" ui-toggle="app-aside-folded" target=".app">
        <i class="fa fa-dedent fa-fw text">
        </i>
        <i class="fa fa-indent fa-fw text-active">
        </i>
      </a>
    </div>
    <!-- / buttons -->
    <!-- nabar right -->
    <ul class="nav navbar-nav navbar-right">
      <?php
        if (isset ($user_data['user_id'])) {
      ?>
      <li class="dropdown">
        <a href="#" data-toggle="dropdown" class="dropdown-toggle clear">
          <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
            <?php if (file_exists('img/profile/' . $user_data['user_id'] . '.png')) { ?>
              <img src="img/profile/<?php echo $user_data['user_id']; ?>.png" alt="...">
            <?php } else { ?>
              <img src="img/profile/default.jpg" alt="...">
            <?php } ?>
            <i class="on md b-white bottom">
            </i>
          </span>
          <span id="header_nickname" class="hidden-sm hidden-md">
            <?php echo $user_data['nickname']; ?>
          </span>
          <b class="caret">
          </b>
        </a>
        <!-- dropdown -->
        <ul class="dropdown-menu animated fadeInRight w">
          <li class="wrapper b-b m-b-sm bg-light m-t-n-xs">
            <label id="header_email">
              <?php echo $user_data['email']; ?>
            </label>
            <br/>
            你是：
            <?php
              if (isset ($user_data)) {
                if ($user_data['type'] == 1) {
                  echo $h_subject[$teacher_data['subject']];
                }
                echo $user_type[$user_data['type']];
              } else {
                echo '游客';
              }
            ?>
          </li>
          <li>
            <a onclick="loadbbar();$('#content').load('changeprofile.php');" href="#changeprofile">
              <span>
                个人资料
              </span>
            </a>
          </li>
          <li>
            <a href="changepwd.php">
              修改密码
            </a>
          </li>
          <li>
            <a href="profile_img_upload.php">
              修改头像
            </a>
          </li>
          <li>
            <a onclick="loadbbar();$('#content').load('daily_p.php');" href="#daily_p">
              每日一段
            </a>
          </li>
          <li class="divider">
          </li>
          <li>
            <a href="logout.php">
              退出登录
            </a>
          </li>
        </ul>
        <!-- / dropdown -->
      </li>
      <?php
      } else {
      ?>
      <a href="register.php" class="btn btn-sm btn-default m-t-sm pull-right">注册</a>
      <a href="login.php" class="btn btn-sm btn-default m-t-sm m-r-sm pull-right">登录</a>
      <?php
      }
      ?>
    </ul>
    <!-- / navbar right -->
  </div>
  <!-- / navbar collapse -->
</header>