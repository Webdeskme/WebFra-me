<?php
if(isset($wd_protect) && $wd_protect == 'yes'){
  session_destroy();
  header('Location: index.php');
  exit();
}
?>
