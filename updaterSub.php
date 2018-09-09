<?php
session_start();
header("Content-type: application/json");

$files_to_skip = array(
	"path.php",
	"favicon.ico",
	"back.jpg",
	"cred.json",
	"ext.json",
	"feed.xml",
	"Tmpfile.zip",
	"updaterSub.php"
);

$output = array("result" => "error");
if(!file_exists("Apps/Marketplace/config.inc.php"))
	$output["error"] = "You must have Creator&apos;s Marketplace installed to run this file";
else{

	include_once("testInput.php");
	include_once("Apps/Marketplace/config.inc.php");

	if(empty($_GET["step"]))
		$output["error"] = "Missing parameter";
	else if($_GET["step"] == 1){
		
		if( !isset($_SESSION["Login"]) || ($_SESSION["Login"] != "YES") || ($_SESSION["tier"] != "tA") )
			$output["error"] = "Not authorized";
		else if(!file_get_contents("update.txt") || !file_get_contents($wd_marketplace->wf_github_release_api, false, $wd_marketplace->getStreamContext()))
			$output["error"] = "Could not open update files";
		else{
			
			$localVersion = file_get_contents("update.txt");
			$github_api = file_get_contents($wd_marketplace->wf_github_release_api, false, $wd_marketplace->getStreamContext());
			if(!isset(json_decode($github_api,true)["tag_name"]))
				$output["error"] = "Could not open update server";
			else{
				
				$remoteVersion = json_decode($github_api,true)["tag_name"];
				
				if(version_compare("v".$localVersion,$remoteVersion) >= 0){
					$output["error"] = "Your version is already up to date";
					
				}
				else{
					
					$output["result"] = "success";
					$_SESSION["download_zip"] = json_decode($github_api,true)["zipball_url"];
					$output["next_step"] = 2;
					
				}
				
			}
			
		}
		
	}//step 1
	else if($_GET["step"] == 2){
		
		if( !isset($_SESSION["Login"]) || ($_SESSION["Login"] != "YES") || ($_SESSION["tier"] != "tA") )
			$output["error"] = "Not authorized";
		else if(empty($_SESSION["download_zip"]))
			$output["error"] = "Please run the updater from step 1";
		else if(!file_get_contents($_SESSION["download_zip"],false,$wd_marketplace->getStreamContext()))
			$output["error"] = "Could not access update file";
		else if(!file_put_contents('Tmpfile.zip', fopen($_SESSION["download_zip"], 'r',false,$wd_marketplace->getStreamContext()))){
			$output["error"] = "Could not save update package to local disk";
		}
		else{
			$output["result"] = "success";
			$output["next_step"] = 3;
		}
		
	}//step 2
	else if($_GET["step"] == 3){
	
		if( !isset($_SESSION["Login"]) || ($_SESSION["Login"] != "YES") || ($_SESSION["tier"] != "tA") )
			$output["error"] = "Not authorized";
		else if(empty($_SESSION["download_zip"]))
			$output["error"] = "Please run the updater from step 1";
		else if(!file_exists("Tmpfile.zip")){
			$output["error"] = "Update package not found";
		}
		else{
			$zip = new ZipArchive;
			if(!$zip->open('./Tmpfile.zip'))
				$output["error"] = "Could not open update package";
			else if (!($handle = opendir('./')))
				$output["error"] = "Could not open local directory";
			else{
				
				$basename = null;
				$copied_files = array();
				for($i = 0; $i < $zip->numFiles; $i++) {
	        $filename = $zip->getNameIndex($i);
	        $fileinfo = pathinfo($filename);
	        
	        if($fileinfo["dirname"] == "."){
	        	$basename = $fileinfo["basename"];
	        }
	        
	        if(!is_dir($fileinfo['basename']) && !in_array($fileinfo['basename'], $files_to_skip) && ($fileinfo["dirname"] == $basename) ){
		        if(file_exists($fileinfo['basename']) && !unlink('./' . $fileinfo['basename']))
		        	$output["error"] = "Could not remove base installation";
		        else{
		        	if(!copy("zip://Tmpfile.zip#".$filename, "./".$fileinfo['basename']))
		        		$output["error"] = "could not copy file  " . $filename . ".";
		        	else{
			        	//chmod("./".$fileinfo['basename'],0775); 
			        	//echo "Copy " . $filename . "\n";
			        	$copied_files[] = $fileinfo['basename'];
		        	}
		        }
	        }
	    	}
	    	$zip->close();
	    	while (false !== ($entry = readdir($handle))) {
	    		
					if ($entry != "." && $entry != "..") {
						if(!is_dir('./' . $entry) && !in_array($entry,$files_to_skip) && !in_array($entry,$copied_files)){
							
							//echo "Found extra file: " . $entry . "\n";
							if(!unlink('./' . $entry))
								$output["error"] = "could not remove " . $entry . ".";
							
						}
				
	    		}
	    			
	    	}
		    
		    if(!isset($output["error"])){
		    	$output["result"] = "success";
		    	$output["next_step"] = 4;
		    }
				
			}
		}
		
	}//step 3
	else if(test_input($_GET["step"]) == 4){
		
		if( !isset($_SESSION["Login"]) || ($_SESSION["Login"] != "YES") || ($_SESSION["tier"] != "tA") )
			$output["error"] = "Not authorized";
		else{
			if(file_exists('Tmpfile.zip'))
				unlink('./Tmpfile.zip');
			unset($_SESSION["download_zip"]);
			$output["result"] = "success";
			$output["last_step"] = true;
		}
	}
	else
		$output["error"] = "Invalid step";
		
}
	
echo json_encode($output);
?>