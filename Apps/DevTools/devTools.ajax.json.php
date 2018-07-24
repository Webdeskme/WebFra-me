<?php
header("Content-type: application/json");
include_once("../../testInput.php");
include_once("config.inc.php");


$output = array("result"=>"error");
if(empty($req["f"]))
	$output["msg"] = "Missing parameter";
else if($req["f"] == "loadProjectFiles"){

	if(!isset($req["dir"]))
		$output["msg"] = "Missing parameter";
	else{

		$dt_app_files = $wd_dt->getProjectFiles("../../" . $req["dir"]);

		$output["result"] = "success";
		$output["data"]["directory"] = $req["dir"];
		$output["data"]["resultset"] = array(
			"count" => count($dt_app_files),
			"files" => $dt_app_files
		);

	}

}//loadProjectFiles
else if($req["f"] == "loadFile"){

	if(!isset($req["file"]))
		$output["msg"] = "Missing parameter";
	else if(!@file_exists("../../" . $req["file"]))
		$output["msg"] = "File does not exist";
	else{

		$output["result"] = "success";

		$file = file_get_contents("../../" . $req["file"]);
		$output["data"]["file"] = array(
			"path" => $req["file"],
			"contents" => htmlspecialchars($file)
		);

	}

}//loadFile
else if($req["f"] == "saveFile"){

	if(!isset($req["file"]) || !isset($req["contents"]))
		$output["msg"] = "Missing parameter";
	else{

		if(!file_put_contents("../../" . $req["file"], htmlspecialchars_decode($_POST["contents"]))){
			$output["msg"] = "Could not save file";
		}
		else{
			$output["result"] = "success";
		}

	}

}//saveFile
else if($req["f"] == "moveTabToSession"){

	if(!isset($req["file"]) || !isset($req["contents"]))
		$output["msg"] = "Missing parameter";
	else{

		if(!file_put_contents($wd_appFile."/DevTools/".$req["file"],htmlspecialchars_decode($_POST["contents"])))
			$output["msg"] = "Could not save tab";
		else{
			$output["result"] = "success";
		}

	}

}//moveTabToSession
else if($req["f"] == "newFile"){

	if(!isset($req["file"]) || !isset($req["path"]) || !isset($req["type"]))
		$output["msg"] = "Missing parameter";
	else{

		if($req["type"] == "file"){

			$contents = $req["file"];

			$file_ext = explode(".",$req["file"]);
			$last_index = count($file_ext) - 1;
			if(isset($file_ext[$last_index]) && preg_match("/php/i", $file_ext[$last_index])){
				$contents = "<!-- // " . $contents . "-->\n".'<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; } ?>';
			}
			else if(isset($file_ext[$last_index]) && preg_match("/htm/i", $file_ext[$last_index])){
				$contents = "<!-- // " . $contents . " -->\n";
			}
			else if(isset($file_ext[$last_index]) && preg_match("/^css|js$/i", $file_ext[$last_index])){
				$contents = "/*  " . $contents . " */\n";
			}
			else if($path[$last_path_index] == "app.json"){
				$contents = '{'."\n".'"name":"' . $path[1] . '",'."\n".'"version": "1.0",'."\n".'"icon":"ic.png",'."\n".'"require":{'."\n".'}'."\n".'}';
			}
			else if(isset($file_ext[$last_index]) && preg_match("/json/i", $file_ext[$last_index])){
				$contents = "{}";
			}

			if(!file_put_contents("../../" . $req["path"] . "/" . $req["file"], $contents)){
				$output["msg"] = "Could not write file";
			}
			else{
				$output["result"] = "success";
				$output["data"]["file"] = $req["path"] . "/" . $req["file"];
			}

		}
		else if($req["type"] == "folder"){

			if(!mkdir("../../" . $req["path"] . "/" . $req["file"],0775))
				$output["msg"] = "Could not create folder";
			else{
				$output["result"] = "success";
				$output["data"]["file"] = $req["path"] . "/" . $req["file"];
				$output["data"]["type"] = $req["type"];
			}

		}

	}

}
else if($req["f"] == "deleteFile"){

	if(!isset($req["file"]))
		$output["msg"] = "Missing parameter";
	else if(!file_exists("../../" . $req["file"]))
		$output["msg"] = "File does not exist";
	else{

		if(!is_dir("../../" . $req["file"]) && !unlink("../../" . $req["file"])){
			$output["msg"] = "Could not delete file";
		}
		if(is_dir("../../" . $req["file"]) && !rmdir("../../" . $req["file"])){
			$output["msg"] = "Could not delete directory";
		}
		else{
			$output["result"] = "success";
			$output["data"]["file_deleted"] = $req["file"];
		}

	}

}
else if($req["f"] == "saveTabsToSession"){

	if(!isset($req["tabs"]) || !isset($req["savePath"]))
		$output["msg"] = "Missing parameter";
	else{

		if(!file_exists($req["savePath"]."DevTools"))
			mkdir($req["savePath"]."DevTools",0775);

		if(!file_put_contents($req["savePath"]."DevTools/opentabs.json", htmlspecialchars_decode($_POST["tabs"]))){
			$output["msg"] = "Could not save tab file to session";
		}
		else{
			$output["result"] = "success";
		}

	}

}//saveTabsToSession
else if($req["f"] == "getTabsFromSession"){

	if(!isset($req["savePath"]))
		$output["msg"] = "Missing parameter";
	else{

		if(file_exists($req["savePath"]."DevTools/opentabs.json")){
			$output["result"] = "success";
			$output["data"]["opentabs"] = file_get_contents($req["savePath"]."DevTools/opentabs.json");

		}
		else
			$output["msg"] = "Session file does not exist";

	}

}//getTabsFromSession
else if($req["f"] == "copyFile"){

	if(!isset($req["file"]) || !isset($req["path"]))
		$output["msg"] = "Missing parameter";
	else if(!file_exists("../../".$req["file"]))
		$output["msg"] = "File does not exist";
	else if(!is_dir("../../".$req["path"]))
		$output["msg"] = "Save location is not a folder";
	else{

		$file_path_structure = pathinfo("../../".$req["file"]);

		$continue = false;
		$x = 1;
		$copy_file = $req["path"] . "/" . $file_path_structure["basename"];
		while(!$continue){
			if(file_exists("../../".$copy_file)){

				if(is_dir("../../".$req["file"]))
					$copy_file = $req["path"] . "/" . $file_path_structure["basename"]."_".$x;
				else
					$copy_file = $req["path"] . "/" . $file_path_structure["filename"]."_".$x.".".$file_path_structure["extension"];

				$x ++;
			}
			else
				$continue = true;
		}
		if(!is_writable("../../".$req["path"]))
			$output["msg"] = "Destination folder is not writable";
		else if(is_dir("../../".$req["file"]) && !$wd_dt->recurse_copy("../../".$req["file"], "../../".$copy_file))
			$output["msg"] = "Could not copy folder ".$copy_file;
		else if(!is_dir("../../".$req["file"]) && !copy("../../".$req["file"], "../../".$copy_file)){
			$output["msg"] = "Could not copy file ".$copy_file;
		}
		else{
			$output["result"] = "success";
			$output["data"]["path"] = $req["path"];
			$output["data"]["file"] = $copy_file;
		}

	}

}//copyFile
else if($req["f"] == "createProject"){

	if(!isset($req["project_name"]) || !isset($req["project_type"]) || !isset($req["project_path"]))
		$output["msg"] = "Missing parameters";
	else{

		if(file_exists("../../".$req["project_type"]."/".$req["project_path"]))
			$output["msg"] = "Project folder exists already";
		else{

			if(!mkdir("../../".$req["project_type"]."/".$req["project_path"]))
				$output["msg"] = "Could not create folder " . $req["project_type"]."/".$req["project_path"];
			else{

				if(!file_put_contents("../../".$req["project_type"]."/".$req["project_path"]."/app.json",'{'."\n".'"name":"' . $req["project_name"] . '",'."\n".'"description": "' . $req["project_description"] . '",'."\n".'"version": "1.0",'."\n".'"icon":"ic.png",'."\n".'"require":{'."\n".'"webdesk/webdesk":"2.0"'."\n".'}'."\n".'}') || !file_put_contents("../../".$req["project_type"]."/".$req["project_path"]."/start.php",'<?php // start.php ' . "\n" . '// THIS IS THE DEFAULT PAGE FOR YOUR APP. REFER TO WD_FUNCTIONS FOR ENVIRONMENTAL VARIABLES.' . "\n" . 'if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }'."\n".'?>') || !file_put_contents("../../".$req["project_type"]."/".$req["project_path"]."/header.php",'<?php // header.php' . "\n" . '// THIS FILE WILL BE CALLED INTO THE <HEAD> SECTION OF EACH PAGE AND IS WHERE YOU SHOULD INCLUDE STYLE AND SCRIPT CODES.' . "\n" . 'if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }'."\n".'?>'))
					$output["msg"] = "Could not create app file";
				else{
					$output["result"] = "success";
					$output["data"]["project"] = array(
						"type" => $req["project_type"],
						"path" => $req["project_path"]
					);
				}

			}

		}

	}

}//createProject
else
	$output["msg"] = "Invalid function";

$output["dev"]["req"] = $req;
echo json_encode($output);
?>
