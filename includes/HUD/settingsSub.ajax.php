<?php
session_start();
header("Content-type: application/json");
include_once("../../testInput.php");

$wf_user = new user;

foreach($_POST as $key => $value){
	$_POST[$key] = htmlspecialchars($value, ENT_QUOTES);
}
foreach($_GET as $key => $value){
	//$_POST[$key] = htmlspecialchars($value, ENT_QUOTES);
}

$output = array("response" => 400);

if( empty($_SERVER["HTTP_ORIGIN"]) || ( ($_SERVER["HTTP_ORIGIN"] != "http://" . $_SERVER["HTTP_HOST"]) && ($_SERVER["HTTP_ORIGIN"] != "https://" . $_SERVER["HTTP_HOST"]) ) ){
	$output["response"] = 401;
	$output["error"] = "Unauthorized";
}
else if(empty($_POST["f"]))
	$output["error"] = "Missing parameter";
else if($_POST["f"] == "saveProfile"){
	
	if($wf_user->saveUserInfo($_POST["fn"], $_POST["ln"], $_POST["email"], $_POST["contact"]))
		$output["response"] = 300;
	else{
		$output["response"] = 500;
		$outpt["error"] = "An internal server error has occurred. Please try again later.";
	}
	
}//saveProfile
else if($_POST["f"] == "changePassword"){
	
	$curr_pass = file_get_contents($wd_root . '/User/' . $wf_user->getEncodedUsername() . '/Admin/pass.txt');
	if(empty($_POST["opass"])){
		$output["error"] = "Please provide your current password";
	}
	else if(empty($_POST["npass"]))
		$output["error"] = "Please provide a new password";
	else if(empty($_POST["vpass"]))
		$output["error"] = "Please confirm your new password";
	else if($_POST["npass"] != $_POST["vpass"])
		$output["error"] = "Passwords do not match";
	else if(!password_verify(up_enc($_POST["opass"] . $wf_user->getEncodedUsername() . $wf_user->getSecret()), $curr_pass))
		$output["error"] = "Invalid current password";
	else{
		
		if(!$wf_user->changePassword($_POST["vpass"])){
			$output["response"] = 500;
			$output["error"] = "An internal server error has occurred. Please try again later.";
		}
		else
			$output["response"] = 300;
		
	}
	
}//changePassword
else if($_POST["f"] == "changeDisplaySettings"){
	
	if(!empty($_POST["back"]))
		file_put_contents($wd_adminFile . 'back.txt', $_POST["back"]);
	if(!empty($_POST["color"]))
		file_put_contents($wd_root . '/User/' . $wf_user->getEncodedUsername() . '/Admin/color.txt', $_POST["color"]);
	if(!empty($_POST["pcolor"]))
		file_put_contents($wd_root . '/User/' . $wf_user->getEncodedUsername() . '/Admin/Pcolor.txt', $_POST["pcolor"]);
	
	$output["response"] = 300;
	
}
else{
	$output["response"] = 404;
	$output["error"] = "Invalid function";
}
	
echo json_encode($output);
?>