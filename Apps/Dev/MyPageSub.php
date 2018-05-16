<?php
$nameA = test_input($_POST["nameA"]);
$nameP = test_input($_POST["nameP"]);
$con = htmlspecialchars_decode($_POST["con"], ENT_QUOTES);
file_put_contents("MyApps/" . $nameA . "/" . $nameP, $con);
wd_head($wd_type, $wd_app, 'MyPage.php', '&MyApp=' . $nameA . '&MyPage=' . $nameP);
?>