<?php include_once "../../wd_protect.php";
$user = test_input($_POST['user']);
$userd = f_dec($user);
//echo $wd_root . 'User/' . $user . '/';
$folder = $wd_root . '/User/' . $user . '/';
if($folder != $wd_root || $folder != $wd_root . '/User/'){
    wd_deleteDir($wd_root . '/User/' . $user . '/');
}
wd_head($wd_type, $wd_app, 'ManageUsers.php', '&wd_as=' . $userd . "'s account has been removed.");
?>
