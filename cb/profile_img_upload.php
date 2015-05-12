<?php
  include ('core/init.php');
  protect_D1 ();

  $successed = true;
  $toobig = false;
  $typeOK = true;
  if (!empty ($_FILES['image_file']['name'])) {
    $size = $_FILES["image_file"]["size"];
    $type = $_FILES["image_file"]["type"];

    if ($type != "image/jpeg" && $type != "image/png" &&
               $type != "image/pjpeg" && $type != "image/x-png") {
      $typeOK = false;
    } else {
      $filename = 'img/profile/' . $session_user_id;
      $iWidth = $iHeight = 200;
      $iJpgQuality = 90;
      if ($_FILES) {
        if ($_FILES['image_file']['error']) {
          $successed = false;
        } else if ($_FILES['image_file']['size'] > 2048 * 1024) {
          $toobig = true;
        } else {
          if (is_uploaded_file($_FILES['image_file']['tmp_name'])) {
            move_uploaded_file($_FILES['image_file']['tmp_name'], $filename);
            if (file_exists($filename) && filesize($filename) > 0) {
              $aSize = getimagesize($filename);
              if (!$aSize) {
                @unlink($filename);
                return;
              }
              switch($aSize[2]) {
                case IMAGETYPE_JPEG:
                  $sExt = '.png';
                  $vImg = @imagecreatefromjpeg($filename);
                  break;
                case IMAGETYPE_PNG:
                  $sExt = '.png';
                  $vImg = @imagecreatefrompng($filename);
                  break;
                default:
                  @unlink($filename);
              }
              $_POST['x1'] = (int) ($_POST['x1'] * $_POST['filew'] / $_POST['img_size']);
              $_POST['y1'] = (int) ($_POST['y1'] * $_POST['filew'] / $_POST['img_size']);
              $_POST['w'] = (int) ($_POST['w'] * $_POST['filew'] / $_POST['img_size']);
              $_POST['h'] = (int) ($_POST['h'] * $_POST['filew'] / $_POST['img_size']);
              $vDstImg = @imagecreatetruecolor($iWidth, $iHeight);
              imagecopyresampled($vDstImg, $vImg, 0, 0, $_POST['x1'], (int)$_POST['y1'], $iWidth, $iHeight, (int)$_POST['w'], (int)$_POST['h']);
              $sResultFileName = $filename . $sExt;
              imagejpeg($vDstImg, $sResultFileName, $iJpgQuality);
              @unlink($filename);
              header ('Location: index.php');
            }
          }
        }
      }
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include ('includes/head.php'); ?>
    <title>
      修改头像 | CenterBrain
    </title>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.Jcrop.min.js"></script>
    <script src="js/script.js"></script>
  </head>
  
  <body>
    <div class="app app-header-fixed">
      <div class="container w-auto-xs" ng-init="app.settings.container = false;">
        <a href="index.php" class="navbar-brand block m-t">
          CenterBrain
        </a>
        <div class="m-b-lg">
          <div class="wrapper text-center">
            <strong>
              第一步：请选择图片作为你的头像
            </strong>
          </div>
          <form id="upload_form" enctype="multipart/form-data" method="post" action="profile_img_upload.php" onSubmit="return checkForm()">
            <input type="hidden" id="x1" name="x1" />
            <input type="hidden" id="y1" name="y1" />
            <input type="hidden" id="x2" name="x2" />
            <input type="hidden" id="y2" name="y2" />
            <input type="file" name="image_file" id="image_file" onChange="fileSelectHandler()" class="btn btn-xl btn-block btn-primary">
            <div class="error"></div>
            <div class="wrapper text-center">
              <strong>
                第二步：裁剪你的头像
              </strong>
            </div>
            <div class="info">
              <input type="hidden" id="filesize" name="filesize"/>
              <input type="hidden" id="filetype" name="filetype"/>
              <input type="hidden" id="filedim" name="filedim"/>
              <input type="hidden" id="filew" name="filew"/>
              <input type="hidden" id="w" name="w"/>
              <input type="hidden" id="h" name="h"/>
              <input type="hidden" id="img_size" name="img_size">
            </div>
            <div align="center">
              <input type="submit" value="上传" name="Upload" class="btn btn-lg btn-success"/>
              <input type="reset" value="重置" class="btn btn-lg btn-danger"/>
            </div>
            <img style="width:100%;" name="preview" id="preview"/>
          </form>
        </div>
        <div class="text-center">
          <p>
            <small class="text-muted">
              <?php include ('includes/copyright.php'); ?>
            </small>
          </p>
        </div>
      </div>
    </div>
  </body>
</html>