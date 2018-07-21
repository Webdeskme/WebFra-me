<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
if(isset($_GET["dir"])){$dir = test_input($_GET["dir"]);}
else{$dir = "";}
$file = test_input($_GET["file"]);
unlink($_SESSION['root'] . $dir . $file);
if($dir != ""){$dir = rtrim($dir, '/');
header('Location: desktop.php?type=Apps&app=Terminal&sec=start.php&dir=' . $dir);}
else{
header('Location: desktop.php?type=Apps&app=Terminal&sec=start.php');
}
?>
