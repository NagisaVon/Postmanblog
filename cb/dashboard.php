<?php
  include 'core/init.php';
  $row = $GLOBALS['con']->query("SELECT user_id FROM users");
  $user_count = $row->num_rows;
  $row = $GLOBALS['con']->query("SELECT user_id FROM users WHERE type='1'");
  $teacher_count = $row->num_rows;
  $row = $GLOBALS['con']->query("SELECT id FROM article");
  $article_count = $row->num_rows;
  $row = $GLOBALS['con']->query("SELECT id FROM problem");
  $problem_count = $row->num_rows;
  $row = $GLOBALS['con']->query("SELECT id FROM homework");
  $homework_count = $row->num_rows;
?>

<div class="hbox hbox-auto-xs hbox-auto-sm">
  <div class="col">
    <div class="bg-light lter wrapper-md">
        <h1 class="m-n font-thin h3 text-black">Dashboard</h1>
        <small class="text-muted">Welcome (back) to CenterBrain!</small>
    </div>
    <div class="wrapper-md">
      <?php
        $temple = '<div class="panel no-border"><div class="panel-heading font-bold">';
        $temple_table = '</div><div class="table-responsive"><table class="table table-striped b-t b-light"><thead><tr><th>作业</th><th>备注</th><th>上交</th><th>发布</th></tr></thead><tbody>';
        foreach ($h_subject as $key => $value) {
          $all_homework = homework_id_from_subject ($key);
          $ids = array();
          $id_sum = 0;
          if ($key == 1) {
            foreach ($all_homework as $key) {
              $homework_data = homework_data ($key, 'id', 'class', 'date', 'type');
              if ($homework_data['date'] > date('Y-m-d')) {
                if (in_array ($user_data['p_math'], unserialize ($homework_data['class']))) {
                  array_push ($ids, $homework_data['id']);
                  $id_sum += 1;
                }
              }
            }
          } else if ($key == 2) {
            foreach ($all_homework as $key) {
              $homework_data = homework_data ($key, 'id', 'class', 'date', 'type');
              if ($homework_data['date'] > date('Y-m-d')) {
                if (in_array ($user_data['p_english'], unserialize ($homework_data['class']))) {
                  array_push ($ids, $homework_data['id']);
                  $id_sum += 1;
                }
              }
            }
          } else if ($key == 20) {
            foreach ($all_homework as $key) {
              $homework_data = homework_data ($key, 'id', 'class', 'date', 'type');
              if ($homework_data['date'] > date('Y-m-d')) {
                if ($user_data['p_normal'] == $homework_data['class']) {
                  array_push ($ids, $homework_data['id']);
                  $id_sum += 1;
                }
              }
            }
          } else {
            foreach ($all_homework as $key) {
              $homework_data = homework_data ($key, 'id', 'class', 'date', 'type');
              if ($homework_data['date'] > date('Y-m-d')) {
                if (in_array ($user_data['p_normal'], unserialize ($homework_data['class']))) {
                  array_push ($ids, $homework_data['id']);
                  $id_sum += 1;
                }
              }
            }
          }
          if ($id_sum > 0) {
            $hdata = homework_data ($ids[0], 'teacher');
            $udata = user_data ($hdata['teacher'], 'user_id', 'nickname');
            echo $temple . '你的' . $value . '作业　发布人：<a href="profile.php?user_id=' . $udata['user_id'] . '">' . $udata['nickname'] . '</a>' . $temple_table;
            foreach ($ids as $key => $value) {
              $homework_data = homework_data ($value, 'id', 'content', 'note', 'date', 'released');
              echo '<tr>';
              echo '<td>' . $homework_data['content'] . '</td>';
              echo '<td>' . $homework_data['note'] . '</td>';
              echo '<td>' . get_uday_str ($homework_data['date']) . '</td>';
              echo '<td>' . get_uday_str ($homework_data['released']) . '</td>';
              echo '</tr>';
            }
            echo '</tbody></table></div></div>';
          }
        }
      ?>
      <div class="row">
        <div class="col-sm-5">
          <div class="row row-sm text-center">
            <div class="col-xs-6">
              <a onclick="loadbbar();$('#content').load('allproblems.php');window.location.href='index.php#allproblems';" class="block panel padder-v item">
                <div class="h1 text-info font-thin h1"><?php echo $problem_count; ?></div>
                <span class="text-muted text-xs">题目数</span>
              </a>
            </div>
            <div class="col-xs-6">
              <a onclick="loadbbar();$('#content').load('allarticles.php');window.location.href='index.php#allarticles';" class="block panel padder-v bg-primary item">
                <span class="text-white font-thin h1 block"><?php echo $article_count; ?></span>
                <span class="text-muted text-xs">文章数</span>
              </a>
            </div>
            <div class="col-xs-6">
              <a onclick="" class="block panel padder-v bg-info item">
                <span class="text-white font-thin h1 block"><?php echo $teacher_count; ?></span>
                <span class="text-muted text-xs">教师数</span>
              </a>
            </div>
            <div class="col-xs-6">
              <a onclick="" class="block panel padder-v item">
                <div class="font-thin h1"><?php echo $user_count; ?></div>
                <span class="text-muted text-xs">用户数</span>
              </a>
            </div>
            <div class="col-xs-12">
              <div class="block panel padder-v item">
                <div class="font-thin h1"><?php echo $homework_count; ?></div>
                <span class="text-muted text-xs">CenterBrain数据库中作业条目数</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-7">
          <div class="panel wrapper">
            <h4 class="font-thin m-t-none m-b text-muted">CenterBrain最新公告</h4>
            <div style="height:246px">
              　　公元2015年4月1日, CB（CenterBrain）的预览版终于正式上线啦！感谢各位支持！CB还在开发期，我们相信我们能把CB推向更广的范围。<p/>
              　　欢迎加入CB！如果你熟悉PHP, MySQL, HTML, CSS, JavaScript中的任意一种技术，你都可以加入CB的技术开放团队。或者，你可以不会写代码，只要你有一技之长，绘画、宣传、演说能力，甚至广大的人脉圈，CB都欢迎你！<p/>
              　　老师们：也欢迎您加入CB计划！您可以在CB上发作业，发思考题等等。将来还会有更多激动人心的功能。<p/>
            </div>
          </div>
        </div>
      </div>
      <!-- / stats -->
      <div class="row">
        <div class="col-md-6">
          <div class="panel no-border">
            <div class="panel-heading wrapper b-b b-light">
              <h4 class="font-thin m-t-none m-b-none text-muted">最新题目</h4>              
            </div>
            <ul class="list-group list-group-lg m-b-none">
              <?php
                $result = $GLOBALS['con']->query ("SELECT * FROM problem ORDER BY id DESC LIMIT 5");
                $result->data_seek(0);
                while ($row = $result->fetch_assoc()) {
                  ?><li class="list-group-item">
                  <span class="pull-right label bg-primary inline m-t-sm"><?php echo $h_subject[$row['subject']]; ?></span>
                  <a href="problem.php?id=<?php echo $row['id']; ?>" class="text-ellipsis"><?php echo $row['name']; ?></a></li><?php
                }
              ?>
            </ul>
            <div class="panel-footer">
              <a onclick="loadbbar();$('#content').load('allproblems.php');window.location.href='index.php#allproblems';" class="btn btn-primary btn-addon btn-sm"><i class="fa fa-list"></i>查看所有题目</a>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="panel no-border">
            <div class="panel-heading wrapper b-b b-light">
              <h4 class="font-thin m-t-none m-b-none text-muted">最新文章</h4>              
            </div>
            <ul class="list-group list-group-lg m-b-none">
              <?php
                $all_articles = array_reverse(article_ids ($user_data['user_id'], $user_data['type']));
                foreach ($all_articles as $key => $value) {
                  $article_data = article_data ($all_articles[$key], 'user', 'name');
                  $writer_data = user_data ($article_data['user'], 'nickname');
                  ?><li class="list-group-item">
                  <span class="pull-right label bg-info inline m-t-sm"><?php echo $writer_data['nickname']; ?></span>
                  <a href="article.php?id=<?php echo $all_articles[$key]; ?>" class="text-ellipsis"><?php echo $article_data['name']; ?></a></li><?php
                  if ($key == 4) {
                    break;
                  }
                }
              ?>
            </ul>
            <div class="panel-footer">
              <a onclick="loadbbar();$('#content').load('allarticles.php');window.location.href='index.php#allarticles';" class="btn btn-info btn-addon btn-sm"><i class="fa fa-list"></i>查看所有文章</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- / main -->
  <!-- right col -->
  <div class="col w-md bg-white-only b-l bg-auto no-border-xs">
    <div class="nav-tabs-alt">
      <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#follow" data-toggle="tab"><i class="glyphicon glyphicon-user text-md text-muted wrapper-sm"></i></a></li>
        <li><a href="#chat" data-toggle="tab"><i class="glyphicon glyphicon-comment text-md text-muted wrapper-sm"></i></a></li>
        <li><a href="#trans" data-toggle="tab"><i class="glyphicon glyphicon-transfer text-md text-muted wrapper-sm"></i></a></li>
      </ul>
    </div>
    <div class="tab-content">
      <div class="tab-pane active" id="follow">
        <div class="wrapper-md">
          <div class="m-b-sm text-md">Your Friends</div>
          This Widget is on developing...
        </div>
      </div>
      <div class="tab-pane" id="chat">
        <div class="wrapper-md">
          <div class="m-b-sm text-md">Chat</div>
          This Widget is on developing...
        </div>
      </div>
      <div class="tab-pane" id="trans">
        <div class="wrapper-md">
          <div class="m-b-sm text-md">Transaction</div>
          This Widget is on developing...
        </div>
      </div>      
    </div>
  </div>
  <!-- / right col -->
</div>