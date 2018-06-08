<?php
$nameA = test_input($_POST["nameA"]);
mkdir("MyApps/" . $nameA);
file_put_contents("MyApps/" . $nameA . "/start.php", '<?php include_once "../../wd_protect.php"; ?>');
file_put_contents("MyApps/" . $nameA . "/header.php", '<?php include_once "../../wd_protect.php"; ?><link rel="stylesheet" href="Plugins/bootstrap/css/bootstrap.min.css">' . "\n" . '<script src="Plugins/bootstrap/js/bootstrap.min.js"></script>');
wd_head($wd_type, $wd_app, 'MyPage.php', '&MyApp=' . $nameA . '&MyPage=start.php');
?>
