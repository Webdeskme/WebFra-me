<?php
  if(isset($_SESSION['wd_adminView'])){
?>
  <div class="alert alert-warning alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Warning:</strong> Viewing as user. <a href="desktop.php?adminView=stop">Click hear to stop.</a>
  </div>
<?php 
}
  if(isset($_GET['wd_as'])){ ?>
<div class="alert alert-success alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success:</strong> <?php $wd = test_input($_GET['wd_as']); echo $wd; ?>
  </div>
<?php } if(isset($_GET['wd_ai'])){ ?>
<div class="alert alert-info alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Info:</strong> <?php $wd = test_input($_GET['wd_ai']); echo $wd; ?>
  </div>
<?php } if(isset($_GET['wd_aw'])){ ?>
 <div class="alert alert-warning alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Warning:</strong> <?php $wd = test_input($_GET['wd_aw']); echo $wd; ?>
  </div>
<?php } if(isset($_GET['wd_ad'])){ ?>
<div class="alert alert-danger alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Danger:</strong> <?php $wd = test_input($_GET['wd_ad']); echo $wd; ?>
  </div>
    <?php 
    }
    if(isset($_GET['link'])){ 
      ?>
<div class="alert alert-info alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Link <?php echo $wd_link->name; ?>:</strong><span> To close the conection to the shared folder open and return to you own files please <a href="desktop.php" class="alert-link">click here</a>.</span>
  </div>
  <?php
}
if(isset($_GET["app"]) and isset($_GET["sec"])){
  $sec = test_input($_GET["sec"]);
  if(file_exists($type . "/" . $app . "/banner.php")){
    include($type . "/" . $app . "/banner.php");
  }
  if(file_exists($type . "/" . $app . "/" . $sec)){
        include($type . "/" . $app . "/" . $sec);
  }
  else{
    include("404.php");
  }
    } 
    else{
?>
<h1>Welcome</h1>
<hr>
<p>To start an application just go to the app tab and click on the tab of your choice. You will see the application name on this tab. Click it to view.</p>
<p><b>Version: </b>1.0</p>
<a href="#">License</a><br>
<a href="#">Terms of Use</a><br>
<a href="#">Pricay Policy</a>
<?php
    }
     ?>