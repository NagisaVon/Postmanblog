<?php
  include 'core/init.php';
  error_reporting(E_ALL);
  use Qiniu\Auth;
  use Qiniu\Storage\UploadManager;
  $accessKey = '3Tvs4AoHMr6_wYwUZo0FXprNpJ6J3bCuf2iVgGD8';
  $secretKey = 's_FPyS8XtNdAiMD8ROx4IRXLllQCNec75uOztvDV';
  $auth = new Auth($accessKey, $secretKey);
  $token = $auth->uploadToken('centerbrain');
  $uploadMgr = New UploadManager();
  list($ret, $err) = $uploadMgr->putFile($token, null, $_POST['path']);
  header("Content-Type: application/force-download");
  header("Content-Disposition: attachment; filename=a.php");
  readfile('7xiaa7.com1.z0.glb.clouddn.com/' . $ret['key']);
  echo $ret['key'];
?>