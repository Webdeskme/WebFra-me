<?php
header("X-Robots-Tag: noIndex, nofollow", true);
session_start();
include "testInput.php";
if(isset($_SESSION["Login"])){
if ($_SESSION["Login"] != "YES") {
  session_destroy();
  header('Location: index.php?page=login.php&wiki=yes');
}
}
else{
  header('Location: index.php?page=login.php&wiki=yes');
}
if(isset($_GET['page']) && isset($_POST['con'])){
  $wd_page = test_input($_GET['page']);
  $wd_con = htmlspecialchars_decode(test_input ($_POST['con']), ENT_QUOTES);;
}
else{
  header('Location: wiki.php?page=Index');
}
if(isset($_GET['go'])){
  $wd_go = test_input($_GET['go']);
}
else{
  $wd_go = $wd_page;
}
file_put_contents('www/Wiki/' . $wd_page . '.php', $wd_con);
$wd_logO = file_get_contents('wikiLogFile.php');
$wd_log = '->' . f_dec($_SESSION['user']) . ' has modified ' . $wd_page . '.php on ' . date("Y/m/d") . ' at ' . date("h:i:sa"). ' EST.<br>' . $wd_logO;
$wd_log = substr($wd_log, 0, 2000);
file_put_contents('wikiLogFile.php', $wd_log);
header('Location: wiki.php?page=' . $wd_go);
?>