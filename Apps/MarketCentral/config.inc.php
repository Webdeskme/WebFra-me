<?php
class marketcentral{
	
	public $dev_mode = false;
	//public $today = date("Y-m-d H:i:s");
	
}
$wd_marketcentral = new marketcentral();
$db = mysqli_connect("localhost", "marketcentral","BqtcKn1gOJUwLorr","wd_marketcentral");
if(!$db){
	echo "Could not connect to marketcentral database";
	exit;
}

$request = array_merge($_POST,$_GET);
$req = array();
foreach($request as $key => $value){
	$req[$key] = (!is_array($value)) ? test_input($value) : $value;
}
?>