<?php
class user{
	
	private $userName;
	private $userInfo;
	
	public function __construct(){
		
		if(!empty($_SESSION["user"]))
			$this->userName = $_SESSION["user"];
		
	}
	public function getUsername(){
		
		return f_dec($_SESSION["user"]);
		
	}
	public function getEncodedUsername(){
		
		return $_SESSION["user"];
		
	}
	public function getProfileColor(){
		
		global $wd_root;
		
		if(file_exists($wd_root . '/User/' . $_SESSION["user"] . '/Admin/Pcolor.txt')){
			
    	$pcolor = file_get_contents($wd_root . '/User/' . $_SESSION["user"] . '/Admin/Pcolor.txt');
    	
    	return $pcolor;
    	
		}

		return "#FFFFFF";
		
	}
	public function getUserInfo(){
		
		global $wd_root;
		
		$folder = $wd_root . '/User/';
		
		if(empty($this->userInfo)){
			if(file_exists($folder . $this->userName . '/Admin/info.json')){
				
				$this->userInfo = json_decode(file_get_contents($folder . $this->userName . '/Admin/info.json'),true);
				
			}
			
		}
		
		return $this->userInfo;
		
	}
	public function saveUserInfo($fn, $ln, $email, $contact){
		
		global $wd_root;
		
		$folder = $wd_root . '/User/';
		
		$this->userInfo = array(
			"fn" => $fn,
			"ln" => $ln,
			"email" => $email,
			"contact" => $contact
		);
		
		if(file_exists($folder . $this->userName . '/Admin/info.json'))
			if(file_put_contents($folder . $this->userName . '/Admin/info.json', json_encode($this->userInfo)))
				return true;
				
		return false;
		
	}
	public function getFirstName(){
		
		return $this->getUserInfo()["fn"];
		
	}
	public function getLastName(){
		
		return $this->getUserInfo()["ln"];
		
	}
	public function getEmail(){
		
		return $this->getUserInfo()["email"];
		
	}
	public function getContactInfo(){
		
		return $this->getUserInfo()["contact"];
		
	}
	public function getWebdeskURL(){
		
		global $wd_root;
		
		if(file_exists($wd_root . '/User/' . $_SESSION["user"] . '/Admin/url.txt'))
			return file_get_contents($wd_root . '/User/' . $_SESSION["user"] . '/Admin/url.txt');
			
		return null;
		
	}
	public function getSecret(){
		
		global $wd_root;
		
		return file_get_contents($wd_root . '/User/' . $this->getEncodedUsername() .'/Admin/prand.txt');
		
	}
	public function changePassword($new_pass){
		
		global $wd_root;
		
		$new_sec = str_shuffle(rand((int)10000000000000000000, (int)99999999999999999999) . 'abcdefghijklmnopqrstuvwxyz');
		$new_pass = password_hash(up_enc($new_pass . $this->getEncodedUsername() . $new_sec), PASSWORD_DEFAULT);
		
		if(is_writeable($wd_root . '/User/' . $this->getEncodedUsername() .'/Admin/prand.txt') && is_writeable($wd_root . '/User/' . $this->getEncodedUsername() . '/Admin/pass.txt')){
			if(file_put_contents($wd_root . '/User/' . $this->getEncodedUsername() .'/Admin/prand.txt', $new_sec) && file_put_contents($wd_root . '/User/' . $this->getEncodedUsername() . '/Admin/pass.txt', $new_pass))
				return true;
		}
			
		return false;
		
	}
	
}
?>