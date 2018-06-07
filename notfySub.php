<?php
session_start();
include("testInput.php");
//$post = test_input($_POST["post"]);
$post = base64_encode($_POST["post"]);
$sub = base64_encode(test_input($_POST["sub"]));
$time = date("Y-m-d[h:i.sa]");
$user = f_enc(test_input($_POST["user"]));
$date=date_create();
$stamp = date_timestamp_get($date);
$j->id = $stamp;
$j->from = $_SESSION["user"];
$j->to = $user;
$j->stime = $time;
$j->sub = $sub;
$j->post = $post;
$json = json_encode($j);
file_put_contents($wd_root . '/User/' . $user . '/Sec/' . $stamp . '.json', $json);
header('Location: desktop.php#tabs-3');
?>
