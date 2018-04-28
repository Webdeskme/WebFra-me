<?php
$i = 0;
$tier = test_input($_POST['tier']);
$pass = f_enc(test_input($_POST['pass']));
if(!file_exists('Temp/')){
  mkdir('Temp/');
}
$target_dir = "Temp/";
$target_file = $target_dir . 'temp.csv';
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Allow certain file formats
if($imageFileType != "csv") {
    echo "Sorry, only csv files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.<br>";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
$file = fopen($target_file,"r");
while(! feof($file))
  {
    //print_r(fgetcsv($file));
   $user[$i] = fgetcsv($file);
  $i = $i + 1;
  }
fclose($file);
unlink($target_file);
$z = 1;
while($z < $i){
  //echo $z . ': ' . $user[$z][2] . '<br>';
  $user[$z][2] = f_enc(strtolower($user[$z][2]));
  if(!file_exists($wd_root . '/User/' . $user[$z][2] . '/')){
                        mkdir($wd_root . '/User/' . $user[$z][2] . '/');
                        mkdir($wd_root . '/User/' . $user[$z][2] . '/Admin/');
                        mkdir($wd_root . '/User/' . $user[$z][2] . '/Sec/');
                        mkdir($wd_root . '/User/' . $user[$z][2] . '/Doc/');
                        mkdir($wd_root . '/User/' . $user[$z][2] . '/Web/');
                        mkdir($wd_root . '/User/' . $user[$z][2] . '/App/');
                        mkdir($wd_root . '/User/' . $user[$z][2] . '/Book/');
                        mkdir($wd_root . '/User/' . $user[$z][2] . '/Ext/');
                        $rand = file_get_contents($wd_root . '/User/' . $_SESSION['user'] . '/Admin/oid.txt');
                        $vrand = rand(10000000000000000000, 99999999999999999999);
                        $vrand = $vrand . 'abcdefghijklmnopqrstuvwxyz';
                        $vrand = str_shuffle($vrand);
                        //$vrand = file_get_contents($wd_root . 'User/' . $_SESSION['user'] . '/Admin/val.txt');
                        //$url = file_get_contents($wd_root . 'User/' . $_SESSION['user'] . '/Admin/url.txt');
                        file_put_contents($wd_root . '/User/' . $user[$z][2] .'/Admin/pass.txt', $pass);
                        file_put_contents($wd_root . '/User/' . $user[$z][2] .'/Admin/oid.txt', $rand);
                        file_put_contents($wd_root . '/User/' . $user[$z][2] .'/Admin/val.txt', $vrand);
                        file_put_contents($wd_root . '/User/' . $user[$z][2] .'/Admin/back.txt', 'back.jpg');
                        file_put_contents($wd_root . '/User/' . $user[$z][2] .'/Admin/tier.txt', $tier);
                        file_put_contents($wd_root . '/User/' . $user[$z][2] .'/Admin/color.txt', '#ffffff');
                        file_put_contents($wd_root . '/User/' . $user[$z][2] .'/Admin/Pcolor.txt', '#ffffff');
                        //file_put_contents($wd_root . '/User/' . $user[$z][2] .'/Admin/url.txt', $url);
    if(file_exists($wd_root . '/User/' . $user[$z][2] . '/Admin/info.json')){
  //$obj = file_get_contents($wd_root . 'User/' . $user[$z][2] . '/Admin/info.json');
  $obj = file_get_contents($wd_root . '/User/' . $user[$z][2] . '/Admin/info.json');
  $obj = json_decode($obj);
}
else{
  $obj = new stdClass;
}
$obj->fn = $user[$z][0];
$obj->ln = $user[$z][1];
$obj->email = $user[$z][3];
$obj->contact = $user[$z][4];
$nObj = json_encode($obj);
file_put_contents($wd_root . '/User/' . $user[$z][2] . '/Admin/info.json', $nObj);
}
  
  $z = $z + 1;
}
wd_head($wd_type, $wd_app, 'ManageUsers.php', '');
?>
