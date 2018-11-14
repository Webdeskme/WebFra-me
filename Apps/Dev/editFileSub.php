<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }

include_once("config.inc.php");

if($_SESSION["Login"] != "YES")
	echo "Not authorized. Please log in.";
else if( empty($req["f"]) || empty($req["editType"]) || empty($req["editApp"]) || empty($req["file"]))
	echo "Missing parameter";
else if($req["f"] == "renameFile"){
	
	if(empty($req["newFileName"]))
		echo "Missing parameter";
	else{
		
		if(!is_writable($req["editType"]."/".$req["editApp"]."/".$req["file"]))
			echo $req["file"] . " is not writeable.";
		else if(!rename($req["editType"]."/".$req["editApp"]."/".$req["file"], $req["editType"]."/".$req["editApp"]."/".$req["newFileName"]))
			echo "Could not rename file. Do you have permission?";
		else
			wd_head($wd_type, $wd_app, 'editfile.php', '&editType=' . $req["editType"] . '&editApp=' . $req["editApp"] . '&file=' . $req["newFileName"]);
		
		
	}
	
}
else if($req["f"] == "removeFile"){
	
	if(empty($req["file"]))
		echo "Missing parameter";
	else{
	
		$file = $req["editType"] . "/" . $req["editApp"] . "/" . ((!empty($req["dir"])) ? $req["dir"] . "/" : "") . $req["file"];
	
		if(is_dir($file)){
	    if(!wd_deleteDir($file))
	    	echo "Could not remove directory. Do you have permission?";
	    else
	    	wd_head($wd_type, $wd_app, 'projectfiles.php', '&editType=' . $req["editType"] . '&editApp=' . $req["editApp"]);
		}
		else{
			if(!unlink($file))
				echo "Could not remove file. Do you have permission?";
			else{
				
				wd_head($wd_type, $wd_app, 'projectfiles.php', '&editType=' . $req["editType"] . '&editApp=' . $req["editApp"]);
			}
		}
		
	}
}
else
	echo "Invalid function";

?>