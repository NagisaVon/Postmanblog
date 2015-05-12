<?php include 'core/init.php'; ?>
<div class="bg-light lter wrapper-md" align="center">
  <h1 class="m-n m-d font-thin h3">今天的作业</h1><div style="height:7px;"></div>
  <a href="historyhomework.php" class="btn btn-default btn-sm btn-rounded"><i class="icon-clock"></i> 以前的作业</a>
</div>
<div class="wrapper-md">
  <?php
    $temple = '<div class="panel b-a"><div class="panel-heading font-bold">';
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