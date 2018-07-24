<?php
session_start();
header("Content-type: application/json");
include_once("../../testInput.php");
include_once("config.inc.php");


$output = array("result"=>"error");
if(empty($req["f"]))
	$output["msg"] = "Missing parameter";
else if($req["f"] == "publishApp"){
	
	if(empty($req["app_name"])){
		$output["highlightField"][] = "app_name";
		$output["highlightMsg"][] = "App Name cannot be blank";
	}
	if(empty($req["app_description"])){
		$output["highlightField"][] = "app_description";
		$output["highlightMsg"][] = "Description cannot be blank";
	}
	if(!preg_match("/^[0-9]+\.[0-9]+/i",$req["app_ver"])){
		$output["highlightField"][] = "app_ver";
		$output["highlightMsg"][] = 'Please use the Semantic Versioning Specification <a href="https://semver.org/" target="_blank">Read more</a>';
	}
	if(empty($req["highlightField"])){
		
		$req["method"] = "publishApp";
		$req["token"] = $wd_marketpublisher->get_user_token();
		
		foreach($req as $key => $value){
			$post_fields[$key] = $value;
		}
		
		$curl_output = $wd_marketpublisher->post_page($wd_marketpublisher->get_publisher_api_url(), $post_fields);
		if($curl_output){
			
			$output["data"] = json_decode($curl_output, true);
			
			if(!empty($curl_output["error"]))
				$output["msg"] = $curl_output["error"];
			else{
				
				$output["result"] = "success";
				
				
				
			}
			
		}
		else
			$output["msg"] = "Could not communicate with Market Publisher API";
		
	}
	
}//publishApp
else
	$output["msg"] = "Invalid function";
	
$output["dev"]["req"] = $req;
echo json_encode($output);
?>