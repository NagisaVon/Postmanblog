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
<title>
你的专辑 | CenterBrain
</title>
<script type="text/javascript">
  cur_page = 1;
  user_id = <?php echo $user_data['user_id']; ?>;
  type = 0;
  function refreshList() {
    album_num = 0;
    $.ajaxSetup({async:false});
    $.get("count_albums.php?user_id="+user_id+"&type="+type,function(data){album_num=data;});
    page_num.innerHTML = cur_page + " / " + Math.ceil(album_num / 10);
    if (cur_page > 1) {
      page_prev.disabled = false;
    } else {
      page_prev.disabled = true;
    }
    page_first.disabled = page_prev.disabled;
    if (cur_page < album_num / 10) {
      page_next.disabled = false;
    } else {
      page_next.disabled = true;
    }
    page_last.disabled = page_next.disabled;
    $('#album_List').load("DisplayAlbums.php?&user_id=" + user_id + "&type=" + type + "&page=" + cur_page);
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
    album_num = 0;
    $.get("count_albums.php?user_id="+user_id+"&type="+type,function(data){album_num=data;});
    cur_page = Math.ceil(album_num / 10);
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
      <div class="btn-group dropdown">
        <button class="btn btn-default btn-sm btn-bg dropdown-toggle" data-toggle="dropdown">
          <span class="dropdown-label" id="type_name">所有</span>
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu text-left text-sm">
          <li><a onclick="show('all');type_name.innerHTML='所有';">所有</a></li>
          <li><a onclick="show(0);type_name.innerHTML='公开';">公开</a></li>
          <li><a onclick="show(1);type_name.innerHTML='仅教师';">仅教师</a></li>
          <li><a onclick="show(2);type_name.innerHTML='仅好友';">仅好友</a></li>
          <li><a onclick="show(3);type_name.innerHTML='私密';">私密</a></li>
        </ul>
      </div>
      <div class="btn-group">
        <a class="btn btn-sm btn-bg btn-default" onclick="loadbbar();$('#content').load('newalbum.php');window.location.href='index.php#newalbum';"><i class="fa fa-plus"></i></a>
      </div>
    </div>
  </div>
  <div id="album_List">
    <div class="butterbar active"><span class="bar"></span></div>
    <div class="wrapper-md" align="center"><h3>加载中......</h3></div>
  </div>
</div>