<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
$nameA = test_input($_POST["MyApp"]);
$nameP = test_input($_POST["MyPage"]);
$type = test_input($_POST["type"]);
$file = $type . "/" . $nameA . "/" . $nameP;
if(is_dir($file) && $nameP != ""){
    wd_deleteDir($file);
}
else{
    if(!unlink($file))
        echo "Could not remove file. Do you have permission?";
    else
        wd_head($wd_type, $wd_app, 'projectfiles.php', '&editType=' . $type . '&editApp=' . $nameA);
}

?>
