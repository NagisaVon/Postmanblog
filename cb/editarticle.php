<?php
  include 'core/init.php';
  $aid = $_GET['id'];
  $article_data = article_data ($aid, 'name', 'user', 'content', 'type', 'datetime');
  if (isset ($_SESSION['user_id']) && $user_data['user_id'] == $article_data['user']) {
  } else {
    header ("Location: landing.php");
    exit ();
  }
?>
<!DOCTYPE html>
<head>
<title>
发布新作品 | CenterBrain
</title>
<script type="text/javascript">
function release() {
  if (article_name.value.trim() == "") {
    alertify.error('作品名称不得为空');
  } else if (article_content.value.trim() == "") {
    alertify.error('作品内容不得为空');
  } else {
    $.ajax({
      type:'POST',
      url:'process_editarticle.php',
      data:{"name":article_name.value,"type":type.value,"content":article_content.value,"from":"<?php echo $aid; ?>"},
      success:function(data){
        if (data != "") {
          alertify.error(data);
        } else {
          alertify.success(<?php echo $_GET['id']; ?> + "号作品已修改");
          $('#content').load("loadArticle.php?id=<?php echo $aid; ?>");
        }
      }
    });
  }
}
</script>
</head>
<div class="bg-light lter wrapper-md" align="center">
  <h1 class="m-n font-thin h3">编辑作品</h1>
  <div style="height:5px;"></div>
  <a onclick="$('#content').load('loadArticle.php?id=<?php echo $aid; ?>')" class="btn btn-sm btn-default btn-rounded"><i class="fa fa-arrow-left"></i>　返回</a>
</div>
<div class="wrapper-md panel-body">
  <div class="col-sm-10 m-b">
    <input id="article_name" type="required" placeholder="作品标题" class="form-control rounded" value="<?php echo $article_data['name']; ?>">
  </div>
  <div class="col-sm-2 m-b">
    <select id="type" class="form-control">
      <option value="0" selected>公开（所有人）</option>
      <option value="1">仅教师们可见</option>
      <option value="2">仅好友们可见</option>
      <option value="3">私密（仅自己可见）</option>
    </select>
    <script type="text/javascript">
      type.value = <?php echo $article_data['type']; ?>;
    </script>
  </div>
  <div class="col-sm-12 m-b">
    <textarea id="article_content" type="required" placeholder="可以写小说，可以发动态，就这么任性！So self willed!" style='border: 1px solid #94BBE2;width:100%;' rows="20" onpropertychange='this.style.posHeight=this.scrollHeight' onfocus='textarea.style.posHeight=this.scrollHeight' required><?php echo $article_data['content']; ?></textarea>
  </div>
  <div class="col-sm-12" align="right">
    <input type="submit" onclick="release()" value="修改" class="btn btn-lg btn-rounded btn-success">
  </div>
</div>