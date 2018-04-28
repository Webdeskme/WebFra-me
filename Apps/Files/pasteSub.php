<?php
if(isset($_GET['dir'])){
        $dir =  test_input($_GET['dir']);
    }
    else{
        $dir = "";
    }
if(is_dir($wd_file . $_SESSION["wd_copy_dir"] . $_SESSION["wd_copy_file"])){
	wd_copy($wd_file . $_SESSION["wd_copy_dir"] . $_SESSION["wd_copy_file"],$wd_file . $dir . $_SESSION["wd_copy_file"]);
}
else{
	copy($wd_file . $_SESSION["wd_copy_dir"] . $_SESSION["wd_copy_file"], $wd_file . $dir . $_SESSION["wd_copy_file"]);
}
wd_head($wd_type, $wd_app, 'start.php', '&dir=' . $dir);
?>
