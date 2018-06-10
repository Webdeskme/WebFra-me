<?php
if ($_SERVER['SERVER_ADDR'] != $_SERVER['REMOTE_ADDR']){
  $this->output->set_status_header(400, 'No Remote Access Allowed');
  exit; //just for good measure
}
include("protect.php");
//ini_set("error_reporting", E_ALL);
if(isset($_GET["type"]) and isset($_GET["app"]) and isset($_GET["sec"])){
        $type = test_input($_GET["type"]);
        $app = test_input($_GET["app"]);
        $sec = test_input($_GET["sec"]);
  if(isset($_GET["app"])){
    if(file_exists($type . "/" . $app . "/functions.php")){
        include($type . "/" . $app . "/functions.php");
	}
    if(isset($sec) && file_exists($type . "/" . $app . "/functions_" . $sec . ".php")){
        include($type . "/" . $app . "/functions_" . $sec . ".php");
    }
}
  if(file_exists($type . "/" . $app . "/" . $sec)){
    include($type . "/" . $app . "/" . $sec);
  }
     else{
       echo '<h1>404 Error</h1><p>This page does not exsist. <a href="desktop.php">Please click here to go to the home screen</a></p><p>Powered by <a href="http://webdesk.me/">WebDesk.me</a></p>';
     }
    }
?>
