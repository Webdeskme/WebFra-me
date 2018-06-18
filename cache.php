<?php
session_start();
if(isset($_GET['page']) && isset($_GET['wd_no-cache'])){
  include "testInput.php";
  $page = test_input($wd_GET['page']);
  $theme = test_input($_GET['wd_no-cache']);
  include "www/Themes/" . $theme . "/default.php";
}
exit();
?>
