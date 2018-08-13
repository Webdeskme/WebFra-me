<?php
include("protect.php");
$x = 0;
$wd_alerts = scandir($wd_root . '/User/' . $_SESSION["user"] . '/Sec/', 1);
foreach($wd_alerts as $entry){
//if ($handle = opendir($wd_root . '/User/' . $_SESSION["user"] . '/Sec/')) {
                //while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
                      $x = $x + 1;
                      $obj = file_get_contents($wd_root . '/User/' . $_SESSION["user"] . '/Sec/' . $entry);
                      $obj = json_decode($obj, true);
echo '<div class="well"><b>' . f_dec($obj['from']) . ': </b> <a href="#wd_alert' . $x . '" data-toggle="collapse">' . base64_decode($obj['sub']) . '</a> <i>' . $obj['stime'] . '</i> <a href="notfySubDelete.php?stamp=' . $entry . '"><i class="text-danger">-Dismiss</i></a><a href="#" style="float: right; color: red;">Block</a><br><div id="wd_alert' . $x . '" class="collapse">' . base64_decode($obj['post']) . '</div></div>';
}}
?>