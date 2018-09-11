<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
//Engine
$buffer = '';
$var = array();
$wd_appFile = $wd_appFile . $wd_app . "/";
$wd_appr = $wd_appr . $wd_app . "/";
if(!file_exists($wd_appFile)){
  mkdir($wd_appFile);
}
if(!file_exists($wd_appr)){
  mkdir($wd_appr);
}
function form(){
  global $var;
  global $wd_appFile;
  if(isset($_GET['fPath'])){
    $var['fPath'] = test_input($_GET['fPath']);
  }
  if(isset($_GET['faPath'])){
    $var['faPath'] = test_input($_GET['faPath']);
  }
  if(isset($var['fPath'])){
    if(file_exists($wd_appFile . $var['fPath'])){
      $var['fCon'] = file_get_contents($wd_appFile . $var['fPath']);
    }
    else{
      $var['fCon'] = '';
    }
  }
  else{
    $var['fCon'] = '';
  }
  if(isset($var['faPath'])){
    if(file_exists($wd_appr . $var['faPath'])){
      $var['faCon'] = file_get_contents($wd_appr . $var['faPath']);
    }
    else{
      $var['faCon'] = '';
    }
  }
  else{
    $var['faCon'] = '';
  }
  foreach ($_POST as $key => $value) {
    $var[$key] = test_input($value);
  }
  return $var;
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<form method="post" action="desktop.php?type=' . $GLOBALS['wd_type'] . '&app=' . $GLOBALS['wd_app'] . '&sec=' . $GLOBALS['sec'] . '">';
}
function formEnd(){
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '</form>';
  echo '<div class="container">' . $GLOBALS['buffer'] . '</div>';
}
function title($text){
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<h1>' . $text . '</h1>';
}
function par($text){
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<p>' . $text . '</p>';
}
function bold($text){
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<b>' . $text . '</b><br>';
}
function under($text){
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<u>' . $text . '</u><br>';
}
function italic($text){
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<b>' . $text . '</b><br>';
}
function line(){
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<br><hr><br>';
}
function alink($text, $link){
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<a href="' . $link . '">' . $text . '</a><br>';
}
function text($title, $place, $text){
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<div class="form-group"><label for="' . $title . '"><b>' . $place . ':</b></label><br><input type="text" class="form-control" id="' . $title . '" name="' . $title . '" placeholder="' . $place . '" value="' . $text . '"></div>';
}
function password($title, $place, $pass){
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<div class="form-group"><label for="' . $title . '"><b>' . $place . ':</b></label><br><input type="password" class="form-control" id="' . $title . '" name="' . $title . '" placeholder="' . $place . '" value="' . $pass . '"></div>';
}
function number($title, $place, $num){
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<div class="form-group"><label for="' . $title . '"><b>' . $place . ':</b></label><br><input type="number" class="form-control" id="' . $title . '" name="' . $title . '" placeholder="' . $place . '" value="' . $num . '"></div>';
}
function textbox($title, $place, $text){
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<div class="form-group"><label for="' . $title . '"><b>' . $place . ':</b></label><br><textarea class="form-control" id="' . $title . '" name="' . $title . '" placeholder="' . $place . '">' . $text . '</textarea></div>';
}
function submit($title, $text){
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<input type="hidden" name="' . $title . '" value="yes"><input type="submit" class="btn btn-primary" value="' . $text . '"> ';
}
function dSubmit($title, $path, $text){
  global $var;
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<input type="hidden" name="fPath" value="' . $var['fPath'] . '"><input type="hidden" name="' . $title . '" value="yes"><input type="submit" class="btn btn-danger" value="' . $text . '"> ';
  return $var;
}
function rSubmit($text){
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<input type="reset" class="btn btn-warning" value="' . $text . '"> ';
}
function save($form, $path, $con){
  if($form == 'yes'){
    global $wd_appFile;
    file_put_contents($wd_appFile . $path, $con);
  }
}
function aSave($form, $path, $con){
  if($form == 'yes'){
    global $wd_appr;
    file_put_contents($wd_appr . $path, $con);
  }
}
function append($form, $path, $con){
  if($form == 'yes'){
    global $wd_appFile;
    if(file_exists($wd_appFile . $path)){
      $temp = file_get_contents($wd_appFile . $path);
      $con = $con . $temp;
    }
    file_put_contents($wd_appFile . $path, $con);
  }
}
function aAppend($form, $path, $con){
  if($form == 'yes'){
    global $wd_appr;
    if(file_exists($wd_appr . $path)){
      $temp = file_get_contents($wd_appr . $path);
      $con = $con . $temp;
    }
    file_put_contents($wd_appr . $path, $con);
  }
}
function appendTop($form, $path, $con){
  if($form == 'yes'){
    global $wd_appFile;
    if(file_exists($wd_appFile . $path)){
      $temp = file_get_contents($wd_appFile . $path);
      $con = $temp . $con;
    }
    file_put_contents($wd_appFile . $path, $con);
  }
}
function aAppendTop($form, $path, $con){
  if($form == 'yes'){
    global $wd_appr;
    if(file_exists($wd_appr . $path)){
      $temp = file_get_contents($wd_appr . $path);
      $con = $temp . $con;
    }
    file_put_contents($wd_appr . $path, $con);
  }
}
function delete($form, $path, $link){
  if($form == 'yes'){
    global $wd_appFile;
    unlink($wd_appFile . $path);
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<script>window.location = "desktop.php?type=' . $GLOBALS['wd_type'] . '&app=' . $GLOBALS['wd_app'] . '&sec=start.php'. $GLOBALS['wd_url'] .'";</script>';
  }
}
function aDelete($form, $path, $link){
  if($form == 'yes'){
    global $wd_appr;
    unlink($wd_appr . $path);
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<script>window.location = "desktop.php?type=' . $GLOBALS['wd_type'] . '&app=' . $GLOBALS['wd_app'] . '&sec=start.php'. $GLOBALS['wd_url'] .'";</script>';
  }
}
function open($title, $path){
  global $wd_appFile;
  global $var;
  $var[$title] = test_input(file_get_contents($wd_appFile . $path));
  return $var;
}
function aOpen($title, $path){
  global $wd_appFile;
  global $var;
  $var[$title] = test_input(file_get_contents($wd_appr . $path));
  return $var;
}
function flink($text, $path, $link){
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<a href="desktop.php?type=' . $GLOBALS['wd_type'] . '&app=' . $GLOBALS['wd_app'] . '&sec=' . $link . '&fPath=' . $path . $GLOBALS['wd_url'] .'">' . $text . '</a>';
}
function falink($text, $path, $link){
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<a href="desktop.php?type=' . $GLOBALS['wd_type'] . '&app=' . $GLOBALS['wd_app'] . '&sec=' . $link . '&faPath=' . $path . $GLOBALS['wd_url'] .'">' . $text . '</a>';
}
function flist($link){
  global $wd_appFile;
  $a = scandir($wd_appFile);
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<div class="list-group">';
  foreach ($a as $key => $value) {
    if($value != '.' && $value != '..'){
    	$GLOBALS['buffer'] = $GLOBALS['buffer'] . '<a href="desktop.php?type=' . $GLOBALS['wd_type'] . '&app=' . $GLOBALS['wd_app'] . '&sec=' . $link . '&fPath=' . $value . $GLOBALS['wd_url'] .'" class="list-group-item list-group-item-action">' . $value . '</a>';
    }
  }
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '</div>';
}
function falist($link){
  global $wd_appr;
  $a = scandir($wd_appr);
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<div class="list-group">';
  foreach ($a as $key => $value) {
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<a href="desktop.php?type=' . $GLOBALS['wd_type'] . '&app=' . $GLOBALS['wd_app'] . '&sec=' . $link . '&fPath=' . $key . $GLOBALS['wd_url'] .'" class="list-group-item list-group-item-action">' . $key . '</a>';
  }
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '</div>';
}
?>
