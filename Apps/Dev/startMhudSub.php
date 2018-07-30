<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
$nameA = test_input($_POST["nameA"]);
file_put_contents("MHUD/" . $nameA, '<?php ?>');
wd_head($wd_type, $wd_app, 'mhud.php', '&MyApp=' . $nameA);
?>
