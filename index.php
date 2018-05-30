<?php
session_start();
$wd_protect = "yes";
if(file_exists("path.php")){
include "testInput.php";
$theme = test_input(file_get_contents("www/dtheme.txt"));
if(isset($_GET['page'])){
  $page = test_input($_GET['page']);
}
else{
  $page = "";
}
if(isset($_GET['page']) && $page != "login.php"){
  if(file_exists("www/Pages/" . $page)){
    include "www/Themes/" . $theme . "/default.php";
  }
  else{
    if(file_exists("www/Pages/404.php")){
      include "www/Pages/404.php";
    }
    elseif(file_exists("www/Themes/" . $theme . "/404.php")){
      include "www/Themes/" . $theme . "/404.php";
    }
    else{
      include "www/404.php";
    }
  }
}
elseif(file_exists("www/Pages/index.php") && $page != "login.php"){
  header('Location: index.php?page=index.php');
}
else{
  include "www/Themes/" . $theme . "/login.php";
}
}
else{
  header('Location: install.php');
}
exit();
?>
