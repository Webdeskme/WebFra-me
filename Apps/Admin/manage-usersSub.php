<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }

$request = array_merge($_POST,$_GET);
$req = array();
foreach($request as $key => $value){
	$req[$key] = (!is_array($value)) ? test_input($value) : $value;
}

if(empty($req["action"]))
	echo "Missing paramter";
else if($req["action"] == "delete"){
	
	$user = $req['user'];
	$userd = f_dec($user);
	//echo $wd_root . 'User/' . $user . '/';
	$folder = $wd_root . '/User/' . $user . '/';
	if($folder != $wd_root || $folder != $wd_root . '/User/'){
	 
	    wd_deleteDir($wd_root . '/User/' . $user . '/');
	}
	//wd_head($wd_type, $wd_app, 'manage-users.php', '&wd_as=' . urlencode($userd . "'s account has been removed."));
	
}
else if($req["action"] == "add"){
	
	$user = f_enc(strtolower($req["user"]));
	//$prand = test_input(file_get_contents($wd_root . '/User/' . $user .'/Admin/prand.txt'));
	
	$prand = rand((int)10000000000000000000, (int)99999999999999999999);
  $prand = $prand . 'abcdefghijklmnopqrstuvwxyz';
  $prand = str_shuffle($prand);
  
	$pass = up_enc(test_input($req["pass"]) . $user . $prand);
	$pass = password_hash($pass, PASSWORD_DEFAULT);
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
    file_put_contents($wd_root . '/User/' . $user .'/Admin/prand.txt', $prand);
    file_put_contents($wd_root . '/User/' . $user .'/Admin/back.txt', 'back.jpg');
    file_put_contents($wd_root . '/User/' . $user .'/Admin/tier.txt', $tier);
    file_put_contents($wd_root . '/User/' . $user .'/Admin/color.txt', '#ffffff');
    file_put_contents($wd_root . '/User/' . $user .'/Admin/Pcolor.txt', '#ffffff');
    file_put_contents($wd_root . '/User/' . $user .'/Admin/url.txt', $url);
	}
	wd_head($wd_type, $wd_app, 'manage-users.php', '&wd_as=' . urlencode($req["user"] . ' has been created!'));
	
}//add
else if($req["action"] == "resetUserPassword"){
  
  $prand = test_input(file_get_contents($wd_root . '/User/' . $req["user"] .'/Admin/prand.txt'));
  
  $pass = up_enc(test_input($req["pass"]) . $req["user"] . $prand);
	$pass = password_hash($pass, PASSWORD_DEFAULT);
	
	file_put_contents($wd_root . '/User/' . $req["user"] .'/Admin/pass.txt', $pass);
	
	wd_head($wd_type, $wd_app, 'manage-users.php', '&wd_as=' . urlencode('Password successfully changed!'));
  
}//resetUserPassword
else
	echo "Invalid function";

?>