<?php
session_start();
include("testInput.php");
$user = f_enc(test_input($_POST["user"]));
$pass = up_enc(test_input($_POST["pass"]));
$var = file_get_contents($wd_root . '/User/' . $user . '/Admin/pass.txt');
$var = test_input($var);
$type = test_input($_POST["type"]);
if(file_exists($wd_root . '/Admin/month.txt')){
    $month = file_get_contents($wd_root . '/Admin/month.txt');
}
else{
    $month = 'yes';
}
$data = f_dec($user) . ': ' . $_SERVER['REMOTE_ADDR'] . '[' . date("l jS \of F Y h:i:s A") . ']-login.php<br>'; 
$d = date("F");
if ($pass == $var && file_exists($wd_root . '/User/' . $user . '/Admin/tier.txt')){
    $_SESSION["Login"] = 'YES';
    $_SESSION["user"] = $user;
  $_SESSION["tier"] = test_input(file_get_contents($wd_root . '/User/' . $_SESSION["user"] . '/Admin/tier.txt'));
if(!file_exists($wd_root . '/Admin/')){
    mkdir($wd_root . '/Admin/');
}

if($month == $d){
    file_put_contents($wd_root . '/Admin/LoginLog.txt', $data, FILE_APPEND);
}
else{
    file_put_contents($wd_root . '/Admin/month.txt', $d);
    file_put_contents($wd_root . '/Admin/LoginLog.txt', $data);
    file_put_contents($wd_root . '/Admin/LoginFLog.txt', "");
}
if($type == "Mobile"){
	$_SESSION["HUD"] = "Mobile";
}
elseif($type == "Desktop"){
	$_SESSION["HUD"] = "Desktop";
}
$alert = "";
if($_SESSION["tier"] === "tA"){
	$ver = test_input(file_get_contents('update.txt'));
	$verN = test_input(file_get_contents('http://webdesk.me/update.txt'));
	if($ver === $verN){
		$alert = "";
	}
	else{
		file_put_contents($wd_root . '/User/' . $user . '/Sec/update.txt', '<a href="update.php">Update to Version: <b>' . $verN . '</b></a>');
		$alert = '?wd_ai=An update is available for your system.  Go to alerts to update.';
	}
}
else{
	$alert = "";
}
    header('Location: desktop.php' . $alert);
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
?>
