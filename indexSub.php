<?php
session_start();
include "testInput.php";
include "www/functions.php";
$theme = test_input(file_get_contents("www/dtheme.txt"));
if(isset($_GET['page'])){
  $page = test_input($_GET['page']);
}
else{
  $page = "";
}
if(isset($_GET['page']) && $page != "login.php"){
  if(file_exists("www/Pages/" . $page)){
    include "www/Pages/" . $page;
  }
  else{
    include "www/Themes/" . $theme . "/404.php";
  }
}
elseif(file_exists("www/Pages/index.php") && $page != "login.php"){
  header('Location: index.php?page=index.php');
}
else{
  include "www/Themes/" . $theme . "/login.php";
}
exit();
?>
