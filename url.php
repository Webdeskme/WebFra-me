<?php
include("protect.php");
$url = test_input($_POST["url"]);
file_put_contents($wd_root . '/User/' . $_SESSION["user"] . '/Admin/url.txt', $url);
header('Location: desktop.php');
?>
