<?php
class marketplace{
	
	var $dev_mode = false;
	var $marketplace_file = "wd_marketplace.json";
	var $wf_github_release_api = "https://api.github.com/repos/Webdeskme/Webfra-me/releases/latest";
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
				$output["error"] = "Coudl not open local marketplace file";
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

}
$wd_marketplace = new marketplace();

$request = array_merge($_POST,$_GET);
$req = array();
foreach($request as $key => $value){
	$req[$key] = (!is_array($value)) ? test_input($value) : $value;
}
?>