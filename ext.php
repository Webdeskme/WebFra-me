<?php
session_start();
include("testInput.php");
$ext = test_input($_POST["ext"]);
$prog = test_input($_POST["prog"]);
if(!file_exists($wd_extFile . "ext.json")){
$obj = new stdClass();
}
else{
$obj = file_get_contents($wd_extFile . "ext.json");
$obj = json_decode($obj); 
}
$obj->$ext = $prog;
$myJSON = json_encode($obj);
file_put_contents($wd_extFile . "ext.json", $myJSON);
//file_put_contents('../../webdesk/User/' . $_SESSION["user"] . '/Ext/' . $ext . '.txt', $prog);
header('Location: desktop.php#tabs-4');
?>
