<?php
$nameA = test_input($_POST["nameA"]);
$nameP = test_input($_POST["nameP"]);
file_put_contents("MyApps/" . $nameA . "/" . $nameP, '<?php include_once "../../wd_protect.php"; ?>');
wd_head($wd_type, $wd_app, 'MyPage.php', '&MyApp=' . $nameA . '&MyPage=' . $nameP);
?>
