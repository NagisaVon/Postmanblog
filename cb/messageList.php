<!DOCTYPE html>
<?php
  include 'core/init.php';
  if (isset ($_SESSION['user_id'])) {
  } else {
    header ("Location: landing.php");
    exit ();
  }
?>
<head>
<script type="text/javascript">
  cur_page = 1;
  user_id = <?php echo $user_data['user_id']; ?>;
  type = 0;
  function refreshList() {
    message_num = 0;
    $.ajaxSetup({async:false});
    $.get("count_messages.php?all=1&user_id="+user_id,function(data){message_num=data;});
    page_num.innerHTML = cur_page + " / " + Math.ceil(message_num / 20);
    if (cur_page > 1) {
      page_prev.disabled = false;
    } else {
      page_prev.disabled = true;
    }
    page_first.disabled = page_prev.disabled;
    if (cur_page < message_num / 20) {
      page_next.disabled = false;
    } else {
      page_next.disabled = true;
    }
    page_last.disabled = page_next.disabled;
    $('#message_list').load("DisplayMessages.php?&user_id=" + user_id + "&type=" + type + "&page=" + cur_page);
    refresh_message();
  }
  $("#main_body").ready(function(){
    refreshList();
  });
  function PrevPage() {
    cur_page--;
    refreshList();
  }
  function PrevNext() {
    cur_page++;
    refreshList();
  }
  function FirstPage() {
    cur_page=1;
    refreshList();
  }
  function LastNext() {
    message_num = 0;
    $.get("count_messages.php?all=1&user_id="+user_id,function(data){message_num=data;});
    cur_page = Math.ceil(message_num / 20);
    refreshList();
  }
  function show(show_type) {
    type = show_type;
    refreshList();
  }
</script>
</head>
<div class="app-content-body" id="main_body">
  <div class="wrapper bg-light lter b-b">
    <div class="btn-group pull-right">
      <div id="page_num" class="btn-sm pull-left"></div>
      <button id="page_first" onClick="FirstPage()" class="btn btn-sm btn-bg btn-default"><i class="fa fa-step-backward"></i></button>
      <button id="page_prev" onClick="PrevPage()" class="btn btn-sm btn-bg btn-default"><i class="fa fa-chevron-left"></i></button>
      <button id="page_next" onClick="PrevNext()" class="btn btn-sm btn-bg btn-default"><i class="fa fa-chevron-right"></i></button>
      <button id="page_last" onClick="LastNext()" class="btn btn-sm btn-bg btn-default"><i class="fa fa-step-forward"></i></button>
    </div>
    <div class="btn-toolbar">
    </div>
  </div>
  <div id="message_list">
    <div class="butterbar active"><span class="bar"></span></div>
    <div class="wrapper-md" align="center"><h3>加载中......</h3></div>
  </div>
</div>