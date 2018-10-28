<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }

$request = array_merge($_POST,$_GET);
$req = array();
foreach($request as $key => $value){
	$req[$key] = (!is_array($value)) ? test_input($value) : $value;
}

if(empty($req["action"]))
	echo "Missing paramter";
else if($req["action"] == "addTier"){
	
	file_put_contents($wd_admin . 't' . $req["nextTier"] . '.json','{}');
	
	wd_head($wd_type, $wd_app, 'permissions.php', '&tier=' . $req["nextTier"]);
	
}//addTier
else if($req["action"] == "saveTier"){
		
	$tier = $req['tier'];
	$myObj = new stdClass();
	$save_req = $req;
	unset($save_req["action"]);
	unset($save_req["tier"]);
	foreach ($save_req as $k=>$v) {
	    $k = test_input($k);
	    $v = test_input($v);
	    $myObj->$k = $v;
	}
	$myJSON = json_encode($myObj);
	if(file_put_contents($wd_admin . 't' . $req["tier"] . ".json", $myJSON))
		wd_head($wd_type, $wd_app, 'permissions.php', '&tier=' . $req["tier"] . '&wd_as=' . urlencode('Settings have been saved.'));
	else
		echo "Could not write tier file. Do you have permission?";
		
}//saveTier
else if($req["action"] == "removeTier"){
	
	if(file_exists($wd_admin . 't' . $req["tier"] . '.json')){
		if(unlink($wd_admin . 't' . $req["tier"] . '.json')){
			wd_head($wd_type, $wd_app, 'permissions.php', '&tier=' . ($req["tier"] - 1) . '&wd_as=' . urlencode('Tier settings successfully removed'));
		}
		else
			echo "Couldn't remove tier file. Do you have permission?";
	}
	else{
		echo "Tier file doesn't exist.";
	}
	
}//removeTier
else
	echo "Invalid function";

?>