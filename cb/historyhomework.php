<?php
  include 'core/init.php';
  if (isset ($_SESSION['user_id'])) {
    if (isset ($_POST['day'])) {
      $year = (int) $_POST['year'];
      $month = (int) $_POST['month'];
      $day = (int) $_POST['day'];
    } else {
      $year = (int) date("Y");
      $month = (int) date("m");
      $day = (int) date("d") - 1;
    }
    $cur_date = date ('Y-m-d', mktime (0, 0, 0, $month, $day, $year));
  } else {
    header ("Location: landing.php");
    exit ();
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include ('includes/head.php'); ?>
    <title>
      CenterBrain
    </title>
    <script type="text/javascript">
      $("#content").ready(function(){
        var date = new Date();
        var year=document.getElementById("year");
        var month=document.getElementById("month");
        var day=document.getElementById("day");
        for (var i=2000;i<=date.getFullYear();i++) {
          var op=new Option(i,i);
          year.options.add(op);
        }
        for (var i=1;i<=12;i++) {
          var op=new Option(i,i);
          month.options.add(op);
        }
        for (var i=1;i<=date.getDate();i++) {
          var op=new Option(i,i);
          day.options.add(op);
        }
        year.value = document.getElementById("year_p").value;
        month.value = document.getElementById("month_p").value;
        day.value = document.getElementById("day_p").value;
      });
      function changeday() {
        var day=document.getElementById("day");
        var day_selected=day.value;
        var mvalue=document.getElementById("month").value;
        var arr1=new Array("4","6","9","11");
        var arr2=new Array("1","3","5","7","8","10","12");
        day.options.length=0;
        for (var i=0;i<arr1.length;i++) {
          if(mvalue==arr1[i]) {
            for (var j=1;j<=30;j++) {
              var op1=new Option(j,j);
              //op1.value=j;
              day.options.add(op1);
            }
          }
        }
        for (var i=0;i<arr2.length;i++) {
          if(mvalue==arr2[i]) {
            for (var j=1;j<=31;j++) {
              var op1=new Option(j,j);
              day.options.add(op1);
            }
          }
        }
        if(mvalue==2) {
          var yr=document.getElementById("year").value;
          if(yr%4==0&&yr%100!=0||yr%400==0) {
            for (var j=1;j<=29;j++) {
              var op1=new Option(j,j);
              day.options.add(op1);
            }
          } else {
            for (var j=1;j<=28;j++) {
              var op1=new Option(j,j);
              day.options.add(op1);
            }
          }
        }
        day.value=day_selected;
      }
    </script>
  </head>
  
  <body>
    <div class="app app-header-fixed">
      <?php include ('includes/header.php'); ?>
      <?php include ('includes/aside.php'); ?>
      <div id="content" class="app-content" role="main">
        <div class="bg-light lter wrapper-md" align="center">
          <h1 class="m-n font-thin h3"><?php echo get_uday_str ($cur_date); ?>的作业</h1>
          <div class="wrapper-sm"></div>
          <input id="year_p" value="<?php echo $year ?>" hidden>
          <input id="month_p" value="<?php echo $month ?>" hidden>
          <input id="day_p" value="<?php echo $day ?>" hidden>
          <form action="historyhomework.php" method="POST">
            <select name="year" id="year" onchange="changeday()"></select>年 
            <select name="month" id="month" onchange="changeday()"></select>月 
            <select name="day" id="day"></select>日 
            <input type="submit" value="查询" name="submit" class="btn btn-info">
          </form>
        </div>
        <div class="wrapper-md">
          <?php
            $temple = '<div class="panel panel-default"><div class="panel-heading font-bold">';
            $temple_table = '</div><div class="table-responsive"><table class="table table-striped b-t b-light"><thead><tr><th>作业</th><th>备注</th><th>上交</th><th>发布</th></tr></thead><tbody>';
            foreach ($h_subject as $key => $value) {
              $all_homework = homework_id_from_subject ($key);
              $ids = array();
              $id_sum = 0;
              if ($key == 1) {
                foreach ($all_homework as $key) {
                  $homework_data = homework_data ($key, 'id', 'class', 'date', 'released', 'type');
                  if ($homework_data['date'] > $cur_date && $homework_data['released'] <= $cur_date) {
                    if (in_array ($user_data['p_math'], unserialize ($homework_data['class']))) {
                      array_push ($ids, $homework_data['id']);
                      $id_sum += 1;
                    }
                  }
                }
              } else if ($key == 2) {
                foreach ($all_homework as $key) {
                  $homework_data = homework_data ($key, 'id', 'class', 'date', 'released', 'type');
                  if ($homework_data['date'] > $cur_date && $homework_data['released'] <= $cur_date) {
                    if (in_array ($user_data['p_english'], unserialize ($homework_data['class']))) {
                      array_push ($ids, $homework_data['id']);
                      $id_sum += 1;
                    }
                  }
                }
              } else if ($key == 20) {
                foreach ($all_homework as $key) {
                  $homework_data = homework_data ($key, 'id', 'class', 'date', 'released', 'type');
                  if ($homework_data['date'] > $cur_date && $homework_data['released'] <= $cur_date) {
                    if ($user_data['p_normal'] == $homework_data['class']) {
                      array_push ($ids, $homework_data['id']);
                      $id_sum += 1;
                    }
                  }
                }
              } else {
                foreach ($all_homework as $key) {
                  $homework_data = homework_data ($key, 'id', 'class', 'date', 'released', 'type');
                  if ($homework_data['date'] > $cur_date && $homework_data['released'] <= $cur_date) {
                    if (in_array ($user_data['p_normal'], unserialize ($homework_data['class']))) {
                      array_push ($ids, $homework_data['id']);
                      $id_sum += 1;
                    }
                  }
                }
              }
              if ($id_sum > 0) {
                $hdata = homework_data ($ids[0], 'teacher');
                $udata = user_data ($hdata['teacher'], 'nickname');
                echo $temple . $value . '　发布人　' . $udata['nickname'] . '　<a href><font color="#6C63A8">私信</font></a>' . $temple_table;
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
        </div>
      </div>

      <?php include ('includes/footer.php'); ?>
    </div>
    <script src="js/app.min.js">
    </script>
  </body>
</html>
