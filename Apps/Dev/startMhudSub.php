<?php
$nameA = test_input($_POST["nameA"]);
file_put_contents("MHUD/" . $nameA, '<?php ?>');
wd_head($wd_type, $wd_app, 'mhud.php', '&MyApp=' . $nameA);
?>