<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; } ?>
<h1>Client List:</h1>
<?php
$file = test_input($_GET['file']);
$dobj = file_get_contents($wd_appr . $wd_app . '/' . $file);
$dobj = json_decode($dobj);
$user = $dobj->clients;
$user = explode(",", $user);
$x = 0;
foreach ($user as $entry){
  if($entry != ""){
  $x = $x + 1;
  echo '<b>' . $x . ': </b>' . f_dec($entry) . '<br>';
  }
}
?>
