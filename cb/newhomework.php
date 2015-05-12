<!DOCTYPE html>
<meta charset="UTF-8">
<?php
  include 'core/init.php';
  if (isset ($_SESSION['user_id'])) {
    if ($user_data['id_code'] < 100) {
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
发布作业 | CenterBrain
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
          url:'process_newhomework.php',
          data:"&deleteItem=" + Ditem,
          success:function(){
            $('#content').load("newhomework.php");
            alertify.success("项目已删除");
          }
        });
      }
    });
  }
  function release() {
    var ls =document.getElementsByName('classes[]');
    var classes = new Array()
    var i;
    for(i = 0; i < ls.length; i++) {
      classes.push(ls[i].value);
    }
    if (pcontent.value.trim() == "") {
      alertify.error("请填写内容");
    } else {
      $.ajax({
        type:'POST',
        url:'process_newhomework.php',
        data:{"release":"1","content":pcontent.value,"note":note.value,"classes":classes,"time":time.checked,"oa":oa.checked,"year":year.value,"month":month.value,"day":day.value},
        success:function(){
          $('#content').load("newhomework.php");
          alertify.success("发布成功");
        }
      });
    }
  }
</script>
</head>

<div class="bg-light lter wrapper-md" align="center">
  <h1 class="m-n font-thin h3">发布作业</h1>
</div>
<div class="wrapper-md" id="main_body">
  <div class="panel panel-default">
    <div class="panel-heading font-bold">
      未过期作业列表
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>作业</th>
            <th>备注</th>
            <th>班级</th>
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
                echo '<tr>';
                echo '<td>' . $homework_data['content'] . '</td>';
                echo '<td>' . $homework_data['note'] . '</td>';
                $hd = unserialize($homework_data['class']);
                array_walk ($hd, $hclass);
                echo '<td>' . implode (", ", $hd) . '</td>';
                echo '<td>' . get_uday_str ($homework_data['date']) . '</td>';
                echo '<td>' . get_uday_str ($homework_data['released']) . '</td>';
                echo '<td><button onclick="deleteItem(' . $value . ')" class="btn btn-xs btn-default" value="' . $value . '"><i class="fa fa-times"></i></button></td></tr>';
              }
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading font-bold">
      发布新作业
    </div>
    <div class="panel-body">
      <div class="col-sm-12">
        <input type="text" id="pcontent" placeholder="作业内容" class="form-control rounded" required>
      </div>
      <div class="form-group">
        <div class="col-sm-1 btn-lg">
          上交：
        </div>
        <div class="col-sm-6">
          <div class="radio">
            <label class="i-checks btn btn-rounded btn-default">
              <input type="radio" name="time" id="time" checked><i></i>
              最近
            </label>
            <label class="i-checks btn-sm">
              <input type="radio" name="oa" id="oa" checked><i></i>
              明天
            </label>
            <label class="i-checks btn-sm">
              <input type="radio" name="oa"><i></i>
              后天
            </label>
            　
            <label class="i-checks btn btn-rounded btn-default">
              <input type="radio" name="time" id="oc2"><i></i>
              准确
            </label>
            <select name="year" id="year" onchange="changeday()"></select> 
            <select name="month" id="month" onchange="changeday()"></select> 
            <select name="day" id="day"></select> 
          </div>
        </div>
        <div class="col-sm-1 btn-lg">
          班级：
        </div>
        <div class="col-sm-4">
          <?php
            $a = unserialize ($teacher_data['class']);
            echo '<div class="checkbox">';
            $temple = '<label class="i-checks btn-sm"><input type="checkbox" name="classes[]" checked value="';
            if ($teacher_data['subject'] == 1) {
              foreach ($a as $value) {
                echo $temple . $value . '"><i></i>' . $a_math[$value] . '</label>';
              }
            } else if ($teacher_data['subject'] == 2) {
              foreach ($a as $value) {
                echo $temple . $value . '"><i></i>' . $a_english[$value] . '</label>';
              }
            } else {
              foreach ($a as $value) {
                echo $temple . $value . '"><i></i>' . $a_normal[$value] . '</label>';
              }
            }
            echo '</div>';
          ?>
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