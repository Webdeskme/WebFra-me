<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
include("protect.php");
$time = date('r');

//if(file_exists($wd_appr . "chat.txt")){
$chat = file_get_contents($wd_appr . "chat.txt");
echo "data: {$chat}\n\n";
//}
flush();
?>