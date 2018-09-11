<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
include_once("config.inc.php");


if(!in_array($req["editType"],array("MyApps","MyGames","HUD","MHUD","MyApplets","MyTheme")))
	echo "This project cannot be removed";
else{
	
	if (!is_dir($req["editType"]."/".$req["editApp"]))
		echo "Project does not exist";
	else{
    $files = $wd_dt->getProjectFiles($req["editType"]."/".$req["editApp"]);
    $error = false;
    foreach($files as $key => $file){
    	if(!unlink($req["editType"]."/".$req["editApp"]."/".$file["name"]))
    		$error = true;
    }
    if($error)
    	echo "Could not remove all proejct files";
    else{
    	if(!rmdir($req["editType"]."/".$req["editApp"]))
    		echo "Could not remove project folder. Do you have permission?";
    	else{
    		wd_head($wd_type, $wd_app, 'start.php', '');
    	}
    }
	}
	
}
?>