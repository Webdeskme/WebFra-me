<?php
class admin{
	
	public function getSiteName(){
		
		global $wd_admin;
		
		if(file_exists($wd_admin."title.txt")){
			
			$site_name = file_get_contents($wd_admin."title.txt");
			
			return $site_name;
				
		}
		
		return false;
		
	}
	public function getSiteDescription(){
		
		global $wd_admin;
		
		if(file_exists($wd_admin."description.txt")){
			
			$site_name = file_get_contents($wd_admin."description.txt");
			
			return $site_name;
				
		}
		else{
			file_put_contents($wd_admin."description.txt", "A regular Wordframe installation");
			return "A regular Wordframe installation";
		}
		
		return false;
		
	}
	public function getSitePath(){
	
		global $wd_roots;
		
		return $wd_roots[$_SERVER["HTTP_HOST"]];
	}
	public function getUsers($tier = null){
		
		global $wd_root;
		
		$users = array();
		
		$folder = $wd_root . '/User/';
		if ($handle = opendir($folder)) {
      while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
        	
        	$tuser = array(
        		"code" => $entry,
        		"user" => f_dec($entry),
        		"tier" => test_input(file_get_contents($folder . $entry . '/Admin/tier.txt')),
        		"details" => (file_exists($folder . $entry . '/Admin/info.json')) ? json_decode(file_get_contents($folder . $entry . '/Admin/info.json'),true) : array("fn"=>null,"ln"=>null,"email"=>null,"contact"=>null,"notes"=>null)
        	);
        	
        	if(empty($tier) || ($tuser["tier"] == $tier))
        		$users[] = $tuser;

        }
      }
      sort($users);
      return $users;
		}
		
		return false;
		
	}
	public function getSystemTiers(){
		
		global $wd_admin;
		
		$tiers = array();
		
		$tier = 1;
		do{
			
			if(file_exists($wd_admin . 't' . $tier . '.json')){
				$tier_file = json_decode(file_get_contents($wd_admin . 't' . $tier . '.json'));
				$tiers[$tier] = $tier_file;
				
				$continue = true;
			}
			else
				$continue = false;
			
			$tier ++;
		}
		while($continue);
		
		return $tiers;
		
	}//getSystemTiers
	
}
$wf_admin = new admin();

$request = array_merge($_POST,$_GET);
$req = array();
foreach($request as $key => $value){
	$req[$key] = (!is_array($value)) ? test_input($value) : $value;
}
?>