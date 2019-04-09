<?php
class Webframe{
	
	private $wf_root_dir;
	private $wf_admin_dir;
	private $wf_app_dir;
	private $wf_www_dir;
	private $wf_siteTitle;
	
	public function __construct(){
		
		if(file_exists("path.php") || file_exists("../../path.php")){
			if(file_exists("path.php"))
			  include('path.php');
			else
			  include("../../path.php");
			
			if(isset($wd_roots[$_SERVER['HTTP_HOST']]))
			  $this->wf_root_dir = test_input($wd_roots[$_SERVER['HTTP_HOST']]);
			else
			  $this->wf_root_dir = test_input($wd_roots['default']);
			  
			if(!empty($this->wf_root_dir)){
				$this->wf_admin_dir = $this->wf_root_dir . '/Admin';
				$this->wf_app_dir = $this->wf_root_dir . '/App';
				$this->wf_www_dir = $this->wf_root_dir . '/www';
			}
			
		}
		
	}
	
	public function getRootDir(){
		
		return $this->wf_root_dir;
		
	}
	public function getSiteTitle(){
		
		if(empty($this->wf_siteTitle)){
			
			$this->wf_siteTitle = (file_exists($this->wf_admin_dir . '/title.txt')) ? file_get_contents($this->wf_admin_dir . '/title.txt') : null;
		}
			  
		return $this->wf_siteTitle;
		
	}
	
}
?>