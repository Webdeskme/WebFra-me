<?php 
session_start();
header("X-Robots-Tag: noIndex, nofollow", true);
if(!isset($_POST['lastPage'])){
include("testInput.php");
$user = test_input($_GET["id"]);
$pass = test_input($_GET["val"]);
$var = file_get_contents($wd_root . '/User/' . $user . '/Admin/val.txt');
$var = test_input($var);
if(file_exists($wd_root . '/Admin/month.txt')){
    $month = file_get_contents($wd_root . '/Admin/month.txt');
}
else{
    $month = 'yes';
}
$data = f_dec($user) . ': ' . $_SERVER['REMOTE_ADDR'] . '[' . date("l jS \of F Y h:i:s A") . ']-Home.php<br>'; 
$d = date("F");
if ($pass === $var && file_exists($wd_root . '/User/' . $user . '/Admin/tier.txt')){
    $_SESSION["Login"] = 'YES';
    $_SESSION["user"] = $user;
    $_SESSION["tier"] = test_input(file_get_contents($wd_root . '/User/' . $_SESSION["user"] . '/Admin/tier.txt'));

$data =  f_dec($_SESSION["user"]) . ': ' . $_SERVER['REMOTE_ADDR'] . '[' . date("l jS \of F Y h:i:s A") . ']' . '<br>'; 
$d = date("F");
if($month == $d){
    file_put_contents($wd_root . '/Admin/LoginLog.txt', $data, FILE_APPEND);
}
else{
    file_put_contents($wd_root . '/Admin/month.txt', $d);
    file_put_contents($wd_root . '/Admin/LoginLog.txt', $data);
    file_put_contents($wd_root . '/Admin/LoginFLog.txt', "");
}
$_SESSION["HUD"] = test_input($_GET["type"]);
$lastPage = file_get_contents($wd_root . '/User/' . $user . '/Admin/lastPage.txt');
if($_SESSION["tier"] === "tA"){
	$ver = test_input(file_get_contents('update.txt'));
	$verN = test_input(file_get_contents('http://webdesk.me/update.txt'));
	if($ver === $verN){
		$alert = "";
	}
	else{
		file_put_contents($wd_root . '/User/' . $user . '/Sec/update.txt', '<a href="update.php">Update to Version: <b>' . $verN . '</b></a>');
		$alert = '&wd_ai=An update is available for your system. Go to alerts to update.';
	}
}
else{
	$alert = "";
}
    header('Location: desktop.php?' . $lastPage . $alert);
}
else {
if($month == $d){
    file_put_contents($wd_root . '/Admin/LoginFLog.txt', $data, FILE_APPEND);
}
else{
    file_put_contents($wd_root . '/Admin/month.txt', $d);
    file_put_contents($wd_root . '/Admin/LoginLog.txt', "");
    file_put_contents($wd_root . '/Admin/LoginFLog.txt', $data);
}
    session_destroy();
    header('Location: index.php');
}
}
else{
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
<title>WebDesk</title>
   <meta http-equiv="content-language" content="ll-cc">
    <meta name="language" content="English"> 
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="keywords" content="WebDesk, Web app, webtop, web desktop">
    <meta name="author" content="WebDesk">
    <meta name="description" content="Welcome to WebDesk.">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" width="device-width">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <meta name="copyright" content="&copy; 2014 WebDesk.me">
    <!--<link rel="icon" type="image/png" href="image/CA.ico">
    <link rel="apple-touch-icon" href="/custom_icon.png">
    <link rel="apple-touch-startup-image" href="/custom_icon.png">-->
    <link rel="apple-touch-icon" href="favicon.ico">
    <link rel="apple-touch-startup-image" href="favicon.ico">
</head>
<body>
<h2>Save this page. <a href="desktop.php">Then go to desktop by clicking here.</a></h2>
</body>
</html>
<?php
}
?>
