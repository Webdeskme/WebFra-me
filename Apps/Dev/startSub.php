<?php
$nameA = test_input($_POST["nameA"]);
mkdir("MyApps/" . $nameA);
file_put_contents("MyApps/" . $nameA . "/start.php", '<?php ?>');
//header('Location: desktop.html?type=Apps&app=Dev&sec=MyPage.php&MyApp=' . $nameA . '&MyPage=start.php');
wd_head($wd_type, $wd_app, 'MyPage.php', '&MyApp=' . $nameA . '&MyPage=start.php');
?>
