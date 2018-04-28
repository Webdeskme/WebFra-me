<?php
$user = f_enc(strtolower(test_input($_POST["user"])));
$pass = up_enc(test_input($_POST["pass"]));
$tier = test_input($_POST["tier"]);
if(!file_exists($wd_root . '/User/' . $user . '/')){
                        mkdir($wd_root . '/User/' . $user . '/');
                        mkdir($wd_root . '/User/' . $user . '/Admin/');
                        mkdir($wd_root . '/User/' . $user . '/Sec/');
                        mkdir($wd_root . '/User/' . $user . '/Doc/');
                        mkdir($wd_root . '/User/' . $user . '/Web/');
                        mkdir($wd_root . '/User/' . $user . '/App/');
                        mkdir($wd_root . '/User/' . $user . '/Book/');
                        mkdir($wd_root . '/User/' . $user . '/Ext/');
                        $rand = file_get_contents($wd_root . '/User/' . $_SESSION['user'] . '/Admin/oid.txt');
                        $vrand = rand(10000000000000000000, 99999999999999999999);
                        $vrand = $vrand . 'abcdefghijklmnopqrstuvwxyz';
                        $vrand = str_shuffle($vrand);
                        //$vrand = file_get_contents($wd_root . 'User/' . $_SESSION['user'] . '/Admin/val.txt');
                        $url = file_get_contents($wd_root . 'User/' . $_SESSION['user'] . '/Admin/url.txt');
                        file_put_contents($wd_root . '/User/' . $user .'/Admin/pass.txt', $pass);
                        file_put_contents($wd_root . '/User/' . $user .'/Admin/oid.txt', $rand);
                        file_put_contents($wd_root . '/User/' . $user .'/Admin/val.txt', $vrand);
                        file_put_contents($wd_root . '/User/' . $user .'/Admin/back.txt', 'back.jpg');
                        file_put_contents($wd_root . '/User/' . $user .'/Admin/tier.txt', $tier);
                        file_put_contents($wd_root . '/User/' . $user .'/Admin/color.txt', '#ffffff');
                        file_put_contents($wd_root . '/User/' . $user .'/Admin/Pcolor.txt', '#ffffff');
                        file_put_contents($wd_root . '/User/' . $user .'/Admin/url.txt', $url);
}
wd_head($wd_type, $wd_app, 'ManageUsers.php', '&as=' . $user . ' has been created!');
 ?>
