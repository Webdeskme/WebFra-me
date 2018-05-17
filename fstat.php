<?php
session_start();
include "testInput.php";
$date = date_create();
$stamp = date_timestamp_get($date);
$data = test_input($_POST["data"]);
$data = "IP: " . $_SERVER['REMOTE_ADDR'] . "<br>" . "Time: " . date("h:i:sa") . " " . date("Y-m-d") . "<br>" . data;
if(file_exists($wd_admin . 'fstat.json')){
  $obj = file_get_contents($wd_admin);
  $obj = json_decode($obj, true);
}
$obj[$stamp]['ip'] = $_SERVER['REMOTE_ADDR'];
$obj[$stamp]['os'] = test_input($_POST['os']);
$obj[$stamp]['mobile'] = test_input($_POST['mobile']);
$obj[$stamp]['cookies'] = test_input($_POST['cookies']);
$obj[$stamp]['screen'] = test_input($_POST['screen']);
$obj[$stamp]['page'] = test_input($_POST['page']);
$obj[$stamp]['year'] = date("Y");
$obj[$stamp]['month'] = date("m");
$obj[$stamp]['day'] = date("d");
$obj[$stamp]['hour'] = date("g");
$obj[$stamp]['min'] = date("i");
$obj[$stamp]['seconds'] = date("s");
$json = json_encode($obj);
file_put_contents($wd_admin . 'fstat.json', $json, FILE_APPEND | LOCK_EX);
if(file_exists($wd_root . '/Admin/month.txt')){
    $month = file_get_contents($wd_root . '/Admin/month.txt');
}
else{
    $month = 'yes';
}
$d = date("F");
if($month == $d){
    file_put_contents($wd_admin . 'fstat.txt', $data, FILE_APPEND | LOCK_EX);
}
else{
    file_put_contents($wd_root . '/Admin/month.txt', $d);
    file_put_contents($wd_admin . 'fstat.txt', $data, LOCK_EX);
}
exit();
?>