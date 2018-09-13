<?php
include_once("config.inc.php");
//if(date("i" == "00")){
if(1){
	
	// check webdesk version for new version
	echo "Checking server for update\n";
	if(file_get_contents($_CRON["wd_path"] . "/update.txt") && file_get_contents($wd_marketplace->wf_github_release_api, false, $wd_marketplace->getStreamContext())){
		
		$localVersion = file_get_contents($_CRON["wd_path"] . "update.txt");
		$github_api = file_get_contents($wd_marketplace->wf_github_release_api, false, $wd_marketplace->getStreamContext());
		if(!isset(json_decode($github_api,true)["tag_name"]))
			echo "ERROR! Could not open update server";
		else{
			$remoteVersion = json_decode($github_api,true)["tag_name"];
			if(version_compare("v".$localVersion,$remoteVersion) >= 0){
				echo "- Update not required at this time.";
			}
			else{
				echo "- Update required at this time";
			}
		}
		
	}
	
}
?>