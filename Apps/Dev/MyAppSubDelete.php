<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
$nameA = test_input($_GET["MyApp"]);
$dir = "MyApps/" . $nameA . "/";
wd_deleteDir($dir);
//rmdir('MyApps/' . $nameA . "/");
wd_head($wd_type, $wd_app, 'start.php', '');
?>
