<?php
header('Content-Type: application/rss+xml; charset=utf-8');
session_start();
include "testInput.php";
readfile($wd_www . 'feed.xml');
exit();
?>
