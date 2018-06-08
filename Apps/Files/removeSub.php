<?php include_once "../../wd_protect.php";
if(isset($_GET['dir'])){
$dir = test_input($_GET['dir']);
}
else{
    $dir = "";
}
if(isset($_GET['file'])){
    $file = test_input($_GET['file']);
}
else{
    $file = "";
}
if(file_exists($wd_file . $dir . $file)){
    if(!is_dir($wd_file . $dir . $file)){
        unlink($wd_file . $dir . $file);
    }
    else{
        //rmdir($wd_file . $dir . $file);

        $dirPath = $wd_file . $dir . $file;




wd_deleteDir($dirPath);




    }
}
wd_head($wd_type, $wd_app, 'start.php', '&dir=' . $dir);
?>
