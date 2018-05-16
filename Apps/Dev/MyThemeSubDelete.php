<?php
$nameA = test_input($_GET["MyApp"]);
$dir = "www/Themes/" . $nameA . "/";
wd_deleteDir($dir);
//rmdir('MyApps/' . $nameA . "/");
wd_head($wd_type, $wd_app, 'startTheme.php', '');
?>
