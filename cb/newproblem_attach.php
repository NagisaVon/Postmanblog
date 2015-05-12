<?php
  include 'core/init.php';
  require_once "phpuploader/include_phpuploader.php";
  if (isset ($_SESSION['user_id'])) {
    if (isset ($_GET['id'])) {
    } else {
      exit();
    }
  } else {
    header ('Location: landing.php');
    exit ();
  }
?>
<head>
  <script type="text/javascript">
    function doStart() {
      var uploadobj = document.getElementById('myuploader');
      if (uploadobj.getqueuecount() > 0) {
        uploadobj.startupload();
      } else {
        alert("请选择要上传的文件");
      }
    }
    function finish() {
      window.location.href='index.php#problemlist';
      $('#content').load("problemlist.php");
    }
  </script>
</head>
<div align="center" class="demo">
  <h3>添加附件</h3>
  <P>只允许上传这些类型的文件: <span style="color:red">JPG, PNG, GIF, TXT, ZIP, RAR. DOC, DOCX, PPT, PPTX</span></p>
  <div id="form1">
    <?php
      $uploader=new PhpUploader();
      $uploader->MaxSizeKB=3072;
      $uploader->Name="myuploader";
      $uploader->InsertText="选择文件(可以选择多个文件，最大3M)";
      $uploader->FromID=$_GET['id'];
      $uploader->FromUserID=$user_data['user_id'];
      $uploader->FromClass="problem";
      $uploader->AllowedFileExtensions="*.jpg,*.png,*.gif,*.txt,*.zip,*.rar,*.doc,*.docx,*.ppt,*.pptx"; 
      $uploader->MultipleFilesUpload=true;
      $uploader->ManualStartUpload=true;
      $uploader->SaveDirectory="tmp_upload";
      $uploader->Render();
    ?>
    <br /><br />
    <button id="submitbutton" class="btn btn-default" onclick="doStart()">开始上传</button>
    <br/><br/><br/>
  </div>
  <button class="btn btn-lg btn-default btn-rounded" onclick="finish()">完成</button>
</div>