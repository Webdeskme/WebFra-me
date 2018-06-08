<?php include_once "../../wd_protect.php";
$pass = test_input($_POST['pass']);
$user = test_input($_POST['user']);
$passe = up_enc($pass);
$userd = f_dec($user);
file_put_contents($wd_root . 'User/' . $user . '/Admin/pass.txt', $passe);
wd_head($wd_type, $wd_app, 'ManageUsers.php', '&wd_as=' . $userd . "'s password has been changed to " . $pass . '.');
?>
