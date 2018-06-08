<?php include_once "../../wd_protect.php";
$dir = test_input($_POST['dir']);
if(file_exists($wd_file . $dir)){
  if(is_dir($wd_file . $dir)){
    wd_head($wd_type, $wd_app, 'start.php', '&dir=' . $dir);
    exit();
  }
  else{
    $string = substr($dir, 0, strrpos($dir, "/"));
        wd_head($wd_type, $wd_app, 'start.php', '&dir=' . $string);
    exit();
  }
}
else{
  echo 'not valid';
}
?>
