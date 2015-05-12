<?php
	include 'core/init.php';
	if (isset ($_POST['submit3'])) {
    $id_code = sanitize ($_POST['id_code']);
    if (check_id_code ($id_code)) {
      change_user_id_code ($user_data['user_id'], $id_code);
      set_id_code_used ($id_code);
      echo '1';
    } else {
      echo '0';
    }
  }
?>