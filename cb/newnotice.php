<!DOCTYPE html>
<meta charset="UTF-8">
<?php
  include 'core/init.php';
  if (isset ($_SESSION['user_id'])) {
    if (!isset($teacher_data) && $teacher_data['type'] != 1 && $teacher_data['type'] != 2) {
      header ('Location: index.php');
      exit ();
    }
  } else {
    header ("Location: landing.php");
    exit ();
  }
?>
<?php
  $all_homework = homework_id_from_teacher ($user_data['user_id']);
  if ($teacher_data['subject'] == 1) {
    $hclass = "array_class_math";
  } else if ($teacher_data['subject'] == 2) {
    $hclass = "array_class_english";
  } else {
    $hclass = "array_class_normal";
  }
?>
<head>
<title>
发布通知 | CenterBrain
</title>
<script type="text/javascript">
  $('#main_body').ready(function(){
    var date = new Date();
    var year=document.getElementById("year");
    var month=document.getElementById("month");
    var day=document.getElementById("day");
    for (var i=2000;i<=2020;i++) {
      var op=new Option(i,i);
      //op.value=i;
      year.options.add(op);
    }
    for (var i=1;i<=12;i++) {
      var op=new Option(i,i);
      //op.value=i;
      month.options.add(op);
    }
    for (var i=1;i<=31;i++) {
      var op=new Option(i,i);
      //op.value=i;
      day.options.add(op);
    }
    year.value = date.getFullYear();
    month.value = date.getMonth() + 1;
    day.value = date.getDate();
  });
  function changeday() {
    var day=document.getElementById("day");
    var day_selected=day.value;
    var mvalue=document.getElementById("month").value;
    var arr1=new Array("4","6","9","11");
    var arr2=new Array("1","3","5","7","8","10","12");
    day.options.length=0;
    for (var i=0;i<arr1.length;i++) {
      if(mvalue==arr1[i]) {
        for (var j=1;j<=30;j++) {
          var op1=new Option(j,j);
          //op1.value=j;
          day.options.add(op1);
        }
      }
    }
    for (var i=0;i<arr2.length;i++) {
      if(mvalue==arr2[i]) {
        for (var j=1;j<=31;j++) {
          var op1=new Option(j,j);
          //op1.value=j;
          day.options.add(op1);
        }
      }
    }
    if(mvalue==2) {
      var yr=document.getElementById("year").value;
      if(yr%4==0&&yr%100!=0||yr%400==0) {
        for (var j=1;j<=29;j++) {
          var op1=new Option(j,j);
          //op1.value=j;
          day.options.add(op1);
        }
      } else {
        for (var j=1;j<=28;j++) {
          var op1=new Option(j,j);
          //op1.value=j;
          day.options.add(op1);
        }
      }
    }
    day.value=day_selected;
  }
  function deleteItem(Ditem) {
    alertify.confirm("<h3>确定删除？</h3><p>你确定要删除该项通知吗？</p>", function (e) {
      if(e) {
        $.ajax({
          type:'POST',
          url:'process_newnotice.php',
          data:"&deleteItem=" + Ditem,
          success:function(){
            $('#content').load("newnotice.php");
            alertify.success("项目已删除");
          }
        });
      }
    });
  }
  function release() {
    if (pcontent.value.trim() == "") {
      alertify.error("请填写内容");
    } else {
      $.ajax({
        type:'POST',
        url:'process_newnotice.php',
        data:"&release=1&content=" + pcontent.value + "&note=" + note.value + "&time=" + time.checked + "&oa=" + oa.checked + "&year=" + year.value + "&month=" + month.value + "&day=" + day.value,
        success:function(){
          $('#content').load("newnotice.php");
          alertify.success("发布成功");
        }
      });
    }
  }
</script>
</head>
<div class="bg-light lter wrapper-md" align="center">
  <h1 class="m-n font-thin h3">发布通知</h1>
</div>
<div class="wrapper-md">
  <div class="panel panel-default">
    <div class="panel-heading font-bold">
      未过期通知列表
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>通知</th>
            <th>备注</th>
            <th>上交</th>
            <th>发布</th>
            <th width="1"></th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach ($all_homework as $value) {
              $homework_data = homework_data ($value, 'id', 'subject', 'class', 'content', 'note', 'date', 'released', 'type');
              if ($homework_data['date'] >= date('Y-m-d')) {
                echo '<tr id="Item_' . $value . '">';
                echo '<td>' . $homework_data['content'] . '</td>';
                echo '<td>' . $homework_data['note'] . '</td>';
                echo '<td>' . get_uday_str ($homework_data['date']) . '</td>';
                echo '<td>' . get_uday_str ($homework_data['released']) . '</td>';
                echo '<td><button onclick="deleteItem(' . $value . ')" class="btn btn-xs btn-default" id="deleteItem" value="' . $value . '"><i class="fa fa-times"></i></button></td></tr>';
              }
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading font-bold">
      发布新通知
    </div>
    <div class="panel-body">
      <div class="col-sm-12">
        <input type="text" id="pcontent" placeholder="通知内容" class="form-control rounded" required>
      </div>
      <div class="form-group">
        <div class="col-sm-1 btn-lg">
          上交：
        </div>
        <div class="col-sm-11">
          <div class="radio">
            <label class="i-checks btn btn-rounded btn-default">
              <input type="radio" id="time" name="time" checked><i></i>
              最近
            </label>
            <label class="i-checks btn-sm">
              <input type="radio" id="oa" name="oa" checked><i></i>
              明天
            </label>
            <label class="i-checks btn-sm">
              <input type="radio" name="oa"><i></i>
              后天
            </label>
            　
            <label class="i-checks btn btn-rounded btn-default">
              <input type="radio" name="time"><i></i>
              准确
            </label>
            <select id="year" onchange="changeday()"></select> 
            <select id="month" onchange="changeday()"></select> 
            <select id="day"></select> 
          </div>
        </div>
      </div>
      <div class="col-sm-12 m-b">
        <textarea id="note" placeholder="备注"  style='border: 1px solid #94BBE2;width:100%;' rows="10" onpropertychange='this.style.posHeight=this.scrollHeight' onfocus='textarea.style.posHeight=this.scrollHeight'></textarea>
      </div>
      <div class="col-sm-12" align="right">
        <input type="submit" onclick="return release()" value="发布" class="btn btn-lg btn-rounded btn-success">
      </div>
    </div>
  </div>
</div>