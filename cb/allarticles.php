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
    article_num = 0;
    $.ajaxSetup({async:false});
    $.get("count_articles.php?all=1",function(data){article_num=data;});
    page_num.innerHTML = cur_page + " / " + Math.ceil(article_num / 10);
    if (cur_page > 1) {
      page_prev.disabled = false;
    } else {
      page_prev.disabled = true;
    }
    page_first.disabled = page_prev.disabled;
    if (cur_page < article_num / 10) {
      page_next.disabled = false;
    } else {
      page_next.disabled = true;
    }
    page_last.disabled = page_next.disabled;
    $('#articleList').load("DisplayArticles.php?&all=1&page=" + cur_page);
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
    article_num = 0;
    $.get("count_articles.php?all=1",function(data){article_num=data;});
    cur_page = Math.ceil(article_num / 10);
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
      <div class="btn-group">
        <a class="btn btn-sm btn-bg btn-default" onclick="loadbbar();$('#content').load('newarticle.php');window.location.href='index.php#newarticle';"><i class="fa fa-plus"></i></a>
      </div>
    </div>
  </div>
  <div id="articleList">
    <div class="butterbar active"><span class="bar"></span></div>
    <div class="wrapper-md" align="center"><h3>加载中......</h3></div>
  </div>
</div>
