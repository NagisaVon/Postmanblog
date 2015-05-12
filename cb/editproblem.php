<?php
  include 'core/init.php';
  $pid = $_GET['id'];
  $problem_data = problem_data ($pid, 'name', 'user', 'content', 'type', 'subject', 'datetime');
  if (isset ($_SESSION['user_id']) && $user_data['user_id'] == $problem_data['user']) {
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
      url:'process_editproblem.php',
      data:{"name":problem_name.value,"subject":subject.value,"content":problem_content.value,"from":"<?php echo $pid; ?>"},
      success:function(data){
        alertify.success(<?php echo $_GET['id']; ?> + "号题目已修改");
        $('#content').load("loadProblem.php?id=<?php echo $pid; ?>");
      }
    });
  }
}
</script>
</head>
<div class="bg-light lter wrapper-md" align="center">
  <h1 class="m-n font-thin h3">编辑题目</h1>
  <div style="height:5px;"></div>
  <a onclick="$('#content').load('loadProblem.php?id=<?php echo $pid; ?>')" class="btn btn-sm btn-default btn-rounded"><i class="fa fa-arrow-left"></i>　返回</a>
</div>
<div class="wrapper-md panel-body">
  <div class="col-sm-10 m-b">
    <input id="problem_name" type="required" placeholder="题目名称" class="form-control rounded" value="<?php echo $problem_data['name']; ?>">
  </div>
  <div class="col-sm-2 m-b">
    <select id="subject" class="form-control">
      <?php
        foreach ($h_subject as $key => $value) {
          echo '<option value="' . $key . '">' . $value . '</option>';
        }
      ?>
    </select>
    <script type="text/javascript">
      subject.value = <?php echo $problem_data['subject']; ?>;
    </script>
  </div>
  <div class="col-sm-12 m-b">
    <textarea id="problem_content" type="required" placeholder="来道题费费他们的脑细胞！" style='border: 1px solid #94BBE2;width:100%;' rows="20" onpropertychange='this.style.posHeight=this.scrollHeight' onfocus='textarea.style.posHeight=this.scrollHeight' required><?php echo $problem_data['content']; ?></textarea>
  </div>
  <div class="col-sm-12" align="right">
    <input type="submit" onclick="release()" value="修改" class="btn btn-lg btn-rounded btn-success">
  </div>
</div>