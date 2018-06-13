<?php
header('Content-Type: application/rss+xml; charset=utf-8');
include "testInput.php";
echo test_input(file_get_contents($wd_www . 'feed.xml'));
exit();
?>
