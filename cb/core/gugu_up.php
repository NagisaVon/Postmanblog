<?php
/*
返回类型
Array
(
    [gugu_status] => 0
    [files] => Array
    (
        [0] => Array
        (
            [path] => /upload/b_b_grid(1).gif
            [name] => b_b_grid(1)
            [ext] => .gif
            [size] => 1165
            [url] => http://d1.51gugu.com/11504577/4278364c27d074ee2d439e8de7abe437/607019.gif
        )
    )
)
*/

$post = array(
            "client_id"=>"10000065", 
            "client_key"=>"403807c51c1b488d9f461aa2001e52ee", 
            );

$path = "/upload";//WIPFiles下的目录，当前配置为上传至WIPFiles下的upload目录
$gugu_url = "http://api.51gugu.com/action.aspx"; 

function upload_gugu($file)
{
     global $post, $gugu_url, $path;

     $url = $gugu_url;

    $post["files"] = $file;
    $post["save_path"] = $path;
    $post["service"] = "gugu.link.file_upload";
    var_dump($post);
    //die();
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url); 
    //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; zh-CN; rv:1.9.2.13) Gecko/20101203 Firefox/3.6.13");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    //curl_setopt($ch, CURLOPT_HEADER, 1);

    $return = curl_exec($ch);

    curl_close($ch);

    $content = json_decode($return, true);
    var_dump(file_exists($file));
        var_dump($file);
        var_dump($content);
        var_dump($ch);
    if($content['gugu_status'] == 0)
    {
        unlink($file);
    }

    return $content;
}



if($_FILES)
{
    $name = dirname(__FILE__) . '/upload/' . md5 (date('Y-m-d') . $_FILES['upload_file']['name']);
    if (is_uploaded_file ($_FILES['upload_file']['tmp_name']))
    if (!move_uploaded_file($_FILES['upload_file']['tmp_name'], $name)) {
        die ('Fild');
    }
    $content = upload_gugu($name);
    echo '<a href="'.$content['files'][0]['url'].'" target="_blank">'.$name.'</a>';
    //$result = download_gugu($upload_file_name);
}
?>
<html><head>
<title>上载文件表单</title></head>
<body>
<form enctype="multipart/form-data" action="gugu_up.php" method="post">
请选择文件：<br>
<input name="upload_file" type="file"><br>
<input type="submit" value="上传文件">
</form>
</body>
</html>