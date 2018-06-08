<?php include_once "../../wd_protect.php";
if(isset($_GET['dir']) and isset($_POST['name'])){
$dir = test_input($_GET['dir']);
$name = test_input($_POST['name']);
mkdir($wd_file . $dir . $name);
wd_head($wd_type, $wd_app, 'start.php', '&dir=' . $dir . '&as=Created new folder');
}
else{
wd_head($wd_type, $wd_app, 'start.php', '&dir=' . $dir . '*aw=Not enough information: action canceled');
}
?>
