<?php
include("protect.php");
$stamp = test_input($_GET["id"]);
unlink($wd_root . '/User/' . $_SESSION["user"] . '/Web/' . $stamp . '.txt');
//unlink($wd_root . '/User/' . $_SESSION["user"] . '/Web/' . $stamp . '/fav.txt');
//rmdir($wd_root . '/User/' . $_SESSION["user"] . '/Web/' . $stamp . '/');
header('Location: desktop.php#tabs-2');
?>
