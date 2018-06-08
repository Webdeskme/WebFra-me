<?php include_once "../../wd_protect.php";
$folder = file_get_contents($wd_adminFile . 'oid.txt');
$dir=test_input($_GET["dir"]);
$file=test_input($_GET["file"]);
$temp = 'web/' . $folder . '/' . $dir . $file;
copy($wd_file . $dir . $file, $temp);
$mimet = mime_content_type($temp);
header("Content-disposition: attachment; filename=" . $file);
header("Content-type: " . $mimet);
readfile($temp);
?>
