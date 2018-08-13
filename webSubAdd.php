<?php
include("protect.php");
$url = test_input($_POST["add"]);
$arr = parse_url($url);
//print_r($arr);
$ico = $arr["scheme"] . '://' . $arr["host"] . '/favicon.ico';
//echo $ico;
//echo '<image src="' . $ico . '">';
$stamp = date("dmYGisu");
//mkdir($wd_root . '/User/' . $_SESSION["user"] . '/Web/' . $stamp . '/');
file_put_contents($wd_root . '/User/' . $_SESSION["user"] . '/Web/' . $stamp . '.txt', $url);
//file_put_contents($wd_root . '/User/' . $_SESSION["user"] .'/Web/' . $stamp . '/fav.txt', $ico);
header('Location: desktop.php#tabs-2');
?>
