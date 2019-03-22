<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
include_once("config.inc.php");
include("appHeader.php");
?>

<div class="container my-5">
  <h2>Monthly Log</h2>
  <?php
  if(file_exists($wd_admin . 'fstat.txt')){
    echo file_get_contents($wd_admin . 'fstat.txt');
  }
  ?>
</div>
