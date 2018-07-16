<?php
header("Content-type: application/json");
include_once("../../testInput.php");
include_once("config.inc.php");


$output = array("result"=>"error");
if(empty($req["f"]))
	$output["msg"] = "Missing parameter";
else if($req["f"] == "marketplacepublisher_login"){
	
	if(empty($req["publishers_email"]))
		$output["msg"] = "Missing parameter";
	else{
	
		$result = $db->query("SELECT * FROM users WHERE uemail='".$req["publishers_email"]."' AND status>'0'");
		$user = $result->fetch_array(MYSQLI_ASSOC);
		if($result->num_rows == 0)
			$output["msg"] = "User not found";
		else if(!password_verify(up_enc($req["publishers_password"] . $req["publishers_email"] . $user["usec"]),$user["upass"]))
			$output["msg"] = "Incorrect password";
		else{
			
			$token = hash("sha256",up_enc($req["publishers_password"] . $req["publishers_email"].microtime(true)));
			
			$sql = "INSERT INTO users_tokens (uid, token_key, date_created, status) VALUES ('".$user["id"]."', '$token', '$today', '1')";
			if(!$db->query($sql)){
				$output["msg"] = "An internal server error has occured. Please try again later.";
				$output["error"] = $db->error;
			}
			else{
				$output["result"] = "success";
				$output["data"]["token"] = $token;
			}
			
		}
		
	}
	
}//marketplacepublisher_login
else
	$output["msg"] = "Invalid function";
	
$output["dev"]["req"] = $req;
echo json_encode($output);
?>