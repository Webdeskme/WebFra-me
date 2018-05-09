<?php
//session_start();
//include("testInput.php");
if(isset($_GET["dir"])){$dir = test_input($_GET["dir"]);}
else{$dir = "";}
$file = test_input($_GET["file"]);
unlink($_SESSION['root'] . $dir . $file);
if($dir != ""){$dir = rtrim($dir, '/');
header('Location: desktop.html?type=Apps&app=Terminal&sec=start.php&dir=' . $dir);}
else{
header('Location: desktop.html?type=Apps&app=Terminal&sec=start.php');
}
?>
