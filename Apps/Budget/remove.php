<?php 
$title = test_input($_GET['title']);
unlink($wd_appFile . 'Budget/' . $title . '.json');
wd_head($wd_type, $wd_app, 'start.php', '');
?>