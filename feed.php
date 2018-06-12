<?php
header('Content-Type: application/rss+xml; charset=utf-8');
echo test_input(file_get_contents($wd_www . 'feed.xml'));
exit();
?>
