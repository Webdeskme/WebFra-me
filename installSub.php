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
$prand = rand(10000000000000000000, 99999999999999999999);
$prand = $arand . 'abcdefghijklmnopqrstuvwxyz';
$prand = str_shuffle($arand);
//$vfrand = $vfrand . 'abcdefghijklmnopqrstuvwxyz';
//$vfrand = str_shuffle($vfrand);
$path = test_input($_POST["path"]);
$user = f_enc(strtolower(test_input($_POST['Username'])));
$title = test_input($_POST['title']);
$wd_roots[$_SERVER['HTTP_HOST']] = $path;
//file_put_contents('manifest.json', );
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
                        mkdir($path . '/Cache/');
			mkdir($path . '/www/');
      require "Plugins/php-html-css-js-minifier.php";
      function get_and_write($url, $cache_file) {
    $string = file_get_contents($url);
    $string = fn_minify_html($string);
    $f = fopen($cache_file, 'w');
	  fwrite ($f, $string, strlen($string));
	  fclose($f);
  }
			$wwwCopy = scandir('www/Pages/');
			foreach($wwwCopy as $key => $value){
        if($value != '.' && $value != '..'){
				copy('www/Pages/' . $value, $path . '/www/' . $value);
      }
			}
      foreach($wwwCopy as $key => $value){
        if($value != '.' && $value != '..' && $value != 'blog.php' && $value != 'banner.php' && $value != 'header.php' && $value != 'footer.php' && $value != 'feed.json' && $value != 'nav.json' && $value != 'contactSub.php'){
        $cache_file = $path . '/Cache/' . $value;
        $url = 'http://' . $_SERVER['HTTP_HOST'] . '/cache.php?page=' . $value . '&wd_no-cache=wd_default';
        get_and_write($url, $cache_file);
      }
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
                        $pass = up_enc($pass . $user . test_input($prand));
                        $pass = password_hash($pass, PASSWORD_DEFAULT);
                        $feed = '<?xml version="1.0" encoding="UTF-8" ?><rss version="2.0"><channel><title>' . $title . '</title><link>' . test_input($_SERVER['HTTP_HOST']) . '</link><description>Blog</description><item><title>New Site!</title><link>' . test_input($_SERVER['HTTP_HOST']) . '</link><description><![CDATA[<p>We have a new website and we can not wait for you to check it out!</p>]]></description></item></channel></rss>';
                        file_put_contents($path . '/User/' . $user .'/Admin/pass.txt', $pass);
                        file_put_contents($path . '/User/' . $user .'/Admin/oid.txt', $rand);
                        file_put_contents($path . '/User/' . $user .'/Admin/prand.txt', $prand);
                        file_put_contents($path . '/User/' . $user .'/Admin/back.txt', 'back.jpg');
                        file_put_contents($path . '/User/' . $user .'/Admin/val.txt', $vrad);
                        file_put_contents($path . '/User/' . $user .'/Admin/tier.txt', 'tA');
                        file_put_contents($path . '/User/' . $user .'/Admin/color.txt', '#FFFFFF');
                        file_put_contents($path . '/User/' . $user .'/Admin/Pcolor.txt', '#FFFFFF');
                        file_put_contents($path . '/Admin/dtheme.txt', 'wd_default');
                        file_put_contents($path . '/www/feed.xml', $feed);
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
