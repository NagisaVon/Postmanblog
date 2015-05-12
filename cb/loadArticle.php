<?php
  include 'core/init.php';
  $aid = $_GET['id'];
  $article_data = article_data ($_GET['id'], 'name', 'user', 'content', 'type', 'album', 'datetime');
  $article_user_data = user_data ($article_data['user'], 'nickname');
?>
<div class="bg-light lter wrapper-md" align="center">
  <h3 align="center"><?php echo $article_data['name']; ?><?php if (isset ($user_data) && $user_data['user_id'] == $article_data['user']) { ?>　<a onclick="$('#content').load('editarticle.php?id=<?php echo $aid; ?>');" class="btn btn-sm btn-rounded btn-info">编辑</a> <?php } ?></h3>
  <div align="center">
    作者：<font color="#6C63A8"><a class="btn-sm btn-default btn-rounded" href="<?php echo $GLOBALS['web_url']; ?>/<?php echo $article_data['user']; ?>"><?php echo $article_user_data['nickname']; ?></a></font>
  </div>
</div>
<div class="wrapper-md">
  <font size="4.5"><?php echo tf ($article_data['content']); ?></font>
</div>
<div class="line line-dashed b-b line-lg pull-in"></div><br/>
<script type="text/javascript">
  cur_page = 1;
  user_id = <?php echo $user_data['user_id']; ?>;
  type = 0;
  function refreshList() {
    comment_num = 0;
    $.ajaxSetup({async:false});
    $.get("count_comments.php?aid=<?php echo $aid; ?>",function(data){comment_num=data;});
    page_num.innerHTML = cur_page + " / " + Math.ceil(comment_num / 10);
    if (cur_page > 1) {
      page_prev.disabled = false;
    } else {
      page_prev.disabled = true;
    }
    page_first.disabled = page_prev.disabled;
    if (cur_page < comment_num / 10) {
      page_next.disabled = false;
    } else {
      page_next.disabled = true;
    }
    page_last.disabled = page_next.disabled;
    $('#comments').load("loadComments.php?aid=<?php echo $aid ?>&page=" + cur_page);
  }
  $("#comments").ready(function(){
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
    comment_num = 0;
    $.get("count_comments.php?aid=<?php echo $aid; ?>",function(data){comment_num=data;});
    cur_page = Math.ceil(comment_num / 10);
    refreshList();
  }
  function release_comment() {
  	if (comment_content.value.trim() == "") {
  		alertify.error("评论内容不得为空！");
  	} else {
	  	$.ajax({
	      type:'POST',
	      url:'process_newcomment.php',
	      data:{"comment":comment_content.value,"user":"<?php echo $user_data['user_id']; ?>","article":"<?php echo $aid; ?>"},
	      success:function(data){
          if (data != "") {
            alertify.error(data);
          } else {
            alertify.success("新评论已发布");
            refreshList();
            comment_content.value = "";
          }
	      }
	    });
	  }
  }
  function delete_comment(id) {
  	$.ajax({
      type:'POST',
      url:'process_newcomment.php',
      data:{"delete":id},
      success:function(data){
        alertify.success("该评论已删除");
        refreshList();
        comment_content.value = "";
      }
    });
  }
</script>
<div class="wrapper btn-group pull-right">
  <div id="page_num" class="btn-sm pull-left"></div>
  <button id="page_first" onClick="FirstPage()" class="btn btn-sm btn-bg btn-default"><i class="fa fa-step-backward"></i></button>
  <button id="page_prev" onClick="PrevPage()" class="btn btn-sm btn-bg btn-default"><i class="fa fa-chevron-left"></i></button>
  <button id="page_next" onClick="PrevNext()" class="btn btn-sm btn-bg btn-default"><i class="fa fa-chevron-right"></i></button>
  <button id="page_last" onClick="LastNext()" class="btn btn-sm btn-bg btn-default"><i class="fa fa-step-forward"></i></button>
</div>
<h3>　评论：</h3>
<div id="comments" class="wrapper">
</div>
<div class="wrapper">
	<div class="panel no-border">
		<div class="panel-heading font-bold">
			写评论
		</div>
  	<textarea id="comment_content" placeholder="评论一下吧" class="form-control no-border" rows="5"></textarea>
  	<input class="btn btn-lg btn-info pull-right btn-block" type="submit" onclick="release_comment()" value="发布">
  </div>
</div>
<div class="wrapper-md">
</div>