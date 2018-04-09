<?php
session_start();
include("testInput.php");
$wd_extFile = $wd_root . '/User/' . $_SESSION["user"] . '/Ext/';
$type = test_input($_GET['type']);
$app = test_input($_GET['app']);
if(!file_exists($wd_extFile . "ext.json")){
$obj = new stdClass();
}
else{
$obj = file_get_contents($wd_extFile . "ext.json");
$obj = json_decode($obj); 
}
foreach ($_POST as $k=>$v) { 
    $k = test_input($k);
    $v = test_input($v);
  if($v !== "no"){
    $obj->$k = $v;
  }
}  
$myJSON = json_encode($obj);
file_put_contents($wd_extFile . "ext.json", $myJSON);
header('Location: desktop.php?type=' . $type . '&app=' . $app . '&sec=start.php');
?>
