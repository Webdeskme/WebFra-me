<?php
$nameA = test_input($_GET["MyApp"]);
$nameP = test_input($_GET["MyPage"]);
$file = "MyApps/" . $nameA . "/" . $nameP;
if(is_dir($file) && $nameP != ""){
    wd_deleteDir($file);
}
else{
    unlink($file);
}
wd_head($wd_type, $wd_app, 'MyApp.php', '&MyApp=' . $nameA);
?>
