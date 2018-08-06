<!-- 
////////////////////////////////////////////
//
// WELCOME TAB
//
// AUTHOR: ADAM TELFORD
// 
// THIS FILE DISPLAYS THE CONTENTS OF THE
// WELCOME TAB.
//
/////////////////////////////////////////////
// -->
<?php
if(isset($_SESSION['wd_adminView'])){
  ?>
  <div class="webdesk_alert webdesk_alert-warning webdesk_alert-dismissable">
    <a href="#" class="webdesk_close" data-dismiss="webdesk_alert" aria-label="close">&times;</a>
    <strong>Warning:</strong> Viewing as user. <a href="desktop.php?adminView=stop">Click hear to stop.</a>
  </div>
  <?php
}
if(isset($_GET['wd_as'])){
  ?>
  <div class="webdesk_alert webdesk_alert-success webdesk_alert-dismissable">
    <a href="#" class="webdesk_close" data-dismiss="webdesk_alert" aria-label="close">&times;</a>
    <strong>Success:</strong> <?php $wd = test_input($_GET['wd_as']); echo $wd; ?>
  </div>
  <?php
}
if(isset($_GET['wd_ai'])){
  ?>
  <div class="webdesk_alert webdesk_alert-info webdesk_alert-dismissable">
    <a href="#" class="webdesk_close" data-dismiss="webdesk_alert" aria-label="close">&times;</a>
    <strong>Info:</strong> <?php $wd = test_input($_GET['wd_ai']); echo $wd; ?>
  </div>
  <?php
}
if(isset($_GET['wd_aw'])){
  ?>
  <div class="webdesk_alert webdesk_alert-warning webdesk_alert-dismissable">
    <a href="#" class="webdesk_close" data-dismiss="webdesk_alert" aria-label="close">&times;</a>
    <strong>Warning:</strong> <?php $wd = test_input($_GET['wd_aw']); echo $wd; ?>
  </div>
  <?php
}
if(isset($_GET['wd_ad'])){
  ?>
  <div class="webdesk_alert webdesk_alert-danger webdesk_alert-dismissable">
    <a href="#" class="webdesk_close" data-dismiss="webdesk_alert" aria-label="close">&times;</a>
    <strong>Danger:</strong> <?php $wd = test_input($_GET['wd_ad']); echo $wd; ?>
  </div>
  <?php
}
if(isset($_GET['link'])){
  ?>
  <div class="webdesk_alert webdesk_alert-info webdesk_alert-dismissable">
    <a href="#" class="close" data-dismiss="webdesk_alert" aria-label="close">&times;</a>
    <strong>Link <?php echo $wd_link->name; ?>:</strong><span> To close the conection to the shared folder open and return to you own files please <a href="desktop.php" class="webdesk_alert-link">click here</a>.</span>
  </div>
  <?php
}
if(isset($_GET["app"]) and isset($_GET["sec"])){
  $sec = test_input($_GET["sec"]);
  if(file_exists($type . "/" . $app . "/" . $sec)){
    if(file_exists($type . "/" . $app . "/banner.php")){
      include($type . "/" . $app . "/banner.php");
    }
    include($type . "/" . $app . "/" . $sec);
    if(file_exists($type . "/" . $app . "/footer.php")){
      include($type . "/" . $app . "/footer.php");
    }
  }
  else{
    include("404.php");
  }
}
else{
  
  if(file_exists("update.txt")){
    $webframe_version = file_get_contents("update.txt");
  }
  
  ?>
  <div class="webdesk_container webdesk_p-2 webdesk_mb-5">
    <h1 class="webdesk_display-2 webdesk_py-4">Welcome to WebFrame</h1>
    <h3>Version <?php echo (!empty($webframe_version)) ? $webframe_version : "" ?></h3>
    <p class="webdesk_lead webdesk_pt-3">
      This version is still under development. Please mind the mess.
    </p>
    <p class="webdesk_lead">
      To start an application just go to the Apps tab and click on the tab of your choice. You will see the application name on this tab. Click it to view.
    </p>
    <div class="webdesk_row webdesk_text-center webdesk_pt-5">
      <div class="webdesk_col">
        <a href="#">
          <i class="fa fa-certificate fa-5x"></i><br /><br />
          License
        </a>
      </div>
      <div class="webdesk_col webdesk_text-center">
        <a href="#">
          <i class="fa fa-handshake fa-5x"></i><br /><br />
          Terms of Use
        </a>
      </div>
      <div class="webdesk_col webdesk_text-center">
        <a href="#">
          <i class="fa fa-lock fa-5x"></i><br /><br />
          Privacy Policy
        </a>
      </div>
    </div>


  </div>
  <?php
}
?>
