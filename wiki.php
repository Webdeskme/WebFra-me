<?php
session_start();
include "testInput.php";
if(isset($_GET['page'])){
  $wd_page = test_input($_GET['page']);
  if(file_exists($wd_root . '/Wiki/' . $wd_page . '.php')){
    if(isset($_GET['type'])){
      $wd_type = test_input($_GET['type']);
      if($wd_type == 'edit'){
        include('wikiEdit.php');
      }
      else{
        include('wikiView.php');
      }
    }
    else{
      include('wikiView.php');
    }
  }
  else{
    if(isset($_SESSION["Login"]) && $_SESSION["Login"] == "YES"){
      include('wikiEdit.php');
    }
    else{
      include('wikiLogin.php');
    }
  }
}
else{
  header("Location: wiki.php?page=Index");
}
exit();
?>
