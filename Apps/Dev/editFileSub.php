<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }

include_once("config.inc.php");

if(empty($req["dir"]))
	$req["dir"] = "";
	
if( !empty($req["editType"]) && !empty($req["editApp"]) && !empty($req["file"]) ){
	$app_dir = $req["editType"] . "/" . $req["editApp"];
	$save_to_dir =  $app_dir . ((!empty($req["dir"])) ? "/" . $req["dir"] : "");
	$file_to_save = $save_to_dir . "/" . $req["file"];
}

if($_SESSION["Login"] != "YES")
	echo "Not authorized. Please log in.";
else if( empty($req["f"]) || empty($req["editType"]) || empty($req["editApp"]) || empty($req["file"]))
	echo "Missing parameter";
else if($req["f"] == "saveFileContents"){
	
	$content = htmlspecialchars_decode($wd_POST["content"], ENT_QUOTES);
	
	if(!is_dir($save_to_dir . "/.wf_history")){
		mkdir($save_to_dir . "/.wf_history",0755);
	}
	$old_content = file_get_contents($file_to_save);
	if($old_content != $content)
		file_put_contents($save_to_dir . "/.wf_history/" . $req["file"] . "_" . microtime(true), $old_content);
	
	if(!file_put_contents($file_to_save, $content))
		echo "Could not save file `" . $file_to_save . "`. Do you have the right permissions?";
	else
		wd_head($wd_type, $wd_app, 'editfile.php', '&editType=' . $req["editType"] . '&editApp=' . $req["editApp"] . '&dir=' . $req["dir"] . '&file=' . $req["file"]);
	
}//saveFileContents
else if($req["f"] == "renameFile"){
	
	if(empty($req["newFileName"]))
		echo "Missing parameter";
	else{
		
		if(!is_writable($file_to_save))
			echo $req["file"] . " is not writeable.";
		else if(!rename($file_to_save, $save_to_dir."/".$req["newFileName"]))
			echo "Could not rename file. Do you have permission?";
		else
			wd_head($wd_type, $wd_app, 'editfile.php', '&editType=' . $req["editType"] . '&editApp=' . $req["editApp"] . '&dir=' . $req["dir"] . '&file=' . $req["newFileName"]);
		
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