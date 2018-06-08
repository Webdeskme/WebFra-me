<?php include_once "../../wd_protect.php";
    if(isset($_GET['dir'])){
        $dir =  test_input($_GET['dir']);
    }
    else{
        $dir = "";
    }
    if(isset($_GET['file'])){
        $file =  test_input($_GET['file']);
    }
    else{
        $file = "";
    }
    $_SESSION["wd_copy_dir"] = $dir;
    $_SESSION["wd_copy_file"] = $file;
wd_head($wd_type, $wd_app, 'start.php', '&dir=' . $dir);
?>
