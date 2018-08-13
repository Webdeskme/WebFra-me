<?php
if(isset($wd_protect) && $wd_protect != 'yes'){
  session_destroy();
  header('HTTP/1.1 404 Not Found');
  exit();
}
elseif(!isset($wd_protect)){
  session_destroy();
  header('HTTP/1.1 404 Not Found');
  exit();
}
?>
