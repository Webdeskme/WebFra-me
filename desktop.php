<?php
include("protect.php");
if(isset($_GET["app"]) and isset($_GET["sec"])){
  $app = test_input($_GET["app"]); 
  $sec = test_input($_GET["sec"]); 
  if(isset($_GET["type"])){
    $type = test_input($_GET["type"]);
  }
  elseif(is_dir('Apps/' . $app)){
    $type = 'Apps/';
  }
  elseif(is_dir('MyApps/' . $app)){
    $type = 'MyApps/';
  }
  else{
    header('Location: desktop.php');
    exit();
  }
}
if(isset($_GET["app"])){
  if(file_exists($type . "/" . $app . "/functions.php")){
    include($type . "/" . $app . "/functions.php");
	}
  if(isset($sec) && file_exists($type . "/" . $app . "/functions_" . $sec)){
    include($type . "/" . $app . "/functions_" . $sec);
  }
  $wd_app_name = $app;
  $wd_app_path = $type."/".$app;
  if(file_exists($type."/".$app."/app.json")){
    $app_info = json_decode(file_get_contents($type."/".$app."/app.json"));
    if(is_array($app_info) && !empty($app_info["name"]))
      $wd_app_name = $app_info["name"];
  }
}
if(file_exists($wd_admin . $_SESSION['tier'] . '.json')){
  $myObj = file_get_contents($wd_admin . $_SESSION['tier'] . '.json');
  $myObj = json_decode($myObj); 
  $wd_HUD = $myObj->HUD;
  $wd_MHUD = $myObj->MHUD;
} 
else{ 
  $wd_HUD = "default.php";   
  $wd_MHUD = "default.php"; 
}
if(isset($_SESSION["HUD"])){
if($_SESSION["HUD"] == "Desktop"){
  $wd_include = 'HUD/' . $wd_HUD;
}
elseif($_SESSION["HUD"] == "Mobile"){
  $wd_include = 'MHUD/' . $wd_MHUD;
}
include $wd_include;
}
else{
  header('Location: index.php');
}
exit();
?>