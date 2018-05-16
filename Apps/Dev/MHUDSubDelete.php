<?php
$nameA = test_input($_GET["MyApp"]);
$file = "MHUD/" . $nameA;
if(is_dir($file)){
    wd_deleteDir($file);
}
else{
    unlink($file);
}
wd_head($wd_type, $wd_app, 'startMhud.php', '');
?>