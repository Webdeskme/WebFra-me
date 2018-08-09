<?php
class page_builder{
	
	/// THE DIFFERENT PROJECT TYPES THAT CAN BE CREATED IN THIS DEV TOOLS APP
	
}
$wf_pagebuilder = new page_builder();

$request = array_merge($_POST,$_GET);
$req = array();
foreach($request as $key => $value){
	$req[$key] = (!is_array($value)) ? test_input($value) : $value;
}
?>