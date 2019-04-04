<?php
session_start();
include("testInput.php");
$ext = test_input($_POST["ext"]);
if(empty($ext))
	$ext = test_input($_GET["ext"]);
$prog = test_input($_POST["prog"]);
if(!file_exists($wd_extFile . "ext.json")){
	$obj = new stdClass();
}
else{
	$obj = file_get_contents($wd_extFile . "ext.json");
	$obj = json_decode($obj); 
}

if(!empty($req["f"]) && ($req["f"] == "remove") ){
	unset($obj->$ext);
}
else{
	$obj->$ext = $prog;
}
$myJSON = json_encode($obj);
file_put_contents($wd_extFile . "ext.json", $myJSON);
header('Location: desktop.php#tabs-4');
?>
