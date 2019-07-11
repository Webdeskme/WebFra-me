<?php
session_start();
header("X-Robots-Tag: noIndex, nofollow", true);
if ($_SESSION["Login"] != "YES") {
	  session_destroy();
          header('Location: index.php?test=bad');
        }
include("testInput.php");
include("function.php");
if(isset($_SESSION["tier"])){
  if($_SESSION["tier"] != "tA"){
    $wd_test = "no";
    if($wd_app == 'MyHUD' && test_input($_GET['sec']) == 'app_nav.php'){
      $wd_test = 'yes';
    }
    if($wd_test != 'yes'){
    if(isset($wd_app)){
      
      if($wd_type == "MyApps"){
        $wd_app1 = "myApp_" . $wd_app;
      }
      else{
        $wd_app1 = $wd_app;
      }
      $wd_tierDoc = file_get_contents($wd_admin . $_SESSION["tier"] . '.json');
      $wd_tierDoc = json_decode($wd_tierDoc);
      if(isset($wd_tierDoc->$wd_app1)){
        if($wd_tierDoc->$wd_app1 != 'Yes'){
          session_destroy();
          header('Location: index.php?test=bad+tier1');
          exit();
        }
      }
      else{
        //session_destroy();
        //header('Location: index.php?test=bad+tier2');
        //exit();
      }
    }
    
  }
    
    
  }
}
else{
  header('Location: index.php?test=bad+tier3');
}
?>
