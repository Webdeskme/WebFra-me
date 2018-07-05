<?php
header("Content-type: application/json");
include_once("config.inc.php");
include_once("../../testInput.php");

$output = array("result"=>"error");
if(empty($_GET["f"]) && empty($_POST["f"]))
	$output["msg"] = "Missing parameter";
else if(test_input($_GET["f"]) == "loadProjectFiles"){
	
	if(!isset($_GET["dir"]))
		$output["msg"] = "Missing parameter";
	else{
		
		$dt_app_files = $wd_dt->getProjectFiles("../../" . test_input($_GET["dir"]));
		
		$output["result"] = "success";
		$output["data"]["directory"] = test_input($_GET["dir"]);
		$output["data"]["resultset"] = array(
			"count" => count($dt_app_files),
			"files" => $dt_app_files
		);
		
	}
	
}//loadProjectFiles
else if(test_input($_GET["f"]) == "loadFile"){
	
	if(!isset($_GET["file"]))
		$output["msg"] = "Missing parameter";
	else if(!@file_exists("../../" . test_input($_GET["file"])))
		$output["msg"] = "File does not exist";
	else{
		
		$output["result"] = "success";
		
		$file = file_get_contents("../../" . test_input($_GET["file"]));
		$output["data"]["file"] = array(
			"path" => test_input($_GET["file"]),
			"contents" => htmlspecialchars($file)
		);
		
	}
	
}//loadFile
else if(test_input($_POST["f"]) == "saveFile"){
	
	if(!isset($_POST["file"]) || !isset($_POST["contents"]))
		$output["msg"] = "Missing parameter";
	else{
		
		if(!file_put_contents("../../" . test_input($_POST["file"]), htmlspecialchars_decode($_POST["contents"]))){
			$output["msg"] = "Could not save file";
		}
		else{
			$output["result"] = "success";
		}
			
	}
	
}//saveFile
else if(test_input($_POST["f"]) == "moveTabToSession"){
	
	if(!isset($_POST["file"]) || !isset($_POST["contents"]))
		$output["msg"] = "Missing parameter";
	else{
		
		if(!file_put_contents($wd_appFile."/DevTools/".test_input($_POST["file"]),htmlspecialchars_decode(test_input($_POST["contents"]))))
			$output["msg"] = "Could not save tab";
		else{
			$output["result"] = "success";
		}
			
	}
	
}//moveTabToSession
else
	$output["msg"] = "Invalid function";
	
$output["dev"]["GET"] = $_GET;
$output["dev"]["POST"] = $_POST;
echo json_encode($output);
?>