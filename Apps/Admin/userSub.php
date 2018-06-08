<?php include_once "../../wd_protect.php";
$user = test_input($_POST["user"]);
$fn = test_input($_POST["fn"]);
$ln = test_input($_POST["ln"]);
$email = test_input($_POST["email"]);
$contact = test_input($_POST["contact"]);
$notes = test_input($_POST["notes"]);
if(file_exists($wd_root . '/User/' . $user . '/Admin/info.json')){
  //$obj = file_get_contents($wd_root . 'User/' . $user . '/Admin/info.json');
  $obj = file_get_contents($wd_root . '/User/' . $user . '/Admin/info.json');
  $obj = json_decode($obj);
}
else{
  $obj = new stdClass;
}
$obj->fn = $fn;
$obj->ln = $ln;
$obj->email = $email;
$obj->contact = $contact;
$obj->notes = $notes;
$nObj = json_encode($obj);
file_put_contents($wd_root . '/User/' . $user . '/Admin/info.json', $nObj);
wd_head($wd_type, $wd_app, 'user.php', '&user=' . $user);
?>
