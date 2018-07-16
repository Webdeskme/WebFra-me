<?php
header("Content-type: application/json");
include("../../testInput.php");
include_once("config.inc.php");

if(empty($req["timestamp"]))
	$output["error"] = "You must supply a timestamp";
else if($req["timestamp"] > time())
	$output["error"] = "Timestamp cannot be greater than the current timestamp";
else{

	$output = array();
	$output["timestamp"] = date("Y-m-d H:i:s",$req["timestamp"]);
	$result = $db->query("SELECT * FROM apps INNER JOIN categories ON apps.cat_id=categories.id WHERE apps.status='1' AND apps.date_updated>='".date("Y-m-d H:i:s",$req["timestamp"])."' ORDER BY apps.app_name");
	while($app = $result->fetch_array(MYSQLI_ASSOC)){
		
		switch($app["app_rating"]){
			default: 
				$app_rating = "Everyone";
				break;
		}
		
		$app_name = $app["app_name"];
		$app_id = $app["app_id"];
		$output["apps"][$app_id] = array(
			"app" => $app_name,
			"app_id" => $app["app_id"],
			"name" => $app_name,
			"description" => $app["app_description"],
			"install_path" => $app["app_path"],
			"email" => $app["app_email"],
			"host" => $app["app_host"],
			"cat" => $app["cat_name"],
			"rate" => $app_rating,
			"vr" => $app["app_version"],
			"certified" => false,
			"price" => 0,
			"updated" => strtotime($app["date_updated"])
		);
		ksort($output["apps"][$app_id]);
		
	}//while
}
echo json_encode($output);
?>