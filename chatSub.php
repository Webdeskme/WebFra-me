<?php
include("protect.php");
$chat = test_input($_POST['chat']);
$user = f_dec($_SESSION["user"]);
$date = date("g:i a");
file_put_contents($wd_appr . "chat.txt", '<span style="color: #33cc33;">' . $user . ': </span>' . $chat . ' <i style="color: #ffff00;">-' . $date . '</i>');
exit();
?>