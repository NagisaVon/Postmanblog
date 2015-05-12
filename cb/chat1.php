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
<html lang="en" onResize="Resize()">
  <head>
    <?php include ('includes/head.php'); ?>
    <link href="css/style.chat.css" type="text/css" ref="stylesheet" />
    <title>
      CenterBrain
    </title>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#ChatMessages').load("DisplayMessages.php?type=1");
        var ChatMessages = document.getElementById('ChatMessages');
      });
      function sendMessage() {
        var evt = evt?evt:(window.event?window.event:null);
        var user_id = document.getElementById('user_id');
        var to_id = document.getElementById('to_id');
        var type = document.getElementById('type'); 
        var chat = document.getElementById('ChatText');
        var ChatMessages = document.getElementById('ChatMessages');
        alert(evt);
        if (chat.value.trim() != "") {
          $.ajax({
            type:'POST',
            url:'newMessage.php',
            //data:"ChatText=HEHE&user_id=8&to_id=5&type=0",
            data:"&user_id=" + user_id.value + "&type=" + type.value + "&ChatText=" + chat.value,
            success:function(){
              alert("&user_id=" + user_id.value + "&type=" + type.value + "&ChatText=" + chat.value);
              ChatText.value = "";
              $('#ChatMessages').load("DisplayMessages.php?type=1");
            }
          });
        } else {
          alert("不能发送空消息");
        }
      }
      function CheckKey(evt) {
        if (evt.keyCode == 13) {
          sendMessage();
        }
      }

      var ontrack = true;
      
      setInterval(function() {
        $('#ChatMessages').load("DisplayMessages.php?type=1");
        //alert(ChatMessages.scrollTop + ' ' + ChatMessages.scrollHeight + ' ' + ChatMessages.clientHeight);
        if (ChatMessages.scrollTop + ChatMessages.clientHeight < ChatMessages.scrollHeight) {
          ontrack = false;
        } else {
          ontrack = true;
        }
        if (ontrack) {
          ChatMessages.scrollTop = ChatMessages.scrollHeight;
        }
      }, 1000);

      function Resize() {
        //alert (document.body.offsetHeight);
        var ChatMessages = document.getElementById('ChatMessages');
        ChatMessages.style.height = (document.body.offsetHeight - 200) + "px";
      }
    </script>
    <style>
      .divcss5-b{height:100px; float:left;}
      .divcss5-b{ margin-left:10px;overflow-y:scroll; overflow-x:scroll;}
      /* css注释说明：设置第二个盒子与第一个盒子间距为10px，并设置了横纵滚动条样式 */
    </style>
    </head>
  
  <body onLoad="Resize()" onResize="Resize()">
    <input id="user_id" value=<?php echo $user_data['user_id']; ?> hidden>
    <input id="type" value="1" hidden>

    <div class="app app-header-fixed">
      <?php include ('includes/header.php'); ?>
      <?php include ('includes/aside.php'); ?>
      <div class="app-content" role="main">
        <div class="wrapper-md">
          <div id="ChatBig">
            <div id="ChatMessages" style="overflow:auto;">
            </div>
            <div class="wrapper">
              <div class="text-muted">
                新消息：
              </div>
              <div class="col-sm-10">
                <input type="text" class="col-sm-11 form-control" placeholder="按回车发送" id="ChatText" name="ChatText" onKeyUp="CheckKey(event)">
              </div>
              <div class="col-sm-2">
                <input type="submit" class="btn btn-block btn-default" value="发送" onClick="sendMessage()">
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--<?php include ('includes/footer.php'); ?>-->
    </div>
    <script src="js/app.min.js">
    </script>
  </body>
</html>