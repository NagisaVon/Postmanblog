<?php
header('Location:chat1.php');
  include 'core/init.php';
  if (isset ($_SESSION['user_id'])) {
    //Do something
  } else {
    header ("Location: landing.php");
    exit ();
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include ('includes/head.php'); ?>
    <link href="css/style.chat.css" type="text/css" ref="stylesheet" />
    <title>
      CenterBrain
    </title>
    <script type="text/javascript" src="name_form.js"></script>
    <script type="text/javascript">
    	$(document).ready(function(){
      });
      function sendMessage(evt, text) {
        var evt = evt?evt:(window.event?window.event:null);
        var user_id = document.getElementById('user_id');
        var to_id = document.getElementById('to_id');
        var type = document.getElementById('type'); 
        var chat = document.getElementById('ChatText');
        var ChatMessages = document.getElementById('ChatMessages');
        if (evt.keyCode == 13) {
          $.ajax({
            type:'POST',
            url:'newMessage.php',
            //data:"ChatText=HEHE&user_id=8&to_id=5&type=0",
            data:"&user_id=" + user_id.value + "&to_id=" + to_id.value + "&type=" + type.value + "&ChatText=" + chat.value,
            success:function(){
              ChatText.value = "";
            }
          });
        }
      }
      
      setInterval(function() {$('#ChatMessages').load("DisplayMessages.php?type=" + type.value + "&ida=" + user_id.value + "&idb=" + to_id.value);}, 1000);
    </script>
  </head>
  
  <body>
    <input id="user_id" value=<?php echo $user_data['user_id']; ?> hidden>
    <input id="to_id" value="5"hidden>
    <input id="type" value="0" hidden>

    <div class="app app-header-fixed">
      <?php include ('includes/header.php'); ?>
      <?php include ('includes/aside.php'); ?>
      <div class="app-content" role="main">
        <div class="bg-light lter wrapper-md" align="center">
          <h1 class="m-n font-thin h3">Chat</h1>
        </div>
        <div class="wrapper-md">
          <div id="ChatBig">
            <div id="ChatMessages">
            </div>
            <textarea id="ChatText" name="ChatText" onKeyUp="sendMessage(event, this.value)"></textarea>
          </div>
        </div>
      </div>

      <?php include ('includes/footer.php'); ?>
    </div>
    <script src="js/app.min.js">
    </script>
  </body>
</html>