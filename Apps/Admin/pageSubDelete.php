<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
if(isset($_GET['page'])){
  $page = test_input($_GET['page']);
  if($page != ""){
    unlink("www/Pages/" . $page);
  }
}
wd_head($wd_type, $wd_app, 'start.php', '');
?>
