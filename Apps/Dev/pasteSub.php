<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
if(isset($_GET['MyApp'])){
        $dir =  test_input($_GET['MyApp']);
    }
    else{
        $dir = "";
    }
if(is_dir($wd_file . $_SESSION["wd_copy_dir"] . $_SESSION["wd_copy_file"])){
	wd_copy($wd_file . $_SESSION["wd_copy_dir"] . rtrim($_SESSION["wd_copy_file"], '/'), 'MyApps/' . $dir . '/' . rtrim($_SESSION["wd_copy_file"], '/'));
//mkdir('MyApps/' . $dir . '/' . rtrim($_SESSION["wd_copy_file"], '/'));
}
else{
	copy($wd_file . $_SESSION["wd_copy_dir"] . $_SESSION["wd_copy_file"], 'MyApps/' . $dir . '/' . $_SESSION["wd_copy_file"]);
}
wd_head($wd_type, $wd_app, 'MyApp.php', '&MyApp=' . $dir);
?>
