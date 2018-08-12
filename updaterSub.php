<?php
session_start();
header("Content-type: application/json");

$output = array("result" => "error");
if(empty($_GET["step"]))
	$output["error"] = "Missing parameter";
else if($_GET["step"] == 1){
	
	if( !isset($_SESSION["Login"]) || ($_SESSION["Login"] != "YES") || ($_SESSION["tier"] != "tA") )
		$output["error"] = "Not authorized";
	else if(!file_get_contents("update.txt") || !file_get_contents("http://market.webfra.me/update.txt"))
		$output["error"] = "Could not open update files";
	else{
		
		$localVersion = file_get_contents("update.txt");
		$remoteVersion = file_get_contents("http://market.webfra.me/update.txt");
		
		if(version_compare($localVersion,$remoteVersion) >= 0){
			$output["error"] = "Your version is already up to date";
			
		}
		else{
			
			$output["result"] = "success";
			$output["next_step"] = 2;
			
		}
		
	}
	
}//step 1
else if($_GET["step"] == 2){
	
	if( !isset($_SESSION["Login"]) || ($_SESSION["Login"] != "YES") || ($_SESSION["tier"] != "tA") )
		$output["error"] = "Not authorized";
	else if(!file_exists('http://webdesk.me/www/Media/wd_update.zip'))
		$output["error"] = "Could not access update file";
	else if(!file_put_contents('Tmpfile.zip', fopen('http://market.webfra.me/www/Media/wd_update.zip', 'r'))){
		$output["error"] = "Could not download update file";
	}
	else{
		$output["result"] = "success";
	}
	
}//step 2
else
	$output["error"] = "Invalid step";
	
echo json_encode($output);
?>