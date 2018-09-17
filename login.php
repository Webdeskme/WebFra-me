<?php
session_start();
include("testInput.php");

$user = f_enc(strtolower(test_input($_POST["user"])));
$prand = test_input(file_get_contents($wd_root . '/User/' . $user .'/Admin/prand.txt'));
$pass = test_input($_POST["pass"]);
$pass = up_enc($pass . $user . $prand);
$var = file_get_contents($wd_root . '/User/' . $user . '/Admin/pass.txt');
$var = test_input($var);
$type = test_input($_POST["type"]);

if(file_exists($wd_root . '/Admin/month.txt')){
  $month = file_get_contents($wd_root . '/Admin/month.txt');
}
else{
  $month = 'yes';
}
$data = f_dec($user) . ': ' . $_SERVER['REMOTE_ADDR'] . '[' . date("l jS \of F Y h:i:s A") . ']-login.php<br>';
$d = date("F");
$bp = "no";
if(file_exists($wd_root . '/User/' . $user .'/Admin/fLogin.json')){
  $json = json_decode(file_get_contents($wd_root . '/User/' . $user .'/Admin/fLogin.json'), true);
  $day = date("d");
  if($json[$day] >= 5){
    $bp = "yes";
  }
}
if($bp === "no"){
  
  if (password_verify($pass, $var) && file_exists($wd_root . '/User/' . $user . '/Admin/tier.txt')){
    session_regenerate_id();

    $_SESSION["Login"] = 'YES';
    $_SESSION["user"] = $user;
    $_SESSION["tier"] = test_input(file_get_contents($wd_root . '/User/' . $_SESSION["user"] . '/Admin/tier.txt'));

    if(!file_exists($wd_root . '/Admin/')){
        mkdir($wd_root . '/Admin/');
    }
    
    if($month == $d){
      file_put_contents($wd_root . '/Admin/LoginLog.txt', $data, FILE_APPEND);
    }
    else{
      file_put_contents($wd_root . '/Admin/month.txt', $d);
      file_put_contents($wd_root . '/Admin/LoginLog.txt', $data);
      file_put_contents($wd_root . '/Admin/LoginFLog.txt', "");
    }
    if($type == "Mobile"){
    	$_SESSION["HUD"] = "Mobile";
    }
    elseif($type == "Desktop"){
    	$_SESSION["HUD"] = "Desktop";
    }
    
    // WE DON'T UPDATE WEBFRAME THIS WAY ANYMORE
    $alert = "";
    // if($_SESSION["tier"] === "tA"){
    //   $ver = test_input(file_get_contents('update.txt'));
    //   $verN = test_input(file_get_contents('http://webdesk.me/update.txt'));
    //   if($ver === $verN){
    //     $alert = "";
    //   }
    //   else{
    // 		file_put_contents($wd_root . '/User/' . $user . '/Sec/update.txt', '<a href="update.php">Update to Version: <b>' . $verN . '</b></a>');
    // 		$alert = '?wd_ai=An update is available for your system.  Go to alerts to update.';
    // 	}
    // }
    // else{
    // 	$alert = "";
    // }
    header('Location: desktop.php' . $alert);
  }
  else {
    if($month == $d){
      file_put_contents($wd_root . '/Admin/LoginFLog.txt', $data, FILE_APPEND);
    }
    else{
      file_put_contents($wd_root . '/Admin/month.txt', $d);
      file_put_contents($wd_root . '/Admin/LoginLog.txt', "");
      file_put_contents($wd_root . '/Admin/LoginFLog.txt', $data);
    }
    if(file_exists($wd_root . '/User/' . $user .'/')){
      if(file_exists($wd_root . '/User/' . $user .'/Admin/fLogin.json')){
        if(isset($json[$day])){
          $df[$day] = $json[$day] + 1;
        }
        else{
          $df[$day] = 1;
        }
      }
      else{
        $df[$day] = 1;
      }
      $df = json_encode($df);
      file_put_contents($wd_root . '/User/' . $user .'/Admin/fLogin.json', $df);
    }
    session_destroy();
    $_SESSION["wd_ad"] = "Password/username error";
    header('Location: index.php?page=login.php');
  }
}
else{
  session_destroy();
  header('Location: index.php?page=login.php&wd_ad=Login failed do to too many attempts.');
}
?>
