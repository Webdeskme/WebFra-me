<?php
$nameA = test_input($_POST["nameA"]);
mkdir("MyApps/" . $nameA);
file_put_contents("MyApps/" . $nameA . "/start.php", '<?php ?>');
wd_head($wd_type, $wd_app, 'MyPage.php', '&MyApp=' . $nameA . '&MyPage=start.php');
?>
