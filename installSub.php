<?php
session_start();
include("testInput.php");
$wd_path = "stop";
$wd_pathD = "no";
    if(file_exists("path.php")){
        //header('Location: index.php');
      if(isset($wd_roots[$_SERVER['HTTP_HOST']]) && $wd_roots[$_SERVER['HTTP_HOST']] == "NA"){
        $wd_path = "next";
      }
      else{
        header('Location: index.php');
      }
    }
	else{
      $wd_path = "next";
      $wd_pathD = "yes";
    }
if($wd_path == "next"){
$pass = test_input($_POST["password"]);
$verify = test_input($_POST["confirm"]);
if ($pass == $verify){
	$rand = rand(10000000000000000000, 99999999999999999999);
$rand = $rand . 'abcdefghijklmnopqrstuvwxyz';
$rand = str_shuffle($rand);
$arand = rand(10000000000000000000, 99999999999999999999);
$arand = $arand . 'abcdefghijklmnopqrstuvwxyz';
$arand = str_shuffle($arand);
$vrand = rand(10000000000000000000, 99999999999999999999);
$vrand = $vrand . 'abcdefghijklmnopqrstuvwxyz';
$vrand = str_shuffle($vrand);
$vfrand = rand(10000000000000000000, 99999999999999999999);
//$vfrand = $vfrand . 'abcdefghijklmnopqrstuvwxyz';
//$vfrand = str_shuffle($vfrand);
$path = test_input($_POST["path"]);
$user = f_enc(test_input($_POST['Username']));
$title = test_input($_POST['title']);
$wd_roots[$_SERVER['HTTP_HOST']] = $path;
                      	mkdir($path);
                        mkdir($path . '/Admin/');
                        file_put_contents($path . '/Admin/appWeb.txt', $arand);
	                file_put_contents($path . '/Admin/title.txt', $title);
                      	mkdir($path . '/User/');
                        mkdir($path . '/App/');
                        mkdir($path . '/User/' . $user . '/');
                        mkdir($path . '/User/' . $user . '/Admin/');
                        mkdir($path . '/User/' . $user . '/Sec/');
                        mkdir($path . '/User/' . $user . '/Doc/');
                        mkdir($path . '/User/' . $user . '/Web/');
                        mkdir($path . '/User/' . $user . '/App/');
                        mkdir($path . '/User/' . $user . '/Book/');
                        mkdir($path . '/User/' . $user . '/Ext/');
                        mkdir($path . '/Wiki/');
			mkdir($path . '/www/');
			$wwwCopy = scandir('www/Pages/');
			foreach($wwwCopy as $key => $value){
				copy('www/Pages/' . $value, $path . '/www/' . $value);
			}
                        //Temp
                        //mkdir('349y45fjfsm/7fhnsvfk340js/' . $rand .'/');
                        //Personal Personal
                        //mkdir('349y45fjfsm/vsd4792364s/' . $rand .'/');
                        //Personal Pub
                        //mkdir('349y45fjfsm/yhftg8356mjvf90/' . $rand .'/');
                        //Pub
                        mkdir('web/');
                        mkdir('web/Pub/');
                        mkdir('Pub/');
                        //Temp
                        mkdir('web/' . $rand . '/');
                        //private share
                        mkdir('web/' . $vrand . '/');
                        //App Web Files
                        mkdir('web/' . $arand . '/');
                        //file_put_contents('../../webdesk/User/' . $user .'/Admin/email.txt', t_enc($_SESSION["email"]));
                        file_put_contents($path . '/User/' . $user .'/Admin/pass.txt', up_enc($pass));
                        file_put_contents($path . '/User/' . $user .'/Admin/oid.txt', $rand);
                        file_put_contents($path . '/User/' . $user .'/Admin/back.txt', 'back.jpg');
                        file_put_contents($path . '/User/' . $user .'/Admin/val.txt', $vrad);
                        file_put_contents($path . '/User/' . $user .'/Admin/tier.txt', 'tA');
                        file_put_contents($path . '/User/' . $user .'/Admin/color.txt', '#FFFFFF');
                        file_put_contents($path . '/User/' . $user .'/Admin/Pcolor.txt', '#FFFFFF');
			if(isset($_POST['email']) && isset($_POST['SMTP']) && isset($_POST['port']) && isset($_POST['epass'])){
				$esmtp['SMTP'] = test_input($_POST['SMTP']);
				$esmtp['email'] = t_enc($_POST['email']);
				$esmtp['port'] = test_input($_POST['port']);
				$esmtp['epass'] = t_enc($_POST['epass']);
				$esmtp = json_encode($esmtp);
				file_put_contents($path . '/Admin/esmtp.json', $esmtp);
			}
  $con = "<?php return [";
  foreach($wd_roots as $key => $value){
    if($key != "default"){
     $con = $con . "'" . $key . "' => '" . $value . "', ";
    }
  }
  if($wd_pathD == "yes"){
    $con = $con . "'default' => '" . $path . "' ]; ?>";
  }
  else{
    $con = $con . "'default' => '" . $wd_roots['default'] . "' ]; ?>";
  }
                        file_put_contents('path.php', $con);
                        //file_put_contents('../../webdesk/User/' . $user .'/Admin/valf.txt', $vfrad);
                        //file_put_contents('349y45fjfsm/yhftg8356mjvf90/' . $rand .'/' . $vrad . '.php', file_get_contents(''));
                        header('Location: index.php?a=done');
                    }
else{header('Location: install.php?a=You did not confirm your password properly. Please try again.');
	}
}
?>
