<?php
  include 'core/init.php';
  if (isset ($_SESSION['user_id'])) {
  } else {
    header ("Location: landing.php");
    exit ();
  }
?>
<!DOCTYPE html>
<head>
<title>
发布新题目 | CenterBrain
</title>
<script type="text/javascript">
function release() {
  if (problem_name.value.trim() == "") {
    alertify.error('题目名称不得为空');
  } else if (problem_content.value.trim() == "") {
    alertify.error('题目内容不得为空');
  } else {
    $.ajax({
      type:'POST',
      url:'process_newproblem.php',
      data:{"release":"1","name":problem_name.value,"subject":subject.value,"content":problem_content.value,"type":"1","user":"<?php echo $user_data['user_id']; ?>"},
      success:function(data){
        alertify.success("新题目：" + problem_name.value + " 已发布");
        window.location.href='index.php#problemlist';
        $('#content').load("problemlist.php");
      }
    });
  }
}
</script>
</head>
<div class="bg-light lter wrapper-md" align="center">
  <h1 class="m-n font-thin h3">发布题目</h1>
</div>
<div class="wrapper-md panel-body">
  <div class="col-sm-10 m-b">
    <input id="problem_name" type="required" placeholder="题目名称" class="form-control rounded" required>
  </div>
  <div class="col-sm-2 m-b">
    <select id="subject" class="form-control">
      <?php
        foreach ($h_subject as $key => $value) {
          echo '<option value="' . $key . '">' . $value . '</option>';
        }
      ?>
    </select>
  </div>
  <div class="col-sm-12 m-b">
    <textarea id="problem_content" type="required" placeholder="来道题费费他们的脑细胞！" style='border: 1px solid #94BBE2;width:100%;' rows="20" onpropertychange='this.style.posHeight=this.scrollHeight' onfocus='textarea.style.posHeight=this.scrollHeight' required></textarea>
  </div>
  <div class="col-sm-12" align="right">
    <input type="submit" onclick="release()" value="发布" class="btn btn-lg btn-rounded btn-success">
  </div>
</div>