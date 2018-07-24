<?php
class marketpublisher{
	
	var $dev_mode = false;
	var $publisher_api_url = "http://market.webdesk.me/Apps/MarketCentral/wd_marketcentral.api.php";
	var $publisher_oauth_url = "http://market.webdesk.me/web.php?type=Apps&app=MarketCentral&sec=oauthRequest.php";
	var $user_token;
	
	public function __construct(){
		$this->publisher_oauth_url .= "&client=" . $_SERVER["HTTP_HOST"]."&return_uri=".urlencode("http://".$_SERVER["HTTP_HOST"]."/desktopSub.php?type=Apps&app=MarketPublisher&sec=oauthReturn.php");
	}
	public function get_publisher_api_url(){
		return $this->publisher_api_url;
	}
	public function get_oauth_url(){
		return $this->publisher_oauth_url;
	}
	public function get_user_token(){
		
		global $wd_appFile;
		
		if($this->user_token == null){
		
			if(file_exists($wd_appFile."MarketPublisher/auth_token.json")){
				
				$token_info = json_decode(file_get_contents($wd_appFile."MarketPublisher/auth_token.json"),true);
				if(is_array($token_info) && !empty($token_info["token"])){
					
					$this->user_token = $token_info["token"];
					
					return $token_info["token"];
					
				}
				
			}
			
		}
		else
			return $this->user_token;
			
		return false;
		
	}
	public function post_page($url, $postfields){
		
		$ch = curl_init();
	
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
		
		$output = curl_exec($ch);
		if($output){
			
			return $output;
			
		}
		return false;
		
	}
	
}
$wd_marketpublisher = new marketpublisher();


$request = array_merge($_POST,$_GET);
$req = array();
foreach($request as $key => $value){
	$req[$key] = (!is_array($value)) ? test_input($value) : $value;
}
?>