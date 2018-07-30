<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
$nameA = test_input($_POST["nameA"]);
$con = htmlspecialchars_decode($_POST["con"], ENT_QUOTES);
file_put_contents("MHUD/" . $nameA, $con);
wd_head($wd_type, $wd_app, 'mhud.php', '&MyApp=' . $nameA);
?>
