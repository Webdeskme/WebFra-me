<?php
$nameA = test_input($_GET["MyApp"]);
$dir = "MyApps/" . $nameA . "/";
wd_deleteDir($dir);
wd_head($wd_type, $wd_app, 'start.php', '');
?>
