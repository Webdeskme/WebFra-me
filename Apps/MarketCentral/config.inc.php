<?php
class marketcentral{
	
	public $dev_mode = false;
	//public $today = date("Y-m-d H:i:s");
	
}
$wd_marketcentral = new marketcentral();

// DON'T PUT THIS INFO HERE. PUT IT IN THE CONFIG DIRECTORY IN THE ROOT PATH
$db_user = "";
$db_pass = "";
$db_host = "";
$db_name = "";

if(file_exists($wd_appr . "Apps/MarketCentral/config.inc.php")){
	
	include_once($wd_appr . "Apps/MarketCentral/config.inc.php");
}

$db = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
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