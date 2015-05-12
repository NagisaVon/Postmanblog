<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="description" content="北京四中初中部的信息交流平台"/>
<meta name="keywords" content="CenterBrain, CW Soft, CWSOFT"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<link rel="shortcut icon" href="favicon.ico">

<link href="css/app.min.css" rel="stylesheet" type="text/css" />
<link href="css/alertify.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/loadingbar.css" rel="stylesheet" type="text/css" />

<script src="js/jquery.min.js"></script>
<script src="js/jquery.alertify.js"></script>
<script src="js/jquery.loadingbar.js"></script>

<script type="text/javascript">
function refresh_message() {
	unread_message_num = 0;
    $.ajaxSetup({async:false});
	$.get("count_messages.php?user_id=<?php echo $user_data['user_id']; ?>",function(data){unread_message_num=data;});
	unread_message_count.innerHTML=unread_message_num;
}
function loadbbar(){
  content.innerHTML='<div class="butterbar active"><span class="bar"></span></div><div class="wrapper-md" align="center"><h2>加载中......</h2></div>';
  aside.className = aside.className.replace('off-screen', '');
  refresh_message();
}
</script>