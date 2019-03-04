<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
//Engine
$buffer = ''; // display content
$buffer2 = ''; // processing forms
$ae_var = array();
$wd_appFile = $wd_appFile . $wd_app . "/";
$wd_appr = $wd_appr . $wd_app . "/";
$ae_var['ae_table'] = "";
$ae_var['ae_id'] = "";
$ae_var['ae_fPath'] = "";
$ae_var['ae_fCon'] = "";
$ae_var['ae_Con'] = "";
$ae_var['ae_date'] = date("Y-m-d");
$ae_var['ae_time'] = date("Y-m-d h:i:sa");
$ae_var['ae_user'] = $_SESSION["uName"];
$ae_var['ae_stamp'] = date("YmdHis") . rand(1111, 9999);
$ae_var['ae_search'] = "";
$ae_var['ae_search_col'] = "";
if(isset($_GET['ae_search'])){
  $ae_var['ae_search'] = test_input($_GET['ae_search']);
}
if(isset($_GET['ae_search_col'])){
  $ae_var['ae_search_col'] = test_input($_GET['ae_search_col']);
}
if(!file_exists($wd_appFile)){
  mkdir($wd_appFile);
}
if(!file_exists($wd_appr)){
  mkdir($wd_appr);
}
if(file_exists($wd_type . '/' . $wd_app . '/app.json')){
  $temp = file_get_contents($wd_type . '/' . $wd_app . '/app.json');
  $temp = json_decode($temp, TRUE);
  $ae_db = $temp["require"]["WH_DB"];
}
if(isset($_GET['ae_fPath'])){
    $ae_var['ae_fPath'] = test_input($_GET['ae_fPath']);
  }
if(isset($_GET['ae_faPath'])){
    $ae_var['ae_faPath'] = test_input($_GET['ae_faPath']);
  }
if(isset($_GET['ae_table'])){
    $ae_var['ae_table'] = test_input($_GET['ae_table']);
  }
elseif(isset($_POST['ae_table'])){
    $ae_var['ae_table'] = test_input($_POST['ae_table']);
  }
else{
    $ae_var['ae_table'] = $GLOBALS['sec'];
  }
if(isset($_GET['ae_id'])){
    $ae_var['ae_id'] = test_input($_GET['ae_id']);
  }
elseif(isset($_POST['ae_id'])){
  $ae_var['ae_id'] = test_input($_POST['ae_id']);
}
if(isset($ae_var['ae_fPath'])){
    if(file_exists($wd_appFile . $ae_var['ae_fPath'])){
      $ae_var['ae_fCon'] = file_get_contents($wd_appFile . $ae_var['ae_fPath']);
    }
  }
