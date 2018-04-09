<?php
session_start();
include("testInput.php");
$stamp = test_input($_GET["stamp"]);
unlink($wd_root . '/User/' . $_SESSION["user"] . '/Sec/' . $stamp);
header('Location: desktop.php#tabs-3');
?>
