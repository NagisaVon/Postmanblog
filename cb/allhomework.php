<?php
  include 'core/init.php';
  if (isset ($_SESSION['user_id'])) {
    //Do something
  } else {
    header ("Location: landing.php");
    exit ();
  }
?>
<?php
  function protect () {
    if (isset ($_GET['subject']) && isset ($_GET['class'])) {
      if ($_GET['subject'] == 1 || $_GET['subject'] == 2) {
        return true;
      }
    }
    return false;
  }

  if (protect () == false) {
    header ('Location: landing.php');
    exit ();
  }
  $subject = $_GET['subject'];
  $class = $_GET['class'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include ('includes/head.php'); ?>
    <title>
      CenterBrain
    </title>
  </head>
  
  <body>
    <div class="app app-header-fixed">
      <?php include ('includes/header.php'); ?>
      <?php include ('includes/aside.php'); ?>
      <div id="content" class="app-content" role="main">
        <div class="bg-light lter wrapper-md" align="center">
          <h1 class="m-n font-thin h3">今天的作业</h1>
        </div>
        <div class="wrapper-md">
          <?php
            $temple = '<div class="panel panel-default"><div class="panel-heading font-bold">';
            $temple_table = '</div><div class="table-responsive"><table class="table table-striped b-t b-light"><thead><tr><th>作业</th><th>备注</th><th>上交</th><th>发布</th></tr></thead><tbody>';
            $all_homework = homework_id_from_subject ($subject);
            $ids = array();
            $id_sum = 0;
            foreach ($all_homework as $value) {
              $homework_data = homework_data ($value, 'id', 'class', 'date', 'type');
              if ($homework_data['date'] > date('Y-m-d')) {
                if (in_array ($class, unserialize ($homework_data['class']))) {
                  array_push ($ids, $homework_data['id']);
                  $id_sum += 1;
                }
              }
            }
            if ($id_sum > 0) {
              $hdata = homework_data ($ids[0], 'teacher');
              $udata = user_data ($hdata['teacher'], 'nickname');
              echo $temple . $h_subject[$subject] . '　发布人　' . $udata['nickname'] . '　<a href><font color="#6C63A8">私信</font></a>' . $temple_table;
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
          ?>
        </div>
      </div>

      <?php include ('includes/footer.php'); ?>
    </div>
    <script src="js/app.min.js">
    </script>
  </body>
</html>
