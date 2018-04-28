<?php 
if(isset($_GET['title']) && isset($_GET['dir'])){
$title = test_input($_GET['title']);
$dir = test_input($_GET['dir']);
$ext = pathinfo($wd_file . $title, PATHINFO_EXTENSION);
$ext = strtolower($ext);
if($ext == 'zip'){
$zip = new ZipArchive;
$zip->open($wd_file . $title);
$zip->extractTo($wd_file .  $dir);
$zip->close();
}
}
wd_head('Apps', 'Files', 'start.php', '&dir=' . $dir);
?>