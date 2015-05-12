<?php
  include 'core/init.php';
  if (isset ($_SESSION['user_id'])) {
    if ($user_data['id_code'] < 100) {
      header ('Location: index.php');
      exit ();
    }
  } else {
    header ("Location: landing.php");
    exit ();
  }
?>
<?php
  if (isset ($_POST['release'])) {
    $content = $_POST['content'];
    if (isset ($_POST['note'])) {
      $note = $_POST['note'];
    } else {
      $note = "";
    }
    if ($_POST['time'] == 'true') {
      if ($_POST['oa'] == 'true') {
        $date = date ('Y-m-d', mktime (0, 0, 0, date("m")  , date("d") + 1, date("Y")));
      } else {
        $date = date ('Y-m-d', mktime (0, 0, 0, date("m")  , date("d") + 2, date("Y")));
      }
    } else {
      $date = date ('Y-m-d', mktime (0, 0, 0, $_POST['month'], $_POST['day'], $_POST['year']));
    }
    $classes = $_POST['classes'];
    array_walk($classes, "array_to_int");
    $homework_data = array(
      'subject'  => $teacher_data['subject'],
      'class'    => serialize($classes),
      'content'  => $content,
      'note'     => $note,
      'date'     => $date,
      'released' => date ('Y-m-d'),
      'type'     => (isset ($_POST['type'])) ? 1 : 0,
      'usual'    => (isset ($_POST['usual'])) ? 1 : 0,
      'teacher'  => $user_data['user_id']
      );
    new_homework ($homework_data);
  } else if (isset ($_POST['deleteItem'])) {
    del_homework ($_POST['deleteItem']);
  }
?>