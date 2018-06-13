<?php
header('Content-Type: application/rss+xml; charset=utf-8');
session_start();
include "testInput.php";
eadfile($wd_www . 'feed.xml');
exit();
?>
