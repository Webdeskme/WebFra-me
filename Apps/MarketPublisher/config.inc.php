<?php
class marketpublisher{
	
	var $dev_mode = false;
	var $publisher_api_url = "http://market.webdesk.me/Apps/MarketCentral/wd_publisher.json.php";
	var $publisher_oauth_url = "http://market.webdesk.me/web.php?type=Apps&app=MarketCentral&sec=oauthRequest.php&client=";
	
	public function __construct(){
		$this->publisher_oauth_url .= $_SERVER["HTTP_HOST"]."&return_uri=".urlencode("http://".$_SERVER["HTTP_HOST"]."/desktopSub.php?type=Apps&app=MarketPublisher&sec=oauthReturn.php");
	}
	public function get_publisher_api_url(){
		return $this->publisher_api_url;
	}
	public function get_oauth_url(){
		return $this->publisher_oauth_url;
	}
	
}
$wd_marketpublisher = new marketpublisher();


$request = array_merge($_POST,$_GET);
$req = array();
foreach($request as $key => $value){
	$req[$key] = (!is_array($value)) ? test_input($value) : $value;
}
?>