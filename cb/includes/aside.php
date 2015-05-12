<aside id="aside" class="app-aside hidden-xs bg-dark">
  <div class="aside-wrap">
    <div class="navi-wrap">
      <!-- user -->
      <div class="clearfix hidden-xs text-center hidden-folded" id="aside-user">
        <div class="dropdown wrapper">
          <a onclick="loadbbar();$('#content').load('dashboard.php');window.location.href='index.php#dashboard';">
            <span class="thumb-lg w-auto-folded avatar m-t-sm">
              <?php if (isset ($session_user_id) && file_exists('img/profile/' . $user_data['user_id'] . '.png')) { ?>
                <img src="img/profile/<?php echo $user_data['user_id']; ?>.png" class="img-full" alt="...">
              <?php } else { ?>
                <img src="img/profile/default.jpg" class="img-full" alt="...">
              <?php } ?>
            </span>
          </a>
          <a href="#" data-toggle="dropdown" class="dropdown-toggle hidden-folded">
            <span class="clear">
              <span class="block m-t-sm">
                <strong class="font-bold text-lt" id="aside_nickname">
                  <?php
                    if (isset ($user_data['user_id'])) {
                      echo $user_data['nickname'];
                    } else {
                      echo "游客";
                    }
                  ?>
                </strong>
                <b class="caret">
                </b>
              </span>
              <span class="text-muted text-xs block" id="aside_email">
                <?php
                  if (isset ($user_data['user_id'])) {
                    echo $user_data['email'];
                  } else {
                    echo "游客请登陆";
                  }
                ?>
              </span>
              <span class="text-muted text-xs block">
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
              </span>
            </span>
          </a>
          <!-- dropdown -->
          <ul class="dropdown-menu animated fadeInRight w hidden-folded">
            <?php
              if (isset ($user_data['user_id'])) {
            ?>
            <li class="wrapper b-b m-b-sm bg-info m-t-n-xs">
              <span class="arrow top hidden-folded arrow-info">
              </span>
              <div>
                <p>
                  300mb of 500mb used
                </p>
              </div>
              <div class="progress progress-xs m-b-none dker">
                <div class="progress-bar bg-white" data-toggle="tooltip" data-original-title="50%"
                style="width: 50%">
                </div>
              </div>
            </li>
            <li>
              <a onclick="loadbbar();$('#content').load('changeprofile.php');window.location.href='index.php#changeprofile';">
                修改资料
              </a>
            </li>
            <li>
              <a href="profile_img_upload.php">
                修改头像
              </a>
            </li>
            <li>
              <a href="changepwd.php">
                修改密码
              </a>
            </li>
            <li class="divider">
            </li>
            <li>
              <a href="logout.php">
                退出登录
              </a>
            </li>
            <?php
              } else {
            ?>
            <span class="arrow top hidden-folded arrow-default">
            </span>
            <li>
              <a href="login.php">
                登录
              </a>
            </li>
            <li>
              <a href="register.php">
                注册
              </a>
            </li>
            <?php
              }
            ?>
          </ul>
          <!-- / dropdown -->
        </div>
        <div class="line dk hidden-folded"></div>
      </div>
      <!-- / user -->
      <!-- nav -->
      <nav ui-nav class="navi clearfix">
        <ul class="nav">
          <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
            <span>
              导航栏
            </span>
          </li>
          <!-- Navigation -->
          <li>
            <a onclick="loadbbar();$('#content').load('dashboard.php');window.location.href='index.php#dashboard';">
              <i class="glyphicon  glyphicon-dashboard icon text-info-lter">
              </i>
              <span class="font-bold">
                DashBoard
              </span>
            </a>
          </li>
          <li>
            <a class="auto">      
              <span class="pull-right text-muted">
                <i class="fa fa-fw fa-angle-right text"></i>
                <i class="fa fa-fw fa-angle-down text-active"></i>
              </span>
              <i class="glyphicon glyphicon-list icon text-info"></i>
              <span class="font-bold">作业</span>
            </a>
            <ul class="nav nav-sub dk">
              <li>
                <a onclick="loadbbar();$('#content').load('otherhomework.php');window.location.href='index.php#otherhomework';" class="auto">
                  <span class="font-bold">其他班的作业</span>
                </a>
              </li>
              <li>
                <a href="historyhomework.php" class="auto">
                  <span class="font-bold">以前的作业</span>
                </a>
              </li>
            </ul>
          </li>
          <li>
            <a class="auto">      
              <span class="pull-right text-muted">
                <i class="fa fa-fw fa-angle-right text"></i>
                <i class="fa fa-fw fa-angle-down text-active"></i>
              </span>
              <i class="glyphicon glyphicon-pencil icon text-info"></i>
              <span class="font-bold">发布</span>
            </a>
            <ul class="nav nav-sub dk">
              <?php if (isset ($teacher_data) && ($teacher_data['type'] == 1 || $teacher_data['type'] == 2)) { ?>
              <li>
                <a onclick="loadbbar();$('#content').load('newnotice.php');window.location.href='index.php#newnotice';" class="auto">
                  <span class="font-bold">通知</span>
                </a>
              </li>
              <?php } if (isset ($teacher_data) && $teacher_data['class'] != "") { ?>
              <li>
                <a onclick="loadbbar();$('#content').load('newhomework.php');window.location.href='index.php#newhomework';" class="auto">
                  <span class="font-bold">作业</span>
                </a>
              </li>
              <li>
                <a onclick="loadbbar();$('#content').load('newproblem.php');window.location.href='index.php#newproblem';" class="auto">
                  <span class="font-bold">题目</span>
                </a>
              </li>
              <?php } ?>
              <li>
                <a onclick="loadbbar();$('#content').load('newalbum.php');window.location.href='index.php#newalbum';" class="auto">
                  <span class="font-bold">专辑</span>
                </a>
              </li>
              <li>
                <a onclick="loadbbar();$('#content').load('newarticle.php');window.location.href='index.php#newarticle';" class="auto">
                  <span class="font-bold">作品</span>
                </a>
              </li>
            </ul>
          </li>
          <li>
            <a class="auto">      
              <span class="pull-right text-muted">
                <i class="fa fa-fw fa-angle-right text"></i>
                <i class="fa fa-fw fa-angle-down text-active"></i>
              </span>
              <i class="glyphicon glyphicon-user icon text-info"></i>
              <span class="font-bold">你的</span>
            </a>
            <ul class="nav nav-sub dk">
              <?php if (isset ($teacher_data) && $teacher_data['class'] != "") { ?>
              <li>
                <a onclick="loadbbar();$('#content').load('problemlist.php');window.location.href='index.php#problemlist';">
                  <span class="font-bold">
                    所有题目
                  </span>
                </a>
              </li>
              <?php } ?>
              <li>
                <a onclick="loadbbar();$('#content').load('albumlist.php');window.location.href='index.php#albumlist';">
                  <span class="font-bold">
                    所有专辑
                  </span>
                </a>
              </li>
              <li>
                <a onclick="loadbbar();$('#content').load('articlelist.php');window.location.href='index.php#articlelist';">
                  <span class="font-bold">
                    所有作品
                  </span>
                </a>
              </li>
            </ul>
          </li>
          <li>
            <a class="auto">      
              <span class="pull-right text-muted">
                <i class="fa fa-fw fa-angle-right text"></i>
                <i class="fa fa-fw fa-angle-down text-active"></i>
              </span>
              <i class="glyphicon glyphicon-paperclip icon text-info"></i>
              <span class="font-bold">CenterBr专题</span>
            </a>
            <ul class="nav nav-sub dk">
              <li>
                <a onclick="loadbbar();$('#content').load('daily_p.php');window.location.href='index.php#daily_p';">
                  <span class="font-bold">
                    每日一段
                  </span>
                </a>
              </li>
              <li>
                <a onclick="loadbbar();$('#content').load('topics/week_funny.php');window.location.href='index.php#topics/week_funny';">
                  <span class="font-bold">
                    周搞笑榜
                  </span>
                </a>
              </li>
              <li>
                <a onclick="loadbbar();$('#content').load('topics/geo_blackboard.php');window.location.href='index.php#topics/geo_blackboard';">
                  <span class="font-bold">
                    地理老师的黑板
                  </span>
                </a>
              </li>
            </ul>
          </li>
          <li>
            <a onclick="loadbbar();$('#content').load('messageList.php');window.location.href='index.php#messageList';">
              <b class="badge bg-info pull-right"><div id="unread_message_count"><?php echo count (message_id_from_user_unread ($user_data['user_id'])); ?></div></b>
              <i class="glyphicon glyphicon-envelope icon text-info-lter">
              </i>
              <span class="font-bold">
                未读消息
              </span>
            </a>
          </li>

          <!-- /Navigation -->
          <li class="line dk hidden-folded">
          </li>
          <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
            <span>
              关于你
            </span>
          </li>
          <li>
            <a onclick="loadbbar();$('#content').load('changeprofile.php');window.location.href='index.php#changeprofile';">
              <i class="icon-user icon text-success">
              </i>
              <span>
                个人资料
              </span>
            </a>
          </li>
          <li>
            <a href="changepwd.php">
              <i class="icon-lock icon text-success">
              </i>
              <span>
                修改密码
              </span>
            </a>
          </li>
          <li class="line dk hidden-folded">
          </li>
          <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
            <span>
              关于CenterBrain
            </span>
          </li>
          <li>
            <a onclick="loadbbar();$('#content').load('about.php');window.location.href='index.php#about';">
              <i class="icon-info icon text-primary-lter">
              </i>
              <span>
                关于我们
              </span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- nav -->
    </div>
  </div>
</aside>