<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
$nameA = test_input($_POST["nameA"]);
file_put_contents("HUD/" . $nameA, '<?php ?>');
wd_head($wd_type, $wd_app, 'hud.php', '&MyApp=' . $nameA);
?>
