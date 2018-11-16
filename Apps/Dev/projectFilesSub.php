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
	
}//createFolder
else if($req["f"] == "duplicateFile"){
	
	if(!isset($req["dir"]))
		$req["dir"] = "";
	
	if(empty($req["file"]))
		echo "Missing paramter";
	else{
		
		if(!copy($req["editType"]."/".$req["editApp"]."/".((!empty($req["dir"])) ? $req["dir"]."/" : "").$req["file"], $req["editType"]."/".$req["editApp"]."/".((!empty($req["dir"])) ? $req["dir"]."/" : "")."copy-of-" . $req["file"])){
			echo "Could not copy file. Do you have permission?";
		}
		else{
			
			$_SESSION["fileHighlight"][] = array("dir" => ((!empty($req["dir"])) ? $req["dir"]."/" : ""), "file" => "copy-of-" . $req["file"]);
			wd_head($wd_type, $wd_app, 'projectfiles.php', '&editType=' . $req["editType"] . '&editApp=' . $req["editApp"] . '&dir=' . $req["dir"]);
		}
		
	}
	
}//duplicateFile
else if($req["f"] == "copyFile"){
	
	if(!isset($req["dir"]))
		$req["dir"] = "";
	
	if(empty($req["file"]))
		echo "Missing paramter";
	else{
		
		$_SESSION["fileCopy"][] = array("dir" => $req["editType"] . "/" . $req["editApp"] . ((!empty($req["dir"])) ? " / " . $req["dir"] : ""), "file" => $req["file"]);
		wd_head($wd_type, $wd_app, 'projectfiles.php', '&editType=' . $req["editType"] . '&editApp=' . $req["editApp"] . '&dir=' . $req["dir"]);
		
	}
	
}//copyFile
else if($req["f"] == "pasteFile"){
	
	if(empty($_SESSION["fileCopy"]))
		echo "Something went wrong. Please go back and try again.";
	else{
	
		if(!isset($req["dir"]))
			$req["dir"] = "";
		
		$problem = false;
		foreach($_SESSION["fileCopy"] as $key => $file){
			if(!copy($_SESSION["fileCopy"][$key]["dir"]. "/" . $_SESSION["fileCopy"][$key]["file"], $req["editType"]."/".$req["editApp"]."/".((!empty($req["dir"])) ? $req["dir"]."/" : "")."copy-of-" . $_SESSION["fileCopy"][$key]["file"])){
				$problem = true;
			}
			else
				unset($_SESSION["fileCopy"][$key]);
		}
		if($problem){
			echo "Could not copy file. Do you have permission?";
		}
		else{
			wd_head($wd_type, $wd_app, 'projectfiles.php', '&editType=' . $req["editType"] . '&editApp=' . $req["editApp"] . '&dir=' . $req["dir"]);
		}
		
	}
	
}//pasteFile
else if($req["f"] == "export"){
	
	$archive_file_name= $req["editApp"].'Export.zip';
	
	$zip = new ZipArchive();
  
  if ($zip->open($archive_file_name, ZIPARCHIVE::CREATE )!==TRUE) {
    exit("cannot open <$archive_file_name>\n");
  }
  
  $go_dir = array("");
  while(count($go_dir) > 0){
	  foreach($go_dir as $dirkey => $dir){
	  	
	  	$contents = $wd_dt->getProjectFiles($req["editType"] . '/' . $req["editApp"] . "/" . $dir);
	  	
		  foreach($contents as $key => $entry){
		  	
		  	$entry["name"] = $dir . (($dir != "") ? "/" : "") . $entry["name"];
		  	
		  	if (is_file($req["editType"]. '/' . $req["editApp"] . '/' . $entry["name"])) {
		  		$zip->addFile($req["editType"]. '/' . $req["editApp"] . '/' . $entry["name"], $entry["name"]);
		  	}
		  	else if(is_dir($req["editType"]. '/' . $req["editApp"] . '/' . $entry["name"])){
		  		
		  		if(count(scandir($req["editType"]. '/' . $req["editApp"] . '/' . $entry["name"])) == 0)
		  			$zip->addEmptyDir($entry["name"]);
		  		else
		  			$go_dir[] = $entry["name"];
		  		
		  	}
		  	
		  }
		  
		  
		  
		  unset($go_dir[$dirkey]);
	  }
  }
  
 
  $zip->close();
  
  header("Content-type: application/zip"); 
	header("Content-Disposition: attachment; filename=$archive_file_name");
	header("Content-length: " . filesize($archive_file_name));
	header("Pragma: no-cache"); 
	header("Expires: 0"); 
	flush();
	readfile($archive_file_name);
	unset($archive_file_name);
  exit;
	
}//export
else
	echo "Invalid function";

?>