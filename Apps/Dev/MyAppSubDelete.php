<?php
$nameA = test_input($_GET["MyApp"]);
$dir = "MyApps/" . $nameA . "/";
wd_deleteDir($dir);
//rmdir('MyApps/' . $nameA . "/");
wd_head($wd_type, $wd_app, 'start.php', '');
?>
