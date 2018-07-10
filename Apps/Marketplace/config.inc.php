<?php
class marketplace{
	
	public $dev_mode = false;
	public $marketplace = null;

}
$wd_marketplace = new marketplace();

$request = array_merge($_POST,$_GET);
$req = array();
foreach($request as $key => $value){
	$req[$key] = (!is_array($value)) ? test_input($value) : $value;
}
?>