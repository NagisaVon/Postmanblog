<?php
  include 'core/init.php';
  if (isset ($_SESSION['user_id'])) {
  } else {
    header ("Location: landing.php");
    exit ();
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include ('includes/head.php'); ?>
    <title>
      CenterBrain
    </title>
    <script type="text/javascript">
    function getarg(url){
      arg=url.split("#");
      return arg[1];
    }
    function IsExistsFile(filepath)
    {
      var xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      xmlhttp.open("GET",filepath,false);
      xmlhttp.send();
      if(xmlhttp.readyState==4){
        if(xmlhttp.status==200) return true; //url存在
        else if(xmlhttp.status==404) return false; //url不存在
        else return false;//其他状态
      }
      return false;
    }
    $("#content").ready(function(){
      str = getarg(window.location.href) + ".php";
      if (str == "undefined.php" || str == ".php") {
        window.location.href = "index.php#dashboard";
        $('#content').load("dashboard.php");
      } else {
        $('#content').load(str);
      }
    });
    </script>
  </head>
  
  <body>
    <div class="app app-header-fixed">
      <?php include 'includes/header.php'; include 'includes/aside.php'; ?>
      <div id="content" class="app-content" role="main" style="word-wrap:break-word;">
        <div class="butterbar active"><span class="bar"></span></div>
        <div class="wrapper-md" align="center"><h2>加载中......</h2></div>
      </div>
      <!-- Footer -->
      <div class="wrapper-md">
      </div>
      <?php include 'includes/footer.php'; ?>
      <!-- /Footer -->
    </div>
    <script src="js/app.min.js">
    </script>
  </body>
</html>
