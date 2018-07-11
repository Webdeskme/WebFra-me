<?php
header("Content-type: application/json");
include_once("../../testInput.php");
include_once("config.inc.php");


$output = array("result"=>"error");
if(empty($req["f"]))
	$output["msg"] = "Missing parameter";
else if($req["f"] == "updateMarketJson"){
	
	$test_timestamp = 1;
	if(file_exists("wd_marketplace.json")){
		$test_timestamp = filemtime("wd_marketplace.json");
	}
	else{
		file_put_contents("wd_marketplace.json","{}");
	}
	
	if(!is_writable("wd_marketplace.json"))
		$output["msg"] = "Marketplace json file is not writeable";
	else{
		
		if(file_exists("wd_marketplace.json")){	
			$local_marketplace = json_decode(file_get_contents("wd_marketplace.json"),true);
		}
		else
			$local_marketplace = array();
	
		$new_market = $wd_marketplace->get_content($wd_marketplace->get_download_location() . $test_timestamp);
		
		$new_market = json_decode($new_market,true);
		
		if(!is_array($new_market))
			$output["msg"] = "Could not open remote market file";
		else if(!isset($new_market["apps"])){
			$output["result"] = "success";
			$output["msg"] = "No updates available";
		}
		else{
		
			$count = 0;
			foreach($new_market["apps"] as $key => $app){
				
				if(isset($local_marketplace[$key])){
					if(!empty($local_marketplace[$key]["last_install_date"]))
						$app["last_install_date"] = $local_marketplace[$key]["last_install_date"];
					else
						$app["last_install_date"] = 0;
				}
				
				$local_marketplace[$key] = $app;
				
				$count ++;
				
			}
			
			if(!file_put_contents("wd_marketplace.json",json_encode($local_marketplace)))
				$output["msg"] = "Could not update local marketplae file";
			else{
				$output["result"] = "success";
				$output["msg"] = "Marketplace file updated with " . $count . " app" . (($count != 1) ? "s" : "");
				$output["timestamp"] = time();
			}
			
		}
		
		
			
	}
	
}//updateMarketJson
else
	$output["msg"] = "Invalid function";
	
$output["dev"]["req"] = $req;
echo json_encode($output);
?>