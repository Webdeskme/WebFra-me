<?php
$wf_protect = "yes";
$_SESSION['wf_home'] = 'desktop.php';
function wf_test_input($data) {
    if (!empty($data)) {
        $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
    }
}
require_once 'Plugins/htmlpurifier/library/HTMLPurifier.auto.php';
$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);
if(isset($_POST)){
  foreach($_POST as $key => $value){
    $_POST[$key] = $purifier->purify($value);
    $wf_POST[$key] = $value;
  }
}
if(isset($_GET)){
  foreach($_GET as $key => $value){
    $_GET[$key] = $purifier->purify($value);
    $wf_GET[$key] = $value;
  }
}
if(isset($_REQUEST)){
  foreach($_REQUEST as $key => $value){
    $_REQUEST[$key] = $purifier->purify($value);
    $wf_REQUEST[$key] = $value;
  }
}
function wf_f_enc($data) {
    if (!empty($data)) {
        $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   $data = str_replace(" ", "", $data);
   $data = preg_replace("/\s+/", "", $data);
   $data = strtolower($data);
   $data = strrev($data);
   $data = str_rot13($data);
   return $data;
    }
}
function wf_f_dec($data) {
    if (!empty($data)) {
        $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   $data = str_replace(" ", "", $data);
   $data = preg_replace("/\s+/", "", $data);
   $data = strtolower($data);
   $data = str_rot13($data);
   $data = strrev($data);
   return $data;
    }
}
function wf_t_enc($data) {
    if (!empty($data)) {
        $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   $data = str_replace(" ", "", $data);
   $data = preg_replace("/\s+/", "", $data);
   $data = strrev($data);
   $data = str_rot13($data);
   $data = base64_encode($data);
   return $data;
    }
}
function wf_t_dec($data) {
    if (!empty($data)) {
        $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   $data = str_replace(" ", "", $data);
   $data = preg_replace("/\s+/", "", $data);
   $data = base64_decode($data);
   $data = str_rot13($data);
   $data = strrev($data);
   return $data;
    }
}
function wf_up_enc($data) {
    if (!empty($data)) {
        $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   $data = str_replace(" ", "", $data);
   $data = preg_replace("/\s+/", "", $data);
   $data = str_rot13($data);
   $data = strrev($data);
   //$data = password_hash($data, PASSWORD_DEFAULT);
   $data = md5($data);
   return $data;
    }
}
//Functions
if(isset($_GET['adminView']) && isset($_SESSION['wf_adminView'])){
  unset($_SESSION['wf_adminView']);
}
$wf_root = "NA1";
$wf_roots = array();
if(file_exists("path.php") || file_exists("../../path.php")){
  if(file_exists("path.php"))
    include('path.php');
  else
    include("../../path.php");
  
  if(isset($wf_roots[$_SERVER['HTTP_HOST']])){
    $wf_root = wf_test_input($wf_roots[$_SERVER['HTTP_HOST']]);
  }
  else{
    $wf_root = wf_test_input($wf_roots['default']);
  }
  $wf_pcolor = "#FFFFFF";
  if(isset($_SESSION["user"])){
  $wf_back = file_get_contents($wf_root . '/User/' . $_SESSION["user"] . '/Admin/back.txt');
  $wf_color = file_get_contents($wf_root . '/User/' . $_SESSION["user"] . '/Admin/color.txt');
  $wf_file = $wf_root . '/User/' . $_SESSION["user"] . '/Doc/';
  $wf_appFile = $wf_root . '/User/' . $_SESSION["user"] . '/App/';
  $wf_adminFile = $wf_root . '/User/' . $_SESSION["user"] . '/Admin/';
  $wf_extFile = $wf_root . '/User/' . $_SESSION["user"] . '/Ext/';
  $wf_tier = wf_test_input(file_get_contents($wf_adminFile . 'tier.txt'));
  }
  $wf_admin = $wf_root . '/Admin/';
  $wf_appr = $wf_root . '/App/';
  $wf_appDir = $wf_appr;
  if(!empty($_GET["type"]) && !empty($_GET["app"]))
    $wf_appDir .= wf_test_input($_GET["type"])."/".wf_test_input($_GET["app"])."/";
    
  $wf_www = $wf_root . '/www/';
  if(file_exists($wf_admin . 'title.txt')){
    $wf_Title = file_get_contents($wf_admin . 'title.txt');
  }
  function get_number_of_user_alerts(){
  global $wf_root;
  $wf = 0;
  if ($handle = opendir($wf_root . '/User/' . $_SESSION["user"] . '/Sec/')) {
    while (false !== ($entry = readdir($handle))) {
      if ($entry != "." && $entry != "..") {
      $wf = $wf + 1;
      }
    }
  }
  return $wf;
}
  if(isset($_GET['type'])){
  	$wf_type = wf_test_input($_GET['type']);
  }
  else{
  	$wf_type = "";
  }
  if(isset($_GET['app'])){
  	$wf_app = wf_test_input($_GET['app']);
  }
  else{
  	$wf_app = "";
  }
  if(isset($_GET['link'])){
    $urllink = wf_test_input($_GET['link']);
    $link = explode('-', $urllink);
    if($wf_appr . $wf_app . '/' . $link[0] . '.json'){
      $obj = file_get_contents($wf_appr . 'Link/' . $link[0] . '.json');
      $obj = json_decode($obj);
      if($obj->pass == $link[1] && $obj->type != "hide"){
        if($obj->type != "up"){
        $wf_file = $wf_root . '/User/' . $obj->user . '/Doc/' . $obj->dirpath;
        }
        else{
          header("Location: desktop.php?type=Apps&app=Files&sec=up.php" . $GLOBALS['wf_url']);
      //return $wf_head;
      exit();
        }
      }
    }
  }
  if(isset($_GET['link'])){
    $GLOBALS['wf_url'] = '&link=' . $urllink;
  }
  else{
    $GLOBALS['wf_url'] = "";
  }
  function wf_url($wf_type, $app, $sec = 'start.php', $get = '') {
      echo $url = "desktop.php?type=" . $wf_type . "&app=" . $app . "&sec=" . $sec . $get . $GLOBALS['wf_url'];
     // return $url;
  }
  function wf_www($wf_page, $get) {
      echo $url = "index.php?page=" . $wf_page . $get . $GLOBALS['wf_url'];
     // return $url;
  }
  function wf_web($wf_type, $app, $sec, $get) {
      echo $url = "web.php?type=" . $wf_type . "&app=" . $app . "&sec=" . $sec . $get . $GLOBALS['wf_url'];
     // return $url;
  }
  function wf_var($wf_type, $app, $sec, $get) {
      $url = "desktop.php?type=" . $wf_type . "&app=" . $app . "&sec=" . $sec . $get . $GLOBALS['wf_url'];
      return $url;
  }
  function wf_urlFull($wf_type, $app, $sec, $get) {
      echo $url = "desktop_full.php?type=" . $wf_type . "&app=" . $app . "&sec=" . $sec . $get . $GLOBALS['wf_url'];
     // return $url;
  }
  function wf_varFull($wf_type, $app, $sec, $get) {
      $url = "desktop_full.php?type=" . $wf_type . "&app=" . $app . "&sec=" . $sec . $get . $GLOBALS['wf_url'];
      return $url;
  }
  function wf_urlSub($wf_type, $app, $sec, $get) {
      echo $url = "desktopSub.php?type=" . $wf_type . "&app=" . $app . "&sec=" . $sec . $get . $GLOBALS['wf_url'];
     // return $url;
  }
  function wf_webSub($wf_type, $app, $sec, $get) {
      echo $url = "webSub.php?type=" . $wf_type . "&app=" . $app . "&sec=" . $sec . $get . $GLOBALS['wf_url'];
     // return $url;
  }
  function wf_varSub($wf_type, $app, $sec, $get) {
      $url = "desktopSub.php?type=" . $wf_type . "&app=" . $app . "&sec=" . $sec . $get . $GLOBALS['wf_url'];
      return $url;
  }
  function wf_head($wf_type, $app, $sec, $get) {
      header("Location: desktop.php?type=" . $wf_type . "&app=" . $app . "&sec=" . $sec . $get . $GLOBALS['wf_url']);
      //return $wf_head;
      exit();
  }
  function wf_hweb($wf_type, $app, $sec, $get) {
      header("Location: web.php?type=" . $wf_type . "&app=" . $app . "&sec=" . $sec . $get . $GLOBALS['wf_url']);
      //return $wf_head;
      exit();
  }
  if(file_exists($wf_admin . 'appWeb.txt')){
    $wf_webRootDir = file_get_contents($wf_admin . 'appWeb.txt');
    $wf_AppWebRoot = 'web/' . $wf_webRootDir . '/';
  }
  else{
    $wf_webRoot = '';
  }
  function wf_deleteDir($dirPath) {
      if (! is_dir($dirPath)) {
          throw new InvalidArgumentException("$dirPath must be a directory");
      }
      if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
          $dirPath .= '/';
      }
      $files = glob($dirPath . '*', GLOB_MARK);
      foreach ($files as $file) {
          if (is_dir($file)) {
              wf_deleteDir($file);
          } else {
              unlink($file);
          }
      }
      rmdir($dirPath);
  }
  if(isset($_SESSION)){
  if(isset($_GET['wf_fullS'])){
  	if($_GET['wf_fullS'] == 'on'){
  		$_SESSION["wf_fullscreen"] = 'on';
  	}
  	else{
  		$_SESSION["wf_fullscreen"] = 'off';
  	}
  }
  }
  function wf_copy($src,$dst) {
      $dir = opendir($src);
      mkdir($dst);
      while(false !== ( $file = readdir($dir)) ) {
          if (( $file != '.' ) && ( $file != '..' )) {
              if ( is_dir($src . '/' . $file) ) {
                  wf_copy($src . '/' . $file,$dst . '/' . $file);
              }
              else {
                  copy($src . '/' . $file,$dst . '/' . $file);
              }
          }
      }
      closedir($dir);
  }
  function wf_image($image){
      //Read image path, convert to base64 encoding
      $imageData = base64_encode(file_get_contents($image));
      // Format the image SRC:  data:{mime};base64,{data};
      echo $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
  }
  function wf_zip($source, $destination)
  {
      if (!extension_loaded('zip') || !file_exists($source)) {
      //    echo 'Problem with file.<br>';
          return false;
      }
  //$destination = str_replace('\\', '/', realpath($destination));
      $zip = new ZipArchive();
      if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
    //      echo 'Problem with destination.<br>';
          return false;
      }
      else{
  		$zip->open($destination, ZIPARCHIVE::CREATE);
  	}
      //$source = str_replace('\\', '/', realpath($source));
  //    echo 'Source: ' . $source . '<br>Destination: ' . $destination . '<br>';
  //echo 'running ....<br>';
      if (is_dir($source) === true)
      {
          $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
          foreach ($files as $file)
          {
              $file = str_replace('\\', '/', $file);
              // Ignore "." and ".." folders
              if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
                  continue;
             // $file = realpath($file);
  //echo $file . '<br>';
              if (is_dir($file) === true)
              {
  				$x = str_replace($source . '/', '', $file . '/');
  				//echo 'Dir: ' . $x . '<br>';
                  //$zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                  $zip->addEmptyDir($x);
              }
              else if (is_file($file) === true)
              {
  				$x = str_replace($source . '/', '', $file);
  				//echo 'file: ' . $x . '<br>';
                  //$zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                  $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
              }
          }
      }
      else if (is_file($source) === true)
      {
          $zip->addFromString(basename($source), file_get_contents($source));
      }
      return $zip->close();
  }
  function wf_zip_files($source, $destination)
  {
     $zip = new ZipArchive();
     if ($zip->open($destination, ZipArchive::CREATE)!==TRUE) {
      exit("cannot open <$destination>\n");
     }
    foreach (scandir($source) as $entry){
      if ($entry != "." && $entry != ".."){
        $zip->addFile($source . $entry, $entry);
      }
    }
    $zip->close();
  }
  function wf_confirm($wf_type, $app, $sec, $get, $id, $btn_text, $btn_style = "danger"){
  $link = "desktopSub.php?type=" . $wf_type . "&app=" . $app . "&sec=" . $sec . $get;
  echo '<button type="button" class="webdesk_btn webdesk_btn-' . $btn_style . '" data-toggle="webdesk_modal" data-target="#' . $wf_type . '-' . $app . '-' . $id . '">' . $btn_text . '</button>
    <!-- Modal -->
    <div class="webdesk_modal fade" id="' . $wf_type . '-' . $app . '-' . $id . '" role="dialog">
      <div class="webdesk_modal-dialog">
        <div class="webdesk_modal-content">
          <div class="webdesk_modal-header">
            <h4 class="webdesk_modal-title">Warning: Are you sure?</h4>
            <button type="button" class="webdesk_close" data-dismiss="webdesk_modal">&times;</button>
          </div>
          <div class="webdesk_modal-body" style="text-align: center;">
            <p class="">You may inadvertently cause the systematic destruction of the universe and this <b>CANNOT</b> be undone!</b>
            <!--<button type="button" class="webdesk_btn webdesk_btn-default" data-dismiss="modal">Cancel</button> -->
          </div>
          <div class="webdesk_modal-footer">
            <a href="' . $link . '" class="webdesk_btn webdesk_btn-danger">' . $btn_text . '</a>
            <button type="button" class="webdesk_btn webdesk_btn-light" data-dismiss="webdesk_modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>';
  }
  function wf_rand_color() {
      return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
  }
  function wf_UR_exists($url){
     $headers=get_headers($url);
     return stripos($headers[0],"200 OK")?true:false;
  }
  function wf_tier_protect($tier){
    if($tier !== $_SESSION["tier"] || "tA" !== $_SESSION["tier"]){
      session_destroy();
      header('Location: index.php?test=bad tier');
      exit();
    }
  }
  function wf_tier_div($tier1, $page1, $page2){
    if($tier === $_SESSION["tier"] || "tA" === $_SESSION["tier"]){
      header('Location: ' . $page1);
    }
    else{
      header('Location: ' . $page2);
    }
    exit();
  }
  function wf_owner_protect(){
    if(isset($_GET['link'])){
      session_destroy();
      header('Location: index.php?test=not owner');
      exit();
    }
  }
  function wf_owner_div($page1, $page2){
    if(!isset($_GET['link'])){
      header('Location: ' . $page1);
    }
    else{
      header('Location: ' . $page2);
    }
  }
  if(isset($_GET['link'])){
    $link = wf_test_input($_GET['link']);
    $link = explode("-", $link);
    $link = $link[0];
    if(file_exists($wf_appr . 'Link/' . $link . '.json')){
      $wf_link = file_get_contents($wf_appr . 'Link/' . $link . '.json');
      $wf_link = json_decode($wf_link);
    }
  }
  if(isset($_SESSION['wf_adminView'])){
    $wf_file = $_SESSION['wf_adminView'];
  }
  function wf_nav($page, $color, $name, $login, $loc, $auto, $register){
    $nav_id = "navbar-" . rand(0,10000000);
      if(file_exists("www/Pages/nav.json")){
        if($auto == 'simple'){
          $proot = "index.php?page=";
        }
        else{
          $proot = "";
        }
        $obj = file_get_contents("www/Pages/nav.json");
        $obj = json_decode($obj);
      ?>
  <nav class="webdesk_navbar webdesk_navbar-expand-md webdesk_m-0 webdesk_navbar-<?php echo ($color == "light") ? "light webdesk_bg-light" : "inverse webdesk_bg-dark"; echo ($loc == 'fixed') ? ' webdesk_navbar-fixed-top': "" ?>">
    <div class="webdesk_container-fluid">
      <div class="webdesk_navbar-header">
        <button type="button" class="webdesk_navbar-toggler" data-toggle="webdesk_collapse" data-target="#<?php echo $nav_id ?>" aria-controls="<?php echo $nav_id ?>" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fa fa-bars fa-fw"></i>
        </button>
        <?php
      if($name != ""){
      ?>
        <a class="webdesk_navbar-brand webdesk_text-dark" href="//<?php echo $_SERVER["HTTP_HOST"] ?>/index.php?page=index.php"><?php echo $name; ?></a>
        <?php
      }
      ?>
      </div>
      <div class="webdesk_collapse webdesk_navbar-collapse" id="<?php echo $nav_id ?>">
        <ul class="webdesk_navbar-nav webdesk_mr-auto">
          <?php
        $i = 1;
          while($i <= 9){
        foreach($obj as $opage){
          if($opage->par == "np" && $opage->pr == $i){
            $x = 1;
            foreach($obj as $cpage){
              if($cpage->par == $opage->page){
                $x = 2;
              }
          }
      ?>
          <li<?php if(isset($obj->$page->par)){if($x == 2 && $page == $opage->page || $obj->$page->par == $opage->page){
      echo ' class="webdesk_dropdown webdesk_active"';
      }else{
            if($x == 2){
        echo  ' class="webdesk_dropdown"';
      }
            if($page == $opage->page){echo ' class="webdesk_active"';}}}
            else{
            if($x == 2){
        echo  ' class="webdesk_dropdown"';
      }
            if($page == $opage->page){echo ' class="active"';}} ?>><a<?php if($x == 2){ echo ' class="webdesk_dropdown-toggle" data-toggle="webdesk_dropdown"';} ?> href="<?php if($x == 2){
        echo '#';
      }
            else{ echo 'index.php?page=' . $opage->page;} ?>"><?php echo $opage->title; if($x == 2){ echo '<span class="webdesk_caret"></span>';} ?></a>
  <?php
            if($x == 2){
             ?>
          <ul class="webdesk_dropdown-menu">
            <li><a href="<?php echo 'index.php?page=' . $opage->page; ?>"><?php echo $opage->title; ?></a></li>
            <?php
              $z = 1;
          while($z <= 9){
              foreach($obj as $spage){
                if($spage->par == $opage->page && $spage->pr == $z){
              ?>
            <li><a href="<?php echo 'index.php?page=' . $spage->page; ?>"><?php echo $spage->title; ?></a></li>
            <?php
                }
              }
            $z = $z + 1;
          }
              ?>
          </ul>
          <?php
            }
          ?>
          </li>
            <?php
          }
      }
            $i = $i + 1;
          }
      ?>
        </ul>
        <ul class="webdesk_nav webdesk_navbar-nav webdesk_navbar-right">
          <?php
      if($register != ""){
      ?>
          <li class="<?php echo ($register == $page) ? 'webdesk_active' : ''; ?>"><a href="<?php echo $proot . $register; ?>" class="webdesk_text-dark"><i class="fa fa-user fa-fw"></i> Sign Up</a></li>
          <?php
      }
      if($login == "yes"){
      ?>
          <li><a href="index.php?page=login.php" class="webdesk_text-dark"><i class="fa fa-sign-in-alt fa-fw"></i> Login</a></li>
          <?php
    }
      ?>
        </ul>
      </div>
    </div>
  </nav>
  <?php
    }
  }
}
?>
