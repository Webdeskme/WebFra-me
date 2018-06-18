<?php
session_start();
require "testInput.php";
if(!file_exists("path.php")){
  header('Location: install.php');
}
elseif(file_exists("path.php") && $wd_roots[$_SERVER['HTTP_HOST']] != "NA" || file_exists("path.php") && !isset($wd_roots[$_SERVER['HTTP_HOST']]) ){
  $theme = test_input(file_get_contents($wd_root . "/Admin/dtheme.txt"));
  if(isset($_GET['page'])){
    $page = test_input($_GET['page']);
  }
  else{
    $page = "";
  }
  if(isset($_GET['page']) && $page != "login.php"){
    if(file_exists($wd_www . $page)){
  function read_content($path) {
    $f = fopen($path, 'r');
    $buffer = '';
    while(!feof($f)) {
      $buffer .= fread($f, 2048);
    }
    fclose($f);
    return $buffer;
  }
  $cache_file = $wd_root . '/Cache/' . $page;
  $url = 'http://' . $_SERVER['HTTP_HOST'] . '/cache.php?page=' . $page . '&wd_no-cache=' . $theme;
  if (file_exists($cache_file)) {
         $seconds_to_cache = 86400;
         $ts = gmdate("D, d M Y H:i:s", time() + $seconds_to_cache) . " GMT";
         header("Expires: $ts");
         header("Pragma: cache");
         header("Cache-Control: public, max-age=$seconds_to_cache");
         $last_modified_time = filemtime($cache_file);
         $etag = md5($page . $last_modified_time);
         header("Etag: $etag");
          $html = read_content($cache_file);
  } else {
      include "www/Themes/" . $theme . "/default.php";
  }
  echo $html;
  exit;
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
exit();
?>
