<?php
header("Content-Type: text/html; charset=UTF-8");
error_reporting(E_ALL);
require_once "include_phpuploader.php";
include '../core/qiniu/autoload.php';
include '../core/database/connect.php';
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

set_time_limit(3600);

$uploader=new PhpUploader();

$uploader->PreProcessRequest();
$mvcfile=$uploader->GetValidatingFile();

if($mvcfile->FileName=="thisisanotvalidfile")
{
	$uploader->WriteValidationError("My custom error : Invalid file name. ");
	exit(200);
}


if( $uploader->SaveDirectory )
{
	if(!$uploader->AllowedFileExtensions)
	{
		$uploader->WriteValidationError("When using SaveDirectory property, you must specify AllowedFileExtensions for security purpose.");
		exit(200);
	}

	$cwd=getcwd();
	chdir( dirname($uploader->_SourceFileName) );
	if( ! is_dir($uploader->SaveDirectory) )
	{
		$uploader->WriteValidationError("Invalid SaveDirectory ! not exists.");
		exit(200);
	}
	chdir( $uploader->SaveDirectory );
	$wd=getcwd();
	chdir($cwd);

	$targetfilepath =  "$wd/" . $mvcfile->FileName;
	if( file_exists ($targetfilepath) )
		unlink($targetfilepath);

	$mvcfile->CopyTo( $targetfilepath );

	$accessKey = '3Tvs4AoHMr6_wYwUZo0FXprNpJ6J3bCuf2iVgGD8';
	$secretKey = 's_FPyS8XtNdAiMD8ROx4IRXLllQCNec75uOztvDV';
	$auth = new Auth($accessKey, $secretKey);
	$token = $auth->uploadToken('centerbrain');
	$uploadMgr = New UploadManager();
	list($ret, $err) = $uploadMgr->putFile($token, null, $targetfilepath);
	$GLOBALS['con']->query ("INSERT INTO files (name, url, class, from_id) VALUES ('" . $mvcfile->FileName . "','7xiaa7.com1.z0.glb.clouddn.com/" . $ret['key'] . "','" . $uploader->FromClass . "','" . $uploader->FromID . "')");
}

$uploader->WriteValidationOK("");
@unlink($targetfilepath);

?>