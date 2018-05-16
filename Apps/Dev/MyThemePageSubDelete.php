<?php
$nameA = test_input($_GET["MyApp"]);
$nameP = test_input($_GET["MyPage"]);
$file = "www/Themes/" . $nameA . "/" . $nameP;
if(is_dir($file) && $nameP != ""){
    wd_deleteDir($file);
}
else{
    unlink($file);
}
wd_head($wd_type, $wd_app, 'MyTheme.php', '&MyApp=' . $nameA);
?>
