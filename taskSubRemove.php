<?php 
session_start();
include("testInput.php");
$file= test_input($_GET["file"]);
unlink($wd_root . '/User/' . $_SESSION["user"] . '/Book/' . $file . '.txt');
header('Location: desktop.php#tabs-5');
?>
