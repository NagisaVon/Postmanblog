<?php
  include 'core/init.php';
  if (isset ($_SESSION['user_id'])) {
    $ids = album_id_from_user ($user_data['user_id']);
    //Do something
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
    alertify.error('作品标题不得为空');
  } else if (article_content.value.trim() == "") {
    alertify.error('作品内容不得为空');
  } else {
    album_success = true;
    a_name = album.value;
    if (new_album.checked) {
      if (album_name.value.trim() == "") {
        alertify.error('专辑名不得为空');
        album_success = false;
      } else {
        $.ajax({
          async : false,
          type:'POST',
          url:'process_newalbum.php',
          data:"&release=1&name=" + album_name.value + "&note=这个人很懒，什么介绍也没留下&type=" + type.value + "&user=" + <?php echo $user_data['user_id']; ?>,
          success:function(data){
            if (data != "") {
              alertify.error(data);
              album_success = false;
            } else {
              alertify.success("新专辑《" + album_name.value + "》已发布");
              a_name = album_name.value;
            }
          }
        });
      }
    }
    if (album_success) {
      $.ajax({
        type:'POST',
        url:'process_newarticle.php',
        data:{"release":"1","name":article_name.value,"type":type.value,"album":a_name,"content":article_content.value,"user":"<?php echo $user_data['user_id']; ?>"},
        success:function(data){
          if (data != "") {
            alertify.error(data);
          } else {
            alertify.success("新作品《" + article_name.value + "》已发布");
            window.location.href='index.php#articlelist';
            $('#content').load("articlelist.php");
          }
        }
      });
    }
  }
}
</script>
</head>
<div class="bg-light lter wrapper-md" align="center">
  <h1 class="m-n font-thin h3">新建作品</h1>
</div>
<div class="wrapper-md panel-body">
  <div class="m-b col-sm-10">
    <input id="article_name" type="required" placeholder="作品标题" class="form-control rounded" required>
  </div>
  <div class="m-b col-sm-2">
    <select id="type" class="form-control">
      <option value="0" selected>公开（所有人）</option>
      <option value="1">仅教师们可见</option>
      <option value="2">仅好友们可见</option>
      <option value="3">私密（仅自己可见）</option>
    </select>
  </div>
  <div class="col-sm-12 btn-lg">
    所属专辑（可以现在建立一个新专辑）：
  </div>
  <div class="col-sm-4 m-b">
    <div class="radio">
      <label class="col-sm-4 i-checks btn btn-rounded">
        <input type="radio" name="belongs_to" checked><i></i>
        现有：
      </label>
      <div class="col-sm-8">
        <select id="album" class="form-control">
          <?php
            foreach ($ids as $value) {
              $album_name = album_data ($value, 'name');
              echo '<option value="' . $album_name['name'] . '">' . $album_name['name'] . '</option>';
            }
          ?>
        </select>
      </div>
    </div>
  </div>
  <div class="col-sm-8 m-b">
    <div class="radio">
      <label class="col-sm-3 i-checks btn btn-rounded">
        <input type="radio" name="belongs_to" id="new_album"><i></i>
        新建：
      </label>
      <div class="col-sm-9">
        <input id="album_name" type="required" placeholder="新专辑的名称" class="form-control rounded" required>
      </div>
    </div>
  </div>
  <div class="col-sm-12 m-b">
    <textarea id="article_content" type="required" placeholder="可以写小说，可以发动态，就这么任性！So self willed!" style='border: 1px solid #94BBE2;width:100%;' rows="20" onpropertychange='this.style.posHeight=this.scrollHeight' onfocus='textarea.style.posHeight=this.scrollHeight' required></textarea>
  </div>
  <div class="col-sm-12" align="right">
    <input type="submit" onclick="release()" value="发布" class="btn btn-lg btn-rounded btn-success">
  </div>
</div>