<?php
header("Content-type: application/json");
include_once("../../testInput.php");
include_once("config.inc.php");


$output = array("result"=>"error");
if(empty($req["f"]))
	$output["msg"] = "Missing parameter";
else if($req["f"] == "loadProjectFiles"){
	
	if(!isset($req["dir"]))
		$output["msg"] = "Missing parameter";
	else{
		
		$dt_app_files = $wd_dt->getProjectFiles("../../" . $req["dir"]);
		
		$output["result"] = "success";
		$output["data"]["directory"] = $req["dir"];
		$output["data"]["resultset"] = array(
			"count" => count($dt_app_files),
			"files" => $dt_app_files
		);
		
	}
	
}//loadProjectFiles
else if($req["f"] == "loadFile"){
	
	if(!isset($req["file"]))
		$output["msg"] = "Missing parameter";
	else if(!@file_exists("../../" . $req["file"]))
		$output["msg"] = "File does not exist";
	else{
		
		$output["result"] = "success";
		
		$file = file_get_contents("../../" . $req["file"]);
		$output["data"]["file"] = array(
			"path" => $req["file"],
			"contents" => htmlspecialchars($file)
		);
		
	}
	
}//loadFile
else if($req["f"] == "saveFile"){
	
	if(!isset($req["file"]) || !isset($req["contents"]))
		$output["msg"] = "Missing parameter";
	else{
		
		if(!file_put_contents("../../" . $req["file"], htmlspecialchars_decode($_POST["contents"]))){
			$output["msg"] = "Could not save file";
		}
		else{
			$output["result"] = "success";
		}
			
	}
	
}//saveFile
else if($req["f"] == "moveTabToSession"){
	
	if(!isset($req["file"]) || !isset($req["contents"]))
		$output["msg"] = "Missing parameter";
	else{
		
		if(!file_put_contents($wd_appFile."/DevTools/".$req["file"],htmlspecialchars_decode($_POST["contents"])))
			$output["msg"] = "Could not save tab";
		else{
			$output["result"] = "success";
		}
			
	}
	
}//moveTabToSession
else if($req["f"] == "newFile"){
	
	if(!isset($req["file"]))
		$output["msg"] = "Missing parameter";
	else{
		
		$path = explode("/",$req["file"]);
		$last_path_index = count($path) - 1;
		$contents = $path[$last_path_index];
		$file_ext = explode(".",$req["file"]);
		$last_index = count($file_ext) - 1;
		if(isset($file_ext[$last_index]) && preg_match("/php/i", $file_ext[$last_index])){
			$contents = "// " . $contents . "\n".'<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; } ?>';
		}
		else if(isset($file_ext[$last_index]) && preg_match("/htm/i", $file_ext[$last_index])){
			$contents = "<!-- // " . $contents . " -->\n";
		}
		else if(isset($file_ext[$last_index]) && preg_match("/^css|js$/i", $file_ext[$last_index])){
			$contents = "/*  " . $contents . " */\n";
		}
		else if($path[$last_path_index] == "app.json"){
			$contents = '{'."\n".'"name":"' . $path[1] . '",'."\n".'"version": "1.0",'."\n".'"icon":"ic.png",'."\n".'"require":{'."\n".'}'."\n".'}';
		}
		else if(isset($file_ext[$last_index]) && preg_match("/json/i", $file_ext[$last_index])){
			$contents = "{}";
		}
		
		if(!file_put_contents("../../" . $req["file"], $contents)){
			$output["msg"] = "Could not write file";
		}
		else{
			$output["result"] = "success";
			$output["data"]["file"] = $req["file"];
		}
			
	}
	
}
else if($req["f"] == "deleteFile"){
	
	if(!isset($req["file"]))
		$output["msg"] = "Missing parameter";
	else if(!file_exists("../../" . $req["file"]))
		$output["msg"] = "File does not exist";
	else{
		
		if(!unlink("../../" . $req["file"])){
			$output["msg"] = "Could not delete file";
		}
		else{
			$output["result"] = "success";
		}
		
	}
	
}
else
	$output["msg"] = "Invalid function";
	
$output["dev"]["req"] = $req;
echo json_encode($output);
?>