if(isset($_POST)){
  foreach ($_POST as $key => $value) {
    if($key != "ae_sub" && $key != "ae_table" && $key != "ae_id" && $key != "ae_search" && $key != "ae_search_col"){
      $ae_post[$key] = test_input($value);
      $ae_var[$key] = $ae_post[$key];
    }
  }
  //if(isset($ae_post)){print_r($ae_post);}
}
if(isset($_GET['ae_table']) && isset($_GET['ae_id'])){
  $ae_var['ae_Con'] = $wd_webHull->select_id($ae_db, $ae_var['ae_table'], $ae_var['ae_id']);
  //print_r($ae_var['ae_Con']);
  $ae_var['ae_tCon'] = $wd_webHull->select_id($ae_db, $ae_var['ae_table'], "row1");
  //print_r($ae_var['ae_tCon']);
  foreach($ae_var['ae_tCon'] as $key => $value){
    if(isset($ae_var['ae_Con'][$key])){
      $ae_var[$value] = $ae_var['ae_Con'][$key];
    }
    else{
      $ae_var[$value] = "";
    }
  }
}
elseif(isset($_POST['ae_table']) && isset($_POST['ae_id'])){
  $ae_var['ae_Con'] = $wd_webHull->select_id($ae_db, $ae_var['ae_table'], $ae_var['ae_id']);
  //print_r($ae_var['ae_Con']);
  $ae_var['ae_tCon'] = $wd_webHull->select_id($ae_db, $ae_var['ae_table'], "row1");
  //print_r($ae_var['ae_tCon']);
  foreach($ae_var['ae_tCon'] as $key => $value){
    if(isset($ae_post[$value])){
      $ae_var[$value] = $ae_post[$value];
    }
    elseif(isset($ae_var['ae_Con'][$key])){
      $ae_var[$value] = $ae_var['ae_Con'][$key];
    }
    else{
      $ae_var[$value] = "";
    }
  }
}
function form($table_name = null){
  global $ae_var;

  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<div class="wf_appEngine_app my-5"><form method="post" action="desktop.php?type=' . $GLOBALS['wd_type'] . '&app=' . $GLOBALS['wd_app'] . '&sec=' . $GLOBALS['sec'] . '">';
  
  if(isset($_GET['ae_table']) && isset($_GET['ae_id'])){
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<input type="hidden" name="ae_table" value="' . $ae_var['ae_table'] . '"><input type="hidden" name="ae_id" value="' . $ae_var['ae_id'] . '">';
  }
  elseif(isset($_POST['ae_table']) && isset($_POST['ae_id'])){
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<input type="hidden" name="ae_table" value="' . $ae_var['ae_table'] . '"><input type="hidden" name="ae_id" value="' . $ae_var['ae_id'] . '">';
  }
  
  return $ae_var;
}
function formEnd(){
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<input type="hidden" id="ae_sub" name="ae_sub" value="yes"></form></div>';
  echo '<div class="container">' . $GLOBALS['buffer'] . '</div>';
}
function set_total_functions($num){
  return true;
}
function ae_text($type, $color, $con = '"'){
  
  $con = htmlspecialchars_decode($con);
  
  switch($type){
    
    case "title":
      $GLOBALS['buffer'] .= '<h1 class="display-3 text-' . $color . '">' . $con . '</h1>';
      break;
    case "heading1":
      $GLOBALS['buffer'] .= '<h1 class="text-' . $color . '">' . $con . '</h1>';
      break;
    case "heading2":
      $GLOBALS['buffer'] .= '<h3 class="text-' . $color . '">' . $con . '</h3>';
      break;
    default:
      $GLOBALS['buffer'] .= '<p class="text-' . $color . '">' . $con . '</p>';
      break;
      
  }
  
}
function ae_input($title, $type, $place, $icon, $con){
  if($type == 'text'){
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<div class="form-group"><label for="' . $title . '"><b>' . $place . ':</b></label><br><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text"><i class="' . $icon . '"></i></span></div><input type="text" class="form-control" id="' . $title . '" name="' . $title . '" placeholder="' . $place . '" value="' . $con . '"></div></div>';
  }
  elseif ($type == 'textbox') {
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<div class="form-group"><label for="' . $title . '"><b>' . $place . ':</b></label><br><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text"><i class="' . $icon . '"></i></span></div><textarea rows="10" class="form-control" id="' . $title . '" name="' . $title . '" placeholder="' . $place . '">' . $con . '</textarea></div></div>';
  }
  elseif ($type == 'number') {
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<div class="form-group"><label for="' . $title . '"><b>' . $place . ':</b></label><br><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text"><i class="' . $icon . '"></i></span></div><input type="number" class="form-control" id="' . $title . '" name="' . $title . '" placeholder="' . $place . '" value="' . $con . '"></div></div>';
  }
  elseif ($type == 'password') {
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<div class="form-group"><label for="' . $title . '"><b>' . $place . ':</b></label><br><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text"><i class="' . $icon . '"></i></span></div><input type="password" class="form-control" id="' . $title . '" name="' . $title . '" placeholder="' . $place . '" value="' . $con . '"></div></div>';
  }
  elseif ($type == 'vb_hidden') {
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<input type="hidden" name="' . $title . '" value="ae_vb">';
  }
  elseif ($type == 'hidden') {
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<input type="hidden" name="' . $title . '" value="' . $con . '">';
  }
}
function ae_button($title, $type, $text, $icon, $color, $id, $table, $link){
	global $ae_var;
  global $wd_root;
  global $ae_db;
  global $ae_post;
  global $wd_webHull;
  global $ae_vb;
  $new_table = "";
  $new_id = "";
  if($table != ""){
    $new_table = $table;
  }
  elseif($ae_var["ae_table"] != ""){
    $new_table = $ae_var["ae_table"];
  }
  else{
    $new_table = $GLOBALS['sec'];
  }
  //echo $new_table;
  if($id != ""){
    $new_id = $id;
  }
  elseif($ae_var["ae_id"] != ""){
    $new_id = $ae_var["ae_id"];
  }
  else{
    $new_id = "";
  }
  /*if(!file_exists($wd_root . '/WebHull/' . $ae_db . "/" . $new_table . ".json")){
    if(isset($ae_post)){
      $tcon = "";
  foreach ($ae_post as $key => $value) {
    $key = str_replace(",","&#44;", $key);
    $tcon = $tcon . $key . ",";
  }
      $tcon = rtrim($tcon, ',');
      $wd_webHull->create_table($ae_db, $new_table, $tcon);
}
  }*/
  if(file_exists($wd_root . '/WebHull/' . $ae_db . "/" . $new_table . ".json")){
    $data = json_decode(file_get_contents($wd_root . '/WebHull/' . $ae_db . "/" . $new_table . ".json"), TRUE);
  }
  //echo '1. ' .$title . ' --- ' . $test . '<br><br>';
  //if($title == $test){
    if ($type == 'save') {
      if($ae_post != ""){
      if($new_table != ""){
        $con = "";
  foreach ($ae_post as $key => $value) {
    $z = 1;
    if(isset($data["row1"])){
    foreach ($data["row1"] as $key2 => $value2){
      if($value2 == $key){
        $z = 2;
      }
    }
    }
    if($z === 1){
      if(file_exists($wd_root . '/WebHull/' . $ae_db . "/" . $new_table . ".json")){
        $wd_webHull->add_col($ae_db, $new_table, $key);
        $data = json_decode(file_get_contents($wd_root . '/WebHull/' . $ae_db . "/" . $new_table . ".json"), TRUE);
      }
      else{
        $wd_webHull->create_table($ae_db, $new_table, 'ae_user,' . $key);
        $data = json_decode(file_get_contents($wd_root . '/WebHull/' . $ae_db . "/" . $new_table . ".json"), TRUE);
      }
    }
    //$value = str_replace(",","&#44;", $value);
    //$con = $con . $value . ",";
  }
        $ae_post["ae_user"] = $_SESSION["user"];
  foreach ($data["row1"] as $key2 => $value2){
    if(isset($ae_post[$value2])){
      if($ae_post[$value2] == "ae_vb" && isset($ae_vb[$value2])){
        $ae_post[$value2] = $ae_vb[$value2];
      }
      $v = str_replace(",","&#44;", $ae_post[$value2]);
      $con = $con . $v . ",";
    }
    else{
      /// fix this -- add a check for existence
      
      
      
      ////////////////
      if(isset($data[$new_id][$key2])){
        $con = $con . $data[$new_id][$key2] . ",";
      }
      else{
      $con = $con . "NA,";
      }
    }
  }
     $con = rtrim($con, ',');
		if($new_id != ""){
          $wd_webHull->update_id($ae_db, $new_table, $new_id, $con);
    	}
      else{
        $wd_webHull->insert_data($ae_db, $new_table, $con);
      }
      }
    }
      $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<input type="hidden" name="ae_table" value="' . $new_table . '"><button type="submit" onclick="" class="btn btn-' . $color . '"><i class="' . $icon . '"></i> ' . $text . '</button> ';
}
    /*elseif ($type == 'append') {

      $temp = $wd_webHull->select_row($db, $GLOBAL["table_name"], $id);

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
    }*/
    elseif ($type == 'delete') {
      //$wd_webHull->delete_data($ae_db, $new_table, $new_id);
      $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<a href="desktopSub.php?type=' . $GLOBALS['wd_type'] . '&app=' . $GLOBALS['wd_app'] . '&sec=deleteSub.php&table=' . $new_table . '&id=' . $new_id . '&ae_link=' . $link . '" type="button" onclick="" class="btn btn-' . $color . '" style="color:#ffffff;"><i class="' . $icon . '"></i> ' . $text . '</a> ';
    }
    //$GLOBALS['buffer'] = $GLOBALS['buffer'] . '<input type="hidden" id="ae_sub" name="ae_sub" value="' . $type . '">';
    //$GLOBALS['buffer'] = $GLOBALS['buffer'] . '<script>window.location = "desktop.php?type=' . $GLOBALS['wd_type'] . '&app=' . $GLOBALS['wd_app'] . '&sec=' . $link . $GLOBALS['wd_url'] .'";</script>';
  //}
  
  // THIS ONE IS CORRECT
  //$GLOBALS['buffer'] = $GLOBALS['buffer'] . '<button type="submit" onclick="" class="btn btn-' . $color . '"><i class="' . $icon . '"></i> ' . $text . '</button> ';
}
function ae_space($type){
  if($type == 'space'){
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<br><br>';
  }
  elseif ($type == 'line') {
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<br><hr><br>';
  }
}
function ae_link($type, $text, $link, $icon, $color){
  if($type == 'External'){
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<a href="' . $link . '" class="text-' . $color . '" target="_blank"><i class="' . $icon . '"></i> ' . $text . '</a><br>';
  }
  elseif ($type == 'Internal') {
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<a href="desktop.php?type=' . $GLOBALS['wd_type'] . '&app=' . $GLOBALS['wd_app'] . '&sec=' . $link . $GLOBALS['wd_url'] .'" class="text-' . $color . '"><i class="' . $icon . '"></i> ' . $text . '</a>';
  }
}
function ae_list($type, $table, $col, $link){
  global $ae_var;
  global $wd_root;
  global $ae_db;
  global $wd_webHull;
    if($type == 'file' || $type == 'fDelete'){
      global $wd_appr;
      $a = scandir($wd_appr);
      $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<div class="list-group">';
      foreach ($a as $key => $value) {
        if($value != '.' && $value != '..'){
          if($type == 'file'){
        $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<a href="desktop.php?type=' . $GLOBALS['wd_type'] . '&app=' . $GLOBALS['wd_app'] . '&sec=viewSub.php&ftype=AppFolder&fPath=' . $value . $GLOBALS['wd_url'] .'" class="list-group-item list-group-item-action" target="_blank">' . $value . '</a>';
          }
          elseif($type == 'fDelete'){
            $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<a href="desktopSub.php?type=' . $GLOBALS['wd_type'] . '&app=' . $GLOBALS['wd_app'] . '&sec=deleteSub.php&ftype=AppFolder&fPath=' . $value . '&ae_link=' . $link . $GLOBALS['wd_url'] . '" class="list-group-item list-group-item-action">' . $value . '</a> ';
          }
        }
      }
      $GLOBALS['buffer'] = $GLOBALS['buffer'] . '</div>';
    }
  else{
  if(file_exists($wd_root . '/WebHull/' . $ae_db . "/" . $table . ".json")){
  $a = $wd_webHull->select_row($ae_db, $table, $col);
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<div class="list-group">';
    foreach ($a as $key => $value) {
      if($value != '.' && $value != '..' && $key != "row1" && $key != "ae_user"){
        if($type == 'delete'){
          $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<a href="desktopSub.php?type=' . $GLOBALS['wd_type'] . '&app=' . $GLOBALS['wd_app'] . '&sec=deleteSub.php&table=' . $table . '&id=' . $key . '&ae_link=' . $link . '" class="list-group-item list-group-item-action">' . $value . '</a> ';
        }
        else{
    	   $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<a href="desktop.php?type=' . $GLOBALS['wd_type'] . '&app=' . $GLOBALS['wd_app'] . '&sec=' . $link . '&ae_table=' . $table . '&ae_id=' . $key . $GLOBALS['wd_url'] .'" class="list-group-item list-group-item-action">' . $value . '</a>';
        }
        }
      }
      $GLOBALS['buffer'] = $GLOBALS['buffer'] . '</div>';
  }
  }
}
function ae_ulist($type, $table, $col, $link){
  global $ae_var;
  global $wd_root;
  global $ae_db;
  global $wd_webHull;
  if($type == 'file' || $type == 'fDelete'){
      global $wd_appFile;
    $a = scandir($wd_appFile);
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<div class="list-group">';
    foreach ($a as $key => $value) {
      if($value != '.' && $value != '..'){
        if($type == 'file'){
    	   $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<a href="desktop.php?type=' . $GLOBALS['wd_type'] . '&app=' . $GLOBALS['wd_app'] . '&sec=viewSub.php&ftype=UserFolder&fPath=' . $value . $GLOBALS['wd_url'] .'" class="list-group-item list-group-item-action" target="_blank">' . $value . '</a>';
        }
        elseif($type == 'fDelete'){
          $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<a href="desktopSub.php?type=' . $GLOBALS['wd_type'] . '&app=' . $GLOBALS['wd_app'] . '&sec=deleteSub.php&ftype=UserFolder&fPath=' . $value . '&ae_link=' . $link . $GLOBALS['wd_url'] . '" class="list-group-item list-group-item-action">' . $value . '</a> ';
        }
        }
      }
      $GLOBALS['buffer'] = $GLOBALS['buffer'] . '</div>';
    }
  else{
  if(file_exists($wd_root . '/WebHull/' . $ae_db . "/" . $table . ".json")){
    $data = json_decode(file_get_contents($wd_root . '/WebHull/' . $ae_db . "/" . $table . ".json"), TRUE);
  $a = $wd_webHull->select_row($ae_db, $table, $col);
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<div class="list-group">';
    
    foreach ($a as $key => $value) {
      if(trim($data[$key][0]) === trim($_SESSION["user"])){
      if($value != '.' && $value != '..' && $key != "row1" && $key != "ae_user"){
        if($type == 'delete'){
          $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<a href="desktopSub.php?type=' . $GLOBALS['wd_type'] . '&app=' . $GLOBALS['wd_app'] . '&sec=deleteSub.php&table=' . $table . '&id=' . $key . '&ae_link=' . $link . '" class="list-group-item list-group-item-action">' . $value . '</a> ';
        }
        else{
    	   $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<a href="desktop.php?type=' . $GLOBALS['wd_type'] . '&app=' . $GLOBALS['wd_app'] . '&sec=' . $link . '&ae_table=' . $table . '&ae_id=' . $key . $GLOBALS['wd_url'] .'" class="list-group-item list-group-item-action">' . $value . '</a>';
        }
        }
    }
      }
      $GLOBALS['buffer'] = $GLOBALS['buffer'] . '</div>';
  }
}
}
function ae_upload($type, $link){
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<form action="desktopSub.php?type=' . $GLOBALS['wd_type'] . '&app=' . $GLOBALS['wd_app'] . '&sec=uploadSub.php&ae_type=' . $type . '&ae_link=' . $link . '" method="post" enctype="multipart/form-data">Select image to upload:<input type="file" name="fileToUpload" id="fileToUpload"><input type="submit" class="btn btn-success" value="Upload Image" name="submit"></form>';
}
function ae_options($type, $title, $label, $con){
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<div class="form-group"><label for="' . $title . '"><b>' . $label . ':</b></label>';
  if($type == "list"){
    global $ae_db;
    global $wd_webHull;
    global $ae_var;
    global $wd_root;
    if(file_exists($wd_root . '/WebHull/' . $ae_db . "/" . $ae_var['ae_table'] . ".json")){
  $a = $wd_webHull->select_row($ae_db, $ae_var['ae_table'], $con);
      $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<select class="form-control" id="' . $title . '" name="ae_id">';
    foreach ($a as $key => $value) {
      if($value != '.' && $value != '..' && $key != "row1" && $key != "ae_user"){
        $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<option value="' . $key . '">' . $value . '</option>';
        }
      }
      $GLOBALS['buffer'] = $GLOBALS['buffer'] . '</select><input type="hidden" name="ae_table" value="' . $ae_var['ae_table'] . '">';
  }
  }
  elseif($type == "ulist"){
    global $ae_db;
    global $wd_webHull;
    global $ae_var;
    global $wd_root;
    if(file_exists($wd_root . '/WebHull/' . $ae_db . "/" . $ae_var['ae_table'] . ".json")){
  $a = $wd_webHull->select_row($ae_db, $ae_var['ae_table'], $con);
      $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<select class="form-control" id="' . $title . '" name="ae_id">';
    foreach ($a as $key => $value) {
      if($value != '.' && $value != '..' && $key != "row1" && $key != "ae_user"){
        if(trim($a[$key][0]) === trim($_SESSION["user"])){
          $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<option value="' . $key . '">' . $value . '</option>';
        }
        }
      }
      $GLOBALS['buffer'] = $GLOBALS['buffer'] . '</select><input type="hidden" name="ae_table" value="' . $ae_var['ae_table'] . '">';
  }
  }
  else{
  //$con = str_replace(",","&#44;", $con);
  $op = explode(",", $con);
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<select class="form-control" id="' . $title . '" name="' . $title . '">';
  foreach($op as $value){
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<option value="' . $value . '">' . $value . '</option>';
  }
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '</select>';
  }
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '</div>';
}
function ae_image($type, $path, $alt, $width, $link){
	if($type == 'UserFolder'){
      global $wd_appFile;
      $imageData = base64_encode(file_get_contents($wd_appFile . $path));
    $src = 'data: '.mime_content_type($wd_appFile . $path).';base64,'.$imageData;
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<a href="' . $link . '" target="_blank"><img src="' . $src . '" alt="' . $alt . '" style="width:' . $width . '"></a>';
  }
  elseif ($type == 'AppFolder') {
    global $wd_appr;
    $imageData = base64_encode(file_get_contents($wd_appr . $path));
    $src = 'data: '.mime_content_type($wd_appr . $path).';base64,'.$imageData;
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<a href="' . $link . '" target="_blank"><img src="' . $src . '" alt="' . $alt . '"></a>';
  }
}
function ae_table($type, $table, $order, $link){
  global $ae_db;
  global $wd_webHull;
  $order = (int)$order;
  $show = $wd_webHull->select_table($ae_db, $table, $order);
  if($show != 'Error: Table does not exists.'){
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<br><table class="table table-striped"><thead><tr><th>#</th>';
  $z = 0;
  foreach($show['row1'] as $key => $value){
    $z = $z + 1;
    if($value != 'ae_user'){
      $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<th>' . $value . '</th>';
    }
  }
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '</tr></thead><tbody>';
  $x = 0;
  foreach($show as $key => $value){
    if($key != 'row1'){
      $x = $x + 1;
      if($type == 'goto'){
        $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<tr><td><a href="desktop.php?type=' . $GLOBALS['wd_type'] . '&app=' . $GLOBALS['wd_app'] . '&sec=' . $link . '&ae_table=' . $table . '&ae_id=' . $key . $GLOBALS['wd_url'] . '">' . $x . '</a></td>';
      }
      elseif($type == 'delete'){
        $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<tr><td><a href="desktopSub.php?type=' . $GLOBALS['wd_type'] . '&app=' . $GLOBALS['wd_app'] . '&sec=deleteSub.php&table=' . $table . '&id=' . $key . '&ae_link=' . $link . $GLOBALS['wd_url'] . '">' . $x . '</a></td>';
      }
      else{
        $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<tr><td>' . $x . '</td>';
      }
      foreach($show[$key] as $key1 => $value1){
        if($key1 != 0){
        $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<td>' . $value1 . '</td>';
        }
      }
      $GLOBALS['buffer'] = $GLOBALS['buffer'] . '</tr>';
    }
  }
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '</tbody></table><br>';
  }
}
function ae_utable($type, $table, $order, $link){
  global $ae_db;
  global $wd_webHull;
  $order = (int)$order;
  $show = $wd_webHull->select_table($ae_db, $table, $order);
  if($show != 'Error: Table does not exists.'){
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<br><table class="table table-striped"><thead><tr><th>#</th>';
  $z = 0;
  foreach($show['row1'] as $key => $value){
    $z = $z + 1;
    if($value != 'ae_user'){
      $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<th>' . $value . '</th>';
    }
  }
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '</tr></thead><tbody>';
  $x = 0;
  foreach($show as $key => $value){
    if($key != 'row1'){//
      if(trim($show[$key][0]) === trim($_SESSION["user"])){
      $x = $x + 1;
      if($type == 'goto'){
        $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<tr><td><a href="desktop.php?type=' . $GLOBALS['wd_type'] . '&app=' . $GLOBALS['wd_app'] . '&sec=' . $link . '&ae_table=' . $table . '&ae_id=' . $key . $GLOBALS['wd_url'] . '">' . $x . '</a></td>';
      }
      elseif($type == 'delete'){
        $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<tr><td><a href="desktopSub.php?type=' . $GLOBALS['wd_type'] . '&app=' . $GLOBALS['wd_app'] . '&sec=deleteSub.php&table=' . $table . '&id=' . $key . '&ae_link=' . $link . $GLOBALS['wd_url'] . '">' . $x . '</a></td>';
      }
      else{
        $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<tr><td>' . $x . '</td>';
      }
      foreach($show[$key] as $key1 => $value1){
        if($key1 != 0){
        $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<td>' . $value1 . '</td>';
        }
      }
      $GLOBALS['buffer'] = $GLOBALS['buffer'] . '</tr>';
    }
    }
  }
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '</tbody></table><br>';
  }
}
function ae_ifThen($var1, $var2, $pos, $con){
  if($var1 != $var2){
    $con;
  }
  else{
    $pos;
  }
}
function ae_stringRe($org, $new, $string){
  $out = str_replace($org,$new,$string);
  return $out;
}
function search($type, $table, $link){
  global $ae_db;
  global $wd_webHull;
  global $ae_var;
  //$show = $wd_webHull->search_row($ae_db, $table, $ae_var["ae_search_col"], $ae_var['ae_search']);
  //if($show != 'Error: Table does not exists.'){
  $c = $wd_webHull->select_id($ae_db, $table, "row1");
  if($c != 'Error: Table does not exists.'){
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<br><form method="get" action="desktop.php?type=' . $GLOBALS['wd_type'] . '&app=' . $GLOBALS['wd_app'] . '&sec=' . $GLOBALS['sec'] . '"><input type="text" name="ae_search" placeholder="Add Seach Term"><select name="ae_search_col">'; 
    foreach($c as $key => $value){
      if($value != "ae_user"){
        $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<option value="' . $value . '">' . $value . '</option>';
      }
    }
    $GLOBALS['buffer'] = $GLOBALS['buffer'] . '</select><input type="submit" value="Search" class="btn btn-primary"><input type="hidden" name="type" value="' . $GLOBALS['type'] . '"><input type="hidden" name="app" value="' . $GLOBALS['app'] . '"><input type="hidden" name="sec" value="' . $GLOBALS['sec'] . '"></form>';
  }
  if($ae_var['ae_search'] != "" &&  $ae_var["ae_search_col"] != ""){
    $show = $wd_webHull->search_row($ae_db, $table, $ae_var["ae_search_col"], $ae_var['ae_search']);
  if($show != 'Error: Table does not exists.'){
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<br><table class="table table-striped"><thead><tr><th>#</th>';
  $z = 0;
  foreach($show['row1'] as $key => $value){
    $z = $z + 1;
    if($value != 'ae_user'){
      $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<th>' . $value . '</th>';
    }
  }
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '</tr></thead><tbody>';
  $x = 0;
  foreach($show as $key => $value){
    if($key != 'row1'){
      $x = $x + 1;
      if($type == 'goto'){
        $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<tr><td><a href="desktop.php?type=' . $GLOBALS['wd_type'] . '&app=' . $GLOBALS['wd_app'] . '&sec=' . $link . '&ae_table=' . $table . '&ae_id=' . $key . $GLOBALS['wd_url'] . '">' . $x . '</a></td>';
      }
      elseif($type == 'delete'){
        $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<tr><td><a href="desktopSub.php?type=' . $GLOBALS['wd_type'] . '&app=' . $GLOBALS['wd_app'] . '&sec=deleteSub.php&table=' . $table . '&id=' . $key . '&ae_link=' . $link . $GLOBALS['wd_url'] . '">' . $x . '</a></td>';
      }
      else{
        $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<tr><td>' . $x . '</td>';
      }
      foreach($show[$key] as $key1 => $value1){
        if($key1 != 0){
        $GLOBALS['buffer'] = $GLOBALS['buffer'] . '<td>' . $value1 . '</td>';
        }
      }
      $GLOBALS['buffer'] = $GLOBALS['buffer'] . '</tr>';
    }
  }
  $GLOBALS['buffer'] = $GLOBALS['buffer'] . '</tbody></table><br>';
  }
}
}
?>
