<?php
//////////////////////////////////////////////
// 
// PING.PHP FILE
//
// This is a helper file for Marketplace
// central to determine the availability 
// of an app for download.
//
// 
//////////////////////////////////////////////
header("X-Robots-Tag: noIndex, nofollow", true);
header("Content-type: application/json");

$output = array("status" => "UNINSTALLED");
if(file_exists("path.php")){
	include("path.php");
	if(file_exists($wd_roots["default"]))
		$output["status"] = "UP";
	else
		$output["status"] = "ERROR";
}
echo json_encode($output);
?>