<?php
$nameA = test_input($_POST["nameA"]);
$nameP = test_input($_POST["nameP"]);
$con = htmlspecialchars_decode($_POST["con"], ENT_QUOTES);
file_put_contents("www/Themes/" . $nameA . "/" . $nameP, $con);
wd_head($wd_type, $wd_app, 'MyThemePage.php', '&MyApp=' . $nameA . '&MyPage=' . $nameP);
?>