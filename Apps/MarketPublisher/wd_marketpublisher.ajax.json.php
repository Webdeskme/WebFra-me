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
				
				if(file_exists("../../".$req["type"]."/".$req["app"]."/app.json")){
					
					$app_json = json_decode(file_get_contents("../../".$req["type"]."/".$req["app"]."/app.json"),true);
					
					$app_json["app_id"] = $curl_output["app"]["app_id"];
					$app_json["name"] = $req["app_name"];
					$app_json["description"] = $req["app_description"];
					$app_json["version"] = $req["app_ver"];
					$app_json["category"] = $req["app_category"];
					$app_json["rating"] = $req["app_rate"];
					
					file_put_contents("../../".$req["type"]."/".$req["app"]."/app.json", json_encode($app_json));
					
				}
				
				$from_dir = "../../".$req["type"]."/" . $req["app"];
				$to_dir = "../../Pub/" . $req["app"]."_".$curl_output["app"]["id"];
				
				if(!file_exists($to_dir)){
					mkdir($to_dir);
				}
				if(file_exists($from_dir . "/ic.png")){
					copy($from_dir . "/ic.png", $to_dir . '/ic.png');
				}
				wd_zip($from_dir, $to_dir . '/master.zip');
				
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