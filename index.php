<?php
session_start();
include "testInput.php";
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
  function get_and_write($url, $cache_file) {
    $string = file_get_contents($url);
    $f = fopen($cache_file, 'w');
    fwrite ($f, $string, strlen($string));
    fclose($f);
    return $string;
  }

  // a function that opens and and puts the data into a single var
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

  if (file_exists($cache_file)) { // is there a cache file?
      $timedif = (time() - filemtime($cache_file)); // how old is the file?
       if ($timedif < 3600*24) { // get a new file 24 hours
          $html = read_content($cache_file); // read the content from cache
      } else { // create a new cache file
          $html = get_and_write($url, $cache_file);
      }
  } else { // no file? create a cache file
      $html = get_and_write($url, $cache_file);
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
  ?>
  <!--<h1>Webdesk not installed on this domain</h1>
  <a href="//<?php //echo $_SERVER["HTTP_HOST"] ?>/install.php">Click to install</a>-->
  <?php
}
exit();
?>
