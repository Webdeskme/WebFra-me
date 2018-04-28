<?php 
$tier = test_input($_POST['tier']);
$user = test_input($_POST['user']);
file_put_contents($wd_root . '/User/' . $user . '/Admin/tier.txt', $tier);
$userd = f_dec($user);
wd_head($wd_type, $wd_app, 'ManageUsers.php', '&wd_as=' . $userd . "'s tier has been changed on.");
?>