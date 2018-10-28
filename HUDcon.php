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
<div class="webdesk_text-center" style="">
  <?php
  if(isset($_SESSION['wd_adminView'])){
    ?>
    <div class="webdesk_alert webdesk_alert-warning webdesk_alert-dismissable">
      <a href="#" class="webdesk_close" data-dismiss="webdesk_alert" aria-label="webdesk_close">&times;</a>
      <strong>Warning:</strong> Viewing as user. <a href="desktop.php?adminView=stop">Click hear to stop.</a>
    </div>
    <?php
  }
  foreach($_GET as $key => $wd_alert){
    
    if(preg_match("/^wd\_a([A-Za-z0-9]+)$/", test_input($key), $match)){
      
      switch($match[1]){
        case "s":
          $a_type = "success";
          break;
        case "i":
          $a_type = "info";
          break;
        case "w":
          $a_type = "warning";
          break;
        case "d":
          $a_type = "danger";
          break;
      }
      
      
      ?>
      <div class="webdesk_alert webdesk_alert-<?php echo $a_type ?> webdesk_position-fixed webdesk_m-3" style="right: 0;z-index: 10000;" role="alert">
        <?php echo test_input($wd_alert) ?>
      </div>
      <?php
      
    }
  }
  /*
  if(isset($_GET['wd_as'])){
    ?>
    <div class="webdesk_alert webdesk_alert-success webdesk_position-fixed" role="alert">
      <?php $wd = test_input($_GET['wd_as']); echo $wd; ?>
    </div>
    <?php
  }
  if(isset($_GET['wd_ai'])){
    ?>
    <div class="webdesk_alert webdesk_alert-info" role="alert">
      <?php $wd = test_input($_GET['wd_ai']); echo $wd; ?>
    </div>
    <?php
  }
  if(isset($_GET['wd_aw'])){
    ?>
    <div class="webdesk_alert webdesk_alert-warning" role="alert">
      <?php $wd = test_input($_GET['wd_aw']); echo $wd; ?>
    </div>
    <?php
  }
  if(isset($_GET['wd_ad'])){
    ?>
    <div class="webdesk_alert webdesk_alert-danger" style="" role="alert">
      <?php $wd = test_input($_GET['wd_ad']); echo $wd; ?>
    </div>
    <?php
  }
  */
  if(isset($_GET['link'])){
    ?>
    <div class="webdesk_alert webdesk_alert-info">
      <a href="#" class="close" data-dismiss="webdesk_alert" aria-label="webdesk_close">&times;</a>
      <strong>Link <?php echo $wd_link->name; ?>:</strong><span> To close the conection to the shared folder open and return to you own files please <a href="desktop.php" class="webdesk_alert-link">click here</a>.</span>
    </div>
    <?php
  }
  ?>
</div>
<?php
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
