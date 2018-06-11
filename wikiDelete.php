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
if(isset($_GET['page'])){
  $wd_page = test_input($_GET['page']);
  if(file_exists($wd_root . '/Wiki/' . $wd_page . '.php')){
    unlink($wd_root . '/Wiki/' . $wd_page . '.php');
  }
}
header('Location: wiki.php');
?>
