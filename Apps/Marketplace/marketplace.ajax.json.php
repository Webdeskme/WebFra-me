<?php
header("Content-type: application/json");
include_once("../../testInput.php");
include_once("config.inc.php");


$output = array("result"=>"error");
if(empty($req["f"]))
	$output["msg"] = "Missing parameter";
else if($req["f"] == "updateMarketJson"){
	
	if(!is_writable("../../wd_market.json"))
		$output["msg"] = "Marketplace json file is not writeable";
	else if(!file_put_contents("../../wd_market.json", fopen("http://webdesk.me/www/Pages/wd_market.json", 'r'))){
		$output["msg"] = "Could not download file";
	}
	else{
		$output["result"] = "success";
	}
	
}//updateMarketJson
else
	$output["msg"] = "Invalid function";
	
$output["dev"]["req"] = $req;
echo json_encode($output);
?>