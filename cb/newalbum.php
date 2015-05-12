<?php
  include 'core/init.php';
  if (isset ($_SESSION['user_id'])) {
    //Do something
  } else {
    header ("Location: landing.php");
    exit ();
  }
?>
<!DOCTYPE html>
<head>
<title>
发布新专辑 | CenterBrain
</title>
<script type="text/javascript">
function release() {
  if (album_name.value.trim() == "") {
    alertify.error('专辑名不得为空');
  } else {
    $.ajax({
      type:'POST',
      url:'process_newalbum.php',
      data:{"release":"1","name":album_name.value,"type":type.value,"note":note.value,"user":"<?php echo $user_data['user_id']; ?>"},
      success:function(data){
        if (data != "") {
          alertify.error(data);
        } else {
          alertify.success("新专辑《" + album_name.value + "》已发布");
          window.location.href='index.php#albumlist';
          $('#content').load("albumlist.php");
        }
      }
    });
  }
}
</script>
</head>
<div class="bg-light lter wrapper-md" align="center">
  <h1 class="m-n font-thin h3">新建专辑</h1>
</div>
<div class="wrapper-md panel-body">
  <div class="col-sm-10 m-b">
    <input id="album_name" type="text" placeholder="专辑标题" class="form-control rounded" required>
  </div>
  <div class="col-sm-2 m-b">
    <select id="type" class="form-control">
      <option value="0" selected>公开（所有人）</option>
      <option value="1">仅教师们可见</option>
      <option value="2">仅好友们可见</option>
      <option value="3">私密（仅自己可见）</option>
    </select>
  </div>
  <div class="col-sm-12 m-b">
    <textarea id="note" placeholder="为你的专辑写点介绍呗~" style='border: 1px solid #94BBE2;width:100%;' rows="10" onpropertychange='this.style.posHeight=this.scrollHeight' onfocus='textarea.style.posHeight=this.scrollHeight'></textarea>
  </div>
  <div class="col-sm-12" align="right">
    <input type="submit" onclick="release()" value="新建" class="btn btn-lg btn-rounded btn-success">
  </div>
</div>