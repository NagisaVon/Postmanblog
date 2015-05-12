<?php
  include 'core/init.php';
  if (isset ($_SESSION['user_id'])) {
    if (!isset($teacher_data)) {
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
    $homework_data = array(
      'subject'  => 20,
      'class'    => $teacher_data['diclass'],
      'content'  => $content,
      'note'     => $note,
      'date'     => $date,
      'released' => date ('Y-m-d'),
      'teacher'  => $user_data['user_id']
      );
    new_homework ($homework_data);
  } else if (isset ($_POST['deleteItem'])) {
    del_homework ($_POST['deleteItem']);
  }
?>