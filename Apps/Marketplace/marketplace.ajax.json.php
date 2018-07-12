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
else if($req["f"] == "installApp"){
	
	$app_id = $req["appId"];
	$marketplace = $wd_marketplace->open_local_marketplace();
	if(empty($req["appId"]))
		$output["msg"] = "Missing parameter";
	else if(isset($marketplace["error"]))
		$output["msg"] = $marketplace["error"];
	else if(!isset($marketplace[$app_id]))
		$output["msg"] = "Could not find app config";
	else{
		
		if(!file_exists("../../".htmlspecialchars_decode($marketplace[$app_id]["install_path"])."/")){
			mkdir("../../".htmlspecialchars_decode($marketplace[$app_id]["install_path"])."/",0775);
		}
		
		if(!file_put_contents("../../".$marketplace[$app_id]["install_path"] . '/Tmpfile.zip', fopen(htmlspecialchars_decode($marketplace[$app_id]["host"])."/Pub/" . $marketplace[$app_id]["app"] . "/master.zip", 'r'))){
			$output["msg"] = "Could not download ppp installation";
		}
		else{
			$zip = new ZipArchive;
			$zip->open("../../".$marketplace[$app_id]["install_path"] . '/Tmpfile.zip');
			$zip->extractTo("../../".$marketplace[$app_id]["install_path"] . '/');
			$zip->close();
			unlink("../../".$marketplace[$app_id]["install_path"] . '/Tmpfile.zip');
			$output["result"] = "success";
		}
		
	}
	
}//installApp
else if($req["f"] == "checkWDVersion"){
	
	if(!file_get_contents("../../update.txt") || !file_get_contents("http://webdesk.me/update.txt"))
		$output["msg"] = "Could not open update files";
	else{
		
		$output["result"] = "success";
		
		$localVersion = file_get_contents("../../update.txt");
		$remoteVersion = file_get_contents("http://webdesk.me/update.txt");
		
		if($remoteVersion > $localVersion){
			$output["data"]["update_required"] = true;
			$output["data"]["version"] = $remoteVersion;
		}
		else
			$output["data"]["update_required"] = false;
	}
	
}//checkWDVersion
else
	$output["msg"] = "Invalid function";
	
$output["dev"]["req"] = $req;
echo json_encode($output);
?>