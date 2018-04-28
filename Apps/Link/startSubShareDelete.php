<?php 
if(isset($_GET['wd_Link_type']) && isset($_GET['wd_Link_app']) && isset($_GET['wd_Link_sec'])){
  $wd_Link_type = test_input($_GET['wd_Link_type']);
  $wd_Link_app = test_input($_GET['wd_Link_app']);
  $wd_Link_sec = test_input($_GET['wd_Link_sec']);
}
else{
  $wd_Link_type = $wd_type;
  $wd_Link_app = $wd_app;
  $wd_Link_sec = 'start.php';
}
$file = test_input($_GET['file']);
$sep = explode("-", $file);
if(file_exists($wd_appFile . $wd_app . '/' . $wd_app . '.json')){
  $dobj = file_get_contents($wd_appFile . $wd_app . '/' . $wd_app . '.json');
  $dobj = json_decode($dobj);
  unset($dobj->$file);
  $dob = json_encode($dobj);
  file_put_contents($wd_appFile . $wd_app . '/' . $wd_app . '.json', $dob);
}
echo $file;
  $myObj = file_get_contents($wd_appr . $wd_app . '/' . $sep[0] . '.json');
  $myObj = json_decode($myObj);
  $myObj->clients = str_replace( $_SESSION["user"] . ",", "", $myObj->clients);
  $con = json_encode($myObj);
  file_put_contents($wd_appr . $wd_app . '/' . $sep[0] . '.json', $con);
wd_head($wd_Link_type, $wd_Link_app, $wd_Link_sec, '&wd_as=You connection was removed.');
?>