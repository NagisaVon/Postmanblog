<?php


function download_gugu($filename)
{
	$post = array(
        "client_id"=>"10000065", 
        "client_key"=>"403807c51c1b488d9f461aa2001e52ee", 
        );
	$path = "";
	$gugu_url = "http://api.51gugu.com/action.aspx"; 
	$gugu_status="";
	
	$post['service'] = 'gugu.link.get_url';

	foreach($post as $key => $v) {
		$param .= $key."=".$v."&";
	}
	$param .= "path=/".$path."/".$filename;
	$url = $gugu_url."?".$param;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url); 
	//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; zh-CN; rv:1.9.2.13) Gecko/20101203 Firefox/3.6.13");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$return = curl_exec($ch);
	curl_close($ch);
	$content = json_decode($return, true);
    if($content['gugu_status'] == 0)
    {
		if(empty($_SERVER['HTTP_REFERER']))
        {
			//跳转到直链的下载地址
			header("Location: ".$content['url']);
		}else{
			//JS方式跳转到直链下载地址，解决IE6下防盗链的问题
			echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
			echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
			echo "<head>";
			echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
			echo "<title></title>";
			echo "</head>";
			echo "<body>";
			echo "</body>";
			echo "<script language=\"javascript\">";
			echo "function GetJump(url) {";
			echo "if (getIEVersion() > 0) {";
			echo "var tempa = document.createElement(\"a\");";
			echo "tempa.href = url;";
			echo "document.getElementsByTagName(\"body\")[0].appendChild(tempa);";
			echo "tempa.click();";
			echo "} else {";
			echo "window.location.href = url;}}";
			echo "function getIEVersion() {";
			echo "var rv = -1;";
			echo "if (navigator.appName == \"Microsoft Internet Explorer\") {";
			echo "var ua = navigator.userAgent;";
			echo "var re = new RegExp(\"MSIE ([0-9]{1,}[/.0-9]{0,})\");";
			echo "if (re.exec(ua) != null)";
			echo "rv = parseFloat(RegExp.$1);}return rv;}";
			echo "GetJump(\"".$content['url']."\");";
			echo "</script>";
			echo "</html>";
		}
    }else{
		header("Location: "."http://api.51gugu.com/linkerror.html");
	}
}



download_gugu($_GET["path"]);



die;

?>
