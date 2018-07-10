<?php
class marketplace{
	
	var $dev_mode = false;
	var $market_download_location = "http://webdesk.shirtntie.net/MyApps/MarketCentral/wd_marketplace.json.php?timestamp=";
	
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

}
$wd_marketplace = new marketplace();

$request = array_merge($_POST,$_GET);
$req = array();
foreach($request as $key => $value){
	$req[$key] = (!is_array($value)) ? test_input($value) : $value;
}
?>