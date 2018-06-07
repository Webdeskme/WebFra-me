<?php 
session_start();
include("testInput.php");
$date1 = date("Y-m-d-h-i-sa");
$title = test_input($_POST["title"]);
$url = $_POST["task"];
$app = test_input($_POST["app"]);
$con = '<br><a href="' . $url . '"><span class="label label-default">' . $app . ':</span> <span class="text-primary">' . $title . '</span></a><br><details><summary class="text-info">Details</summary>' . $url . '<br><a href="taskSubRemove.php?file=' . $date1 . '" class="text-danger"><i>-Remove</i></a></details>';
file_put_contents($wd_root . '/User/' . $_SESSION["user"] . '/Book/' . $date1 . '.txt' , $con);
header('Location: ' . $url . '#tabs-5');
?>
