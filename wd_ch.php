<?php 
if(isset($_POST['wd_cinput'])){
  $wd_cinput = test_input($_POST['wd_cinput']);
}
if(!isset($_POST['wd_console'])){
  $wd_console = "";
}
else{
  $wd_console = htmlspecialchars_decode($_POST['wd_console'], ENT_NOQUOTES);
}
if(!isset($_POST['wd_cnum'])){
  $wd_cnum = 1;
}
else{
  $wd_cnum = $_POST['wd_cnum'];
}
if(isset($_POST['wd_cvar'])){
  $wd_cvar= $_POST['wd_cvar'];
  //wd_cvar_dump($_POST['wd_cvar']);
}
else{
  $wd_cvar = array(0 => "wd");
}
if(isset($wd_cinput) && isset($wd_cnum)){
  $wd_cvar[$wd_cnum-1] = $wd_cinput;
  $wd_console = $wd_console . '<span class="wd_cr">->' . $wd_cinput . '</span><br>';
}
function wd_cw($str, $x){
  global $wd_console;
  global $wd_cnum;
 if($wd_cnum == $x){
    return $wd_console = $wd_console . '<span class="wd_cw">->' . $str . '</span><br>';
  }
}
function wd_cr($x){
  global $wd_cvar;
 if(isset($wd_cvar[$x])){
    return $wd_cvar[$x];
  }
  else{
    return '';
  }
}
function wd_cg($str, $y, $x){
  global $wd_cnum;
  wd_cw($str, $x);
  if($wd_cnum == $x){
    return $wd_cnum = $y;
  }
}
?>
<style>
  .wd_console{
    background-color: #000000;
    color: #ffffff;
    width: 100%;
    height: 100%;
  }
  .wd_cinput{
    background-color: #000000;
    width: 100%;
    color: #ff0000;
  }
  .wd_cw{
    color: #66ff66;
  }
  .wd_cr{
    color: #ff0000;
  }
  .modal{
    box-shadow: 0 5px 5px rgba(0,0,0,0.25);
    -moz-box-shadow: 0 5px 5px rgba(0,0,0,0.25);
    -webkit-box-shadow: 0 5px 5px rgba(0,0,0,0.25);
  }
  
</style>