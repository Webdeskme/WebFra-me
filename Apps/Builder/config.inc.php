<?php
class page_builder{
	
	var $app_navigation = array(
	  "Pages" => "start.php",
	  "Media" => "pmedia.php",
	  "CSS" => "pcss.php",
	  "Header" => "pheader.php",
	  "Banner" => "pbanner.php",
	  "Footer" => "pfooter.php",
	  "Plugins" => "pplugins.php",
	  "Themes" => "pthemes.php",
	  "Analytics" => "stats.php"
	  //"Log" => "log.php"
	);
	
	public function getAppNav(){
	  
	  return $this->app_navigation;
	  
	}
	public function get_directory_contents($dir){
		
		$contents = array();
		$contents_raw = scandir($dir);
		foreach (scandir($dir) as $entry){
      if ($entry != "." && $entry != ".." && $entry != "style.css" && $entry != "header.php" && $entry != "banner.php" && $entry != "feed.json" && $entry != "nav.json" && $entry != "footer.php") {
				$contents[] = $entry;      
      }
    }
    
    natcasesort($contents);
    
    return $contents;
		
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
	public function getFileIcon($file){
		
		$ext = pathinfo($file)["extension"];
		if(preg_match("/jpg|jpeg|png|bmp|gif|tiff|raw/i", $ext))
			return "image";
		else if(preg_match("/avi|flv|wmv|mov|mp4/i", $ext))
			return "file-video";
		else if(preg_match("/wma|wav|mp3|aiff|au|pcm|flac|mpeg|ape||wv|tta|ATRAC|m4a|SHN|AAC/i", $ext))
			return "file-audio";
			
		return "file";
		
	}
	public function getDiskInformation(){
		
		
		
	}
	
}
$wf_pagebuilder = new page_builder();

$request = array_merge($_POST,$_GET);
$req = array();
foreach($request as $key => $value){
	$req[$key] = (!is_array($value)) ? test_input($value) : $value;
}
?>