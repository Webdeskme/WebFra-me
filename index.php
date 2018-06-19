<?php
session_start();
function test_input($data) {
    if (!empty($data)) {
        $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
    }
}
require_once 'Plugins/htmlpurifier/library/HTMLPurifier.auto.php';
$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);
if(isset($_POST)){
  foreach($_POST as $key => $value){
    $_POST[$key] = $purifier->purify($value);
    $wd_POST[$key] = $value;
  }
}
if(isset($_GET)){
  foreach($_GET as $key => $value){
    $_GET[$key] = $purifier->purify($value);
    $wd_GET[$key] = $value;
  }
}
if(isset($_REQUEST)){
  foreach($_REQUEST as $key => $value){
    $_REQUEST[$key] = $purifier->purify($value);
    $wd_REQUEST[$key] = $value;
  }
}
if(file_exists("path.php")){
  $wd_roots = include('path.php');
  if(isset($wd_roots[$_SERVER['HTTP_HOST']])){
    $wd_root = test_input($wd_roots[$_SERVER['HTTP_HOST']]);
  }
  else{
    $wd_root = test_input($wd_roots['default']);
  }
  $wd_www = $wd_root . '/www/';
  $theme = test_input(file_get_contents($wd_root . "/Admin/dtheme.txt"));
if($wd_roots[$_SERVER['HTTP_HOST']] != "NA" || !isset($wd_roots[$_SERVER['HTTP_HOST']]) ){
  if(isset($_GET['page'])){
    $page = test_input($_GET['page']);
  }
  else{
    $page = "index.php";
  }
  if(isset($_GET['page']) && $page != "login.php"){
    if(file_exists($wd_root . '/Cache/' . $page)){
         header("Expires: " . gmdate("D, d M Y H:i:s", time() + 86400) . " GMT");
         header("Pragma: cache");
         header("Cache-Control: public, max-age=86400");
         header("Etag: " . md5($page . filemtime($wd_root . '/Cache/' . $page)));
         $f = fopen($wd_root . '/Cache/' . $page, 'r');
         $buffer = '';
         while(!feof($f)) {
           $buffer .= fread($f, 2048);
         }
         fclose($f);
          echo $buffer;
  exit();
    }
    else{
      if(file_exists($wd_www . "404.php")){
        include $wd_www . "404.php";
      }
      elseif(file_exists("www/Themes/" . $theme . "/404.php")){
        include "www/Themes/" . $theme . "/404.php";
      }
      else{
        include "www/404.php";
      }
    }
  }
  elseif(file_exists($wd_www . "index.php") && $page != "login.php"){
    header('Location: index.php?page=index.php');
  }
  else{
    include "www/Themes/" . $theme . "/login.php";
  }
}
else{
  header('Location: install.php');
}
}
else{
  header('Location: install.php');
}
exit();
?>
