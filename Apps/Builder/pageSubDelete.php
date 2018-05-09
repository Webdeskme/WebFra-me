<?php 
if(isset($_GET['page'])){
  $page = test_input($_GET['page']);
  if($page != ""){
    unlink("www/Pages/" . $page);
  }
}
wd_head($wd_type, $wd_app, 'start.php', '');
?>