<?php 
if(isset($_POST['wd_Link_type']) && isset($_POST['wd_Link_app']) && isset($_POST['wd_Link_sec'])){
  $wd_Link_type = test_input($_POST['wd_Link_type']);
  $wd_Link_app = test_input($_POST['wd_Link_app']);
  $wd_Link_sec = test_input($_POST['wd_Link_sec']);
}
else{
  $wd_Link_type = $wd_type;
  $wd_Link_app = $wd_app;
  $wd_Link_sec = 'start.php';
}
$code = test_input($_POST['code']);
$sep = explode('-', $code);
if(file_exists($wd_appr . $wd_app . '/' . $sep[0] . '.json')){
$obj = file_get_contents($wd_appr . $wd_app . '/' . $sep[0] . '.json');
$obj = json_decode($obj);
if($obj->pass == $sep[1]){
  if(!file_exists($wd_appFile . $wd_app . '/')){
    mkdir($wd_appFile . $wd_app . '/');
  }
  $name = $obj->name;
  if(!file_exists($wd_appFile . $wd_app . '/' . $wd_app . '.json')){
    $myObj = array($code => $name);
  }
  else{
    $myObj = file_get_contents($wd_appFile . $wd_app . '/' . $wd_app . '.json');
    $myObj = json_decode($myObj);
    //$myObj2 = array($code => $name);
    //$myObj = array_replace($myObj1, $myObj2);
    $myObj->$code = $name;
  }
  $myjson = json_encode($myObj);
  file_put_contents($wd_appFile . $wd_app . '/' . $wd_app . '.json', $myjson);
  $myObj = file_get_contents($wd_appr . $wd_app . '/' . $sep[0] . '.json');
  $myObj = json_decode($myObj);
  $myObj->clients = $myObj->clients . $_SESSION["user"] . ',';
  $con = json_encode($myObj);
  file_put_contents($wd_appr . $wd_app . '/' . $sep[0] . '.json', $con);
  wd_head($wd_Link_type, $wd_Link_app, $wd_Link_sec,'&wd_as=Connection success.');
}
else{
  wd_head($wd_Link_type, $wd_Link_app, $wd_Link_sec,'&wd_aw=Connection failed.');
}
}
else{
  wd_head($wd_Link_type, $wd_Link_app, $wd_Link_sec,'&wd_aw=Connection failed.');
}
?>