<?php include_once "../../wd_protect.php";
if(isset($_SESSION["user"]) && isset($_POST['name']) && isset($_POST['dirpath']) && isset($_POST['file']) && isset($_POST['pass']) && isset($_POST['type'])){
$name = test_input($_POST['name']);
$dirpath = test_input($_POST['dirpath']);
$file = test_input($_POST['file']);
$pass = test_input($_POST['pass']);
$type = test_input($_POST['type']);
$obj = array(
  'user' => $_SESSION["user"],
  'dirpath' => $dirpath,
  'pass' => $pass,
  'name' => $name,
  'type' => $type,
  'clients' => ''
    );
  $con = json_encode($obj);
  file_put_contents($wd_appr . $wd_app . '/' . $file, $con);
wd_head($wd_type, $wd_app, 'start.php', '&me=on');
}
else{
  wd_head($wd_type, $wd_app, 'start.php', '&me=on&wd_ad=Incomplete Information');
}
?>
