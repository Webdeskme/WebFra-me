<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }

include_once("config.inc.php");

if($_SESSION["Login"] != "YES")
	echo "Not authorized. Please log in.";
else if( empty($req["f"]) || empty($req["editType"]) || empty($req["editApp"]))
	echo "Missing parameter";
else if($req["f"] == "createFolder"){
	
	if(!isset($req["dir"]))
		$req["dir"] = "";
	
	if(empty($req["folder_name"]))
		echo "Missing parameter";
	else{
		
		if(!is_writable($req["editType"]."/".$req["editApp"]."/".$req["dir"]))
			echo $req["dir"] . " is not writeable.";
		else if(!mkdir($req["editType"]."/".$req["editApp"]."/".$req["dir"]."/".$req["folder_name"], 0755))
			echo "Could not create folder. Do you have permission?";
		else
			wd_head($wd_type, $wd_app, 'projectfiles.php', '&editType=' . $req["editType"] . '&editApp=' . $req["editApp"] . '&dir=' . $req["dir"] . ((!empty($req["dir"])) ? "/" : "") . $req["folder_name"]);
		
		
	}
	
}

?>