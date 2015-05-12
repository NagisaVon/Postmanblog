<!DOCTYPE html>
<html>
<head>
<?php include 'includes/head.php'; ?>
</head>
<script type="text/javascript">
  function submit() {
    alertify.success($('#file').val());
    $.ajax({
      type:'POST',
      url:'process_u1pload.php',
      data:"&path=" + file.value,
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
</script>
<body>

<label for="file">Filename:</label>
<input type="file" name="file" id="file" /> 
<br />
<input onclick="submit()" type="submit" value="Submit" />

</body>
</html>