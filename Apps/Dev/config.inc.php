<?php
class dev_tools{
	
	public $proj_name = null;
	
	/// THE DIFFERENT PROJECT TYPES THAT CAN BE CREATED IN THIS DEV TOOLS APP
	public $create_types = array(
		
		array("name"=>"Apps","icon"=>"th-large","blurb"=>"Extend the functionality of Webdesk","dir"=>"MyApps"),
		array("name"=>"Applets","icon"=>"smile","blurb"=>"Create useful tools in the HUD","dir"=>"Applets"),
		array("name"=>"Themes","icon"=>"palette","blurb"=>"Change the look and feel of your Webdesk","dir"=>"MyTheme"),
		array("name"=>"HUD","icon"=>"desktop","blurb"=>"Change where things are positioned","dir"=>"HUD"),
		array("name"=>"MHUD","icon"=>"mobile-alt","blurb"=>"Change the HUD on mobile devices","dir"=>"MHUD")
		//array("name"=>"game","icon"=>"gamepad","blurb"=>"Take a break from all that hard work","dir"=>"Games")
	);
	
	
	public function setProjName($projectName){
		
		$this->proj_name = $projectName;
		
	}
	public function getProjName(){
		
		return $this->proj_name;
		
	}
	public function getProjectTypes(){
		
		return $this->create_types;
		
	}
	/// LOADS LOCAL PROJECTS FROM MYAPPS
	public function getProjectTypeInfo($type){
		
		foreach($this->create_types as $key => $ttype){
			
			if($ttype["dir"] == $type)
				return $ttype;
			
		}
		
		return false;
		
	}
	public function getLocalProjects($type = "MyApps"){
		
		$my_apps = array();
		
		if(is_dir($type)){
			
			if($dh = opendir($type)){
				
				while(($dir = readdir($dh)) !== false){
					
					//if(is_dir($type . "/" . $dir) && ($dir != ".") && ($dir != "..") ){
					if(($dir != ".") && ($dir != "..") && ($dir != ".wf_history") ){
							
						$name = $dir;
							
						if(file_exists($type . "/" . $dir . "/app.json")){
							
							$info = file_get_contents($type . "/" . $dir . "/app.json");
							
							$info = json_decode($info,true);
							
							if(is_array($info) && ($info["name"] != null)){
								$name = $info["name"];
							}
						}
						
						$my_apps[] = array(
							"name" => $name,
							"handle" => $dir,
							"type" => "MyApps"
						);
						
					}
					
				}
				
			}
			
		}
		
		return $my_apps;
		
	}//getLocalProjects
	/// LOADS FILES IN A SPECIFIED DIRECTORY
	function getProjectFiles($dir = ""){
		
		$files = array();
		
		if(is_dir($dir)){
			//print_r($dir);
			
			if($dh = opendir($dir)){
				
				while(($file = readdir($dh)) !== false){
					
					if( ($file != ".") && ($file != "..") && ($file != ".wf_history") ){
						
						if(filetype($dir . "/" . $file) == "file"){
							$file_ext = explode(".",$file);
							
							$ext_count = count($file_ext) - 1;
							
							$icon = "file";
							if(isset($file_ext[$ext_count]) && in_array(strtolower($file_ext[$ext_count]), array("png","gif","jpg","jpeg","bmp")))
								$icon = "image";
							else if(isset($file_ext[$ext_count]) && in_array(strtolower($file_ext[$ext_count]), array("php","php5","js","css","html","htm")))
								$icon = "code";
						}
						else
							$icon = "folder";
						
						$file_type = filetype($dir . "/" . $file);
						
						$files[] = array(
							"type" => $file_type,
							"name" => $file,
							"icon" => $icon,
							"path" => str_replace("../","",$dir)
						);
						
					}
					
				}
				
			}
			
		}
		
		sort($files);
		
		return $files;
		
	}//getProjectFiles
	function recurse_copy($src,$dst) { 
		$return = true;
    $dir = opendir($src); 
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
      if (( $file != '.' ) && ( $file != '..' )) { 
        if ( is_dir($src . '/' . $file) ) {
          if(!recurse_copy($src . '/' . $file,$dst . '/' . $file))
          	$return = false;
        } 
        else { 
          if(!copy($src . '/' . $file,$dst . '/' . $file))
          	$return = false;
        } 
      } 
    } 
    closedir($dir); 
    
    return $return;
	}
	public function getFormattedFileSize($file){
		
		$file_size = filesize($file)/1000;
    if($file_size > 100000000){
      $file_size = round($file_size/1000000000,1)."T";
    }
    else if($file_size > 100000){
      $file_size = round($file_size/1000000,1)."G";
    }
    else if($file_size > 100){
      $file_size = round($file_size/1000,1)."M";
    }
    else{
      $file_size = round($file_size,1)."K";
    }
    
    return $file_size;
    
	}
}
$wd_dt = new dev_tools();

$request = array_merge($_POST,$_GET);
$req = array();
foreach($request as $key => $value){
	$req[$key] = (!is_array($value)) ? test_input($value) : $value;
}
?>