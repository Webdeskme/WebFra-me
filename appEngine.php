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
  global $wd_appr;
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
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<form method="post" action="desktop.php?type=' . $GLOBALS['wd_type'] . '&app=' . $GLOBALS['wd_app'] . '&sec=' . $GLOBALS['sec'] . '">';
  return $var;
}
function formEnd(){
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<input type="hidden" id="ae_sub" name="ae_sub" value="yes"></form>';
  echo '<div class="container">' . $GLOBALS['buffer'] . '</div>';
}
function ae_text($type, $color, $con){
  if($type == 'text'){
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<p class="text-' . $color . '">' . $con . '</p>';
  }
  elseif ($type == 'title') {
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<h1 class="text-' . $color . '">' . $con . '</h1>';
  }
  elseif ($type == 'bold') {
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<b class="text-' . $color . '">' . $con . '</b><br>';
  }
  elseif ($type == 'underline') {
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<u class="text-' . $color . '">' . $con . '</u><br>';
  }
  elseif ($type == 'italic') {
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<i class="text-' . $color . '">' . $con . '</i><br>';
  }
}
function ae_input($title, $type, $place, $icon, $con){
  if($type == 'text'){
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<div class="form-group"><label for="' . $title . '"><b>' . $place . ':</b></label><br><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text"><i class="' . $icon . '"></i></span></div><input type="text" class="form-control" id="' . $title . '" name="' . $title . '" placeholder="' . $place . '" value="' . $con . '"></div></div>';
  }
  elseif ($type == 'textbox') {
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<div class="form-group"><label for="' . $title . '"><b>' . $place . ':</b></label><br><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text"><i class="' . $icon . '"></i></span></div><textarea class="form-control" id="' . $title . '" name="' . $title . '" placeholder="' . $place . '">' . $con . '</textarea></div></div>';
  }
  elseif ($type == 'number') {
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<div class="form-group"><label for="' . $title . '"><b>' . $place . ':</b></label><br><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text"><i class="' . $icon . '"></i></span></div><input type="number" class="form-control" id="' . $title . '" name="' . $title . '" placeholder="' . $place . '" value="' . $con . '"></div></div>';
  }
  elseif ($type == 'password') {
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<div class="form-group"><label for="' . $title . '"><b>' . $place . ':</b></label><br><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text"><i class="' . $icon . '"></i></span></div><input type="password" class="form-control" id="' . $title . '" name="' . $title . '" placeholder="' . $place . '" value="' . $con . '"></div></div>';
  }
}
function ae_button($title, $test, $type, $text, $icon, $color, $path, $rpath, $con, $link){
  //echo '1. ' .$title . ' --- ' . $test . '<br><br>';
  //if($title == $test){
    //echo '2. passed test<br><br>';
    if ($type == 'save') {
      //echo '3. saved<br><br>';
      if($rpath == 'UsersFolder'){
        //echo '4. in user folder<br><br>';
        global $wd_appFile;
        file_put_contents($wd_appFile . $path, $con);
      }
      else{
        global $wd_appr;
        file_put_contents($wd_appr . $path, $con);
      }
    }
    elseif ($type == 'append') {
      if($rpath == 'UsersFolder'){
        global $wd_appFile;
        if(file_exists($wd_appFile . $path)){
          $temp = file_get_contents($wd_appFile . $path);
          $con = $con . $temp;
        }
        file_put_contents($wd_appFile . $path, $con);
      }
      else{
        global $wd_appr;
        if(file_exists($wd_appr . $path)){
          $temp = file_get_contents($wd_appr . $path);
          $con = $con . $temp;
        }
        file_put_contents($wd_appr . $path, $con);
      }
    }
    elseif ($type == 'appendTop') {
      if($rpath == 'UsersFolder'){
        global $wd_appFile;
        if(file_exists($wd_appFile . $path)){
          $temp = file_get_contents($wd_appFile . $path);
          $con = $temp . $con;
        }
        file_put_contents($wd_appFile . $path, $con);
      }
      else{
        global $wd_appr;
        if(file_exists($wd_appr . $path)){
          $temp = file_get_contents($wd_appr . $path);
          $con = $temp . $con;
        }
        file_put_contents($wd_appr . $path, $con);
      }
    }
    elseif ($type == 'delete') {
      if($rpath == 'UsersFolder'){
        global $wd_appFile;
        unlink($wd_appFile . $path);
      }
      else{
        global $wd_appr;
        unlink($wd_appr . $path);
      }
    }
    //$GLOBALS['buffer'] = $GLOBALS['buffer'] . '<script>window.location = "desktop.php?type=' . $GLOBALS['wd_type'] . '&app=' . $GLOBALS['wd_app'] . '&sec=' . $link . $GLOBALS['wd_url'] .'";</script>';
  //////}
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<button type="submit" onclick="$(' . "'" . '#ae_sub' . "'" . ').val(' . $title . ');" class="btn btn-' . $color . '"><i class="' . $icon . '"></i> ' . $text . '</button> ';
}
function ae_space($type){
  if($type == 'space'){
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<br><br>';
  }
  elseif ($type == 'line') {
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<br><hr><br>';
  }
}
function ae_link($text, $type, $link, $icon, $color){
  if($type == 'External'){
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<a href="' . $link . '" class="text-' . $color . '"><i class="' . $icon . '"></i> ' . $text . '</a><br>';
  }
  elseif ($type = 'Internal') {
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<a href="desktop.php?type=' . $GLOBALS['wd_type'] . '&app=' . $GLOBALS['wd_app'] . '&sec=' . $link . $GLOBALS['wd_url'] .'" class="text-' . $color . '"><i class="' . $icon . '"></i> ' . $text . '</a>';
  }
}
function ae_list($type, $link){
  if($type == 'ViewUserFolder'){
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
    elseif ($type == 'ViewAppFolder') {
      global $wd_appr;
      $a = scandir($wd_appr);
      $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<div class="list-group">';
      foreach ($a as $key => $value) {
        $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<a href="desktop.php?type=' . $GLOBALS['wd_type'] . '&app=' . $GLOBALS['wd_app'] . '&sec=' . $link . '&fPath=' . $key . $GLOBALS['wd_url'] .'" class="list-group-item list-group-item-action">' . $key . '</a>';
      }
      $GLOBALS['buffer'] = $GLOBALS['buffer'] . '</div>';
    }
}
function ae_upload($type, $place, $name){

}
function ae_options($title, $type, $place, $icon, $con){

}
function ae_image($type, $link){

}
function ae_ifThen(){

}
?>
<!--<script type="text/javascript">
  function ae_sub(title){
    var s = document.getElementById("ae_sub"); s.value = title;
  }
</script>-->