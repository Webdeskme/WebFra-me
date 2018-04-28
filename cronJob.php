<?php
//TestInput
function test_input($data) {
    if (!empty($data)) {
        $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
    }
}
function f_enc($data) {
    if (!empty($data)) {
        $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   $data = str_replace(" ", "", $data);
   $data = preg_replace("/\s+/", "", $data);
   $data = strtolower($data);
   $data = strrev($data);
   $data = str_rot13($data);
   return $data;
    }
}
function f_dec($data) {
    if (!empty($data)) {
        $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   $data = str_replace(" ", "", $data);
   $data = preg_replace("/\s+/", "", $data);
   $data = strtolower($data);
   $data = str_rot13($data);
   $data = strrev($data);
   return $data;
    }
}
function t_enc($data) {
    if (!empty($data)) {
        $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   $data = str_replace(" ", "", $data);
   $data = preg_replace("/\s+/", "", $data);
   $data = strrev($data);
   $data = str_rot13($data);
   $data = base64_encode($data);
   return $data;
    }
}
function t_dec($data) {
    if (!empty($data)) {
        $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   $data = str_replace(" ", "", $data);
   $data = preg_replace("/\s+/", "", $data);
   $data = base64_decode($data);
   $data = str_rot13($data);
   $data = strrev($data);
   return $data;
    }
}
function up_enc($data) {
    if (!empty($data)) {
        $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   $data = str_replace(" ", "", $data);
   $data = preg_replace("/\s+/", "", $data);
   $data = str_rot13($data);
   $data = strrev($data);
   //$data = password_hash($data, PASSWORD_DEFAULT);
   $data = md5($data);
   return $data;
    }
}

//Functions

$wd_path = __DIR__ . '/';
$wd_root = file_get_contents($wd_path . 'path.php');
//$test = __DIR__ . "../../webdesk/";
//$test = "";
//$wd_path = realpath(".") . '/www/html/WebDesk/'; //Change to your WebDesk
//$wd_root = realpath(".") . '/www/webdesk/'; //Change to your Webdesk root
$wd_admin = $wd_root . '/Admin/';
$wd_appr = $wd_root . '/App/';
include $wd_path . 'Plugins/PHPMailer-master/PHPMailerAutoload.php';

//Work
$dir = $wd_path . 'Apps/';
$scan = scandir($dir);
foreach($scan as $entry){
  if(file_exists($dir . $entry . '/cron.php')){
    include $dir . $entry . '/cron.php';
  }
}
$dir = $wd_path . 'MyApps/';
$scan = scandir($dir);
foreach($scan as $entry){
  if(file_exists($dir . $entry . '/cron.php')){
    include $dir . $entry . '/cron.php';
  }
}
exit();
?>
