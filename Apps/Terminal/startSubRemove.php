<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
$dir = test_input($_GET["dir"]);
wd_deleteDir($dir);
wd_head($wd_type, $wd_app, 'start.php', '&a=Directory Deleted');
?>
