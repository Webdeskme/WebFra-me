<?php
$nameA = test_input($_POST["nameA"]);
mkdir("www/Themes/" . $nameA);
file_put_contents("www/Themes/" . $nameA . "/default.php", '<?php ?>');
wd_head($wd_type, $wd_app, 'MyThemePage.php', '&MyApp=' . $nameA . '&MyPage=default.php');
?>
