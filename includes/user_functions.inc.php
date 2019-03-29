<?php
class user{
	
	private $userInfo;
	
	public function __construct(){
		
		
		
	}
	public function getUsername(){
		
		return f_dec($_SESSION["user"]);
		
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
			if(file_exists($folder . $_SESSION["user"] . '/Admin/info.json')){
				
				$this->userInfo = json_decode(file_get_contents($folder . $_SESSION["user"] . '/Admin/info.json'),true);
				
			}
			
		}
		
		return $this->userInfo;
		
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
	
}
?>