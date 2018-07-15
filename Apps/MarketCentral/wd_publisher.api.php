<?php
header("Content-type: application/json");
include_once("../../testInput.php");
include_once("config.inc.php");

if(empty($req["method"]))
	$output["error"] = "You must supply a timestamp";

echo json_encode($output);
?>