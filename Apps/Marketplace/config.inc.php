<?php
class marketplace{
	
	var $dev_mode = false;
	var $marketplace_file = "wd_marketplace.json";
	var $wf_github_release_api = "https://api.github.com/repos/Webfra-me/Webfra-me/releases/latest";
	var $market_download_location = "http://market.webfra.me/Apps/MarketCentral/wd_marketplace.json.php?timestamp=";
	
	public function get_download_location(){
		return $this->market_download_location;
	}
	public function open_remote_market(){
		
	}
	public function get_content($url){
    $ch = curl_init();

    curl_setopt ($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_HEADER, 0);

    ob_start();

    curl_exec ($ch);
    curl_close ($ch);
    $string = ob_get_contents();

    ob_end_clean();
    
    return $string;     
	}
	public function open_local_marketplace(){
		
		$output = array();
		
		$marketplace_file = $this->marketplace_file;
		
		if(!file_exists($marketplace_file))
			$output["error"] = "Could not open marketplace file";
		else{
			$market = file_get_contents($marketplace_file);
			if(!$market)
				$output["error"] = "Could not open local marketplace file";
			else{
				$market = json_decode($market,true);
				if(!is_array($market))
					$output["error"] = "Could not parse local marketplace file";
				else{
					$output = $market;
				}
			}
		}
		
		return $market;
		
	}
	public function getStreamContext(){
		
		$opts = array(
		  'http'=>array(
		    'method'=>"GET",
		    'header'=>"Accept-language: en\r\n" .
		              "User-agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36\r\n"
		  )
		);
		
		$context = stream_context_create($opts);
		
		return $context;
		
	}
	public function setUpdateDate($app_id){
		
		// $marketplace = $this->open_local_marketplace();
		// $marketplace[$app_id]["updated"] = time();
		
		// if(!file_put_contents($this->marketplace_file, json_encode($marketplace)))
		// 	return false;
		// else
		// 	return true;
		
	}

}
$wd_marketplace = new marketplace();

$request = array_merge($_POST,$_GET);
$req = array();
foreach($request as $key => $value){
	$req[$key] = (!is_array($value)) ? test_input($value) : $value;
}
?>