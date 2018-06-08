<?php include_once "../../wd_protect.php";
$dir = test_input($_GET['dir']);
$_SESSION['wd_adminView'] = $wd_root . '/User/' . $dir . '/Doc/';
wd_head('Apps', 'Files', 'start.php', '');
?>
