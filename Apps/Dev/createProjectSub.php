<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
include_once("config.inc.php");

$req["project_path"] = trim(str_replace(" ", "", $req["project_path"]));

if(!isset($req["project_name"]) || !isset($req["project_type"]) || !isset($req["project_path"]))
	echo "Missing parameters";
else{

	if(file_exists($req["project_type"]."/".$req["project_path"]))
		echo "Project folder exists already";
	else{
		
		if(!mkdir($req["project_type"]."/".$req["project_path"],0775,true))
			echo "Could not create project folder " . $req["project_type"]."/".$req["project_path"] . ". Do you have permission?";
		else{

			if(!file_put_contents($req["project_type"]."/".$req["project_path"]."/app.json",'{'."\n".'"name":"' . $req["project_name"] . '",'."\n".'"description": "' . $req["project_description"] . '",'."\n".'"version": "1.0",'."\n".'"icon":"ic.png",'."\n".'"require":{'."\n".'"webdesk/webdesk":"2.0"'."\n".'}'."\n".'}') || !file_put_contents($req["project_type"]."/".$req["project_path"]."/start.php",'<?php // start.php ' . "\n" . '// THIS IS THE DEFAULT PAGE FOR YOUR APP. REFER TO WD_FUNCTIONS FOR ENVIRONMENTAL VARIABLES.' . "\n" . 'if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }'."\n".'?>') || !file_put_contents($req["project_type"]."/".$req["project_path"]."/header.php",'<?php // header.php' . "\n" . '// THIS FILE WILL BE CALLED INTO THE <HEAD> SECTION OF EACH PAGE AND IS WHERE YOU SHOULD INCLUDE STYLE AND SCRIPT CODES.' . "\n" . 'if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }'."\n".'?>'))
				echo "Could not create app file";
			else{
				wd_head($wd_type, $wd_app, 'projectfiles.php', '&editType=' . $req["project_type"] . '&editApp=' . $req["project_path"]);
			}

		}

	}

}


?>
