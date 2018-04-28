<!DOCTYPE html>
<!--<Webdesk.me Making web aplications easy.>
    Copyright (C) 2017  Adam W. Telford

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
    
    
    While using this site, you agree to have read and accepted our terms 
    of use, cookie and privacy policy. Copyright 2017 Adam W. Telford. 
    All Rights Reserved.
    
    A link to the terms of use, cookie and privacy policy, and licences
    can be found at the bottom right corner of the menu bar by clicking 
    the exlmation point once loged in, and in the menu of the login page.-->
<?php 
//session_start();
//ini_set("error_reporting", E_ALL);
file_put_contents($wd_adminFile . 'lastPage.txt', $_SERVER['QUERY_STRING']);
$folder = file_get_contents($wd_adminFile . 'oid.txt');
$temp = 'web/' . $folder . '/';
if ($handle = opendir($temp)) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
                        unlink($temp . $entry);
                    }}}
?>
<html>
<head>
    <meta charset="utf-8">
<title>Desktop</title>
   <meta http-equiv="content-language" content="ll-cc">
    <meta name="language" content="English"> 
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="keywords" content="WebDesk, Web app, webtop, web desktop">
    <meta name="author" content="WebDesk">
    <meta name="description" content="Welcome to WebDesk.">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" width="device-width">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="copyright" content="&copy; 2014 WebDesk.me">
    <!--<link rel="icon" type="image/png" href="image/CA.ico">
    <link rel="apple-touch-icon" href="/custom_icon.png">
    <link rel="apple-touch-startup-image" href="/custom_icon.png">-->
    <link rel="apple-touch-icon" href="favicon.ico">
    <link rel="apple-touch-startup-image" href="favicon.ico">
<link href="Plugins/literallycanvas-0.4.14/css/literallycanvas.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="Plugins/context.standalone.css">
<link href="Plugins/fullcalendar-3.3.0/fullcalendar.min.css" rel="stylesheet"/>
<link href="Plugins/fullcalendar-3.3.0/fullcalendar.print.min.css" rel="stylesheet" media="print" />
<link rel="stylesheet" href="Plugins/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="Theme/default.php">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script src="Plugins/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="Plugins/React/react.min.js"></script>
<script src="Plugins/React/react-dom.min.js"></script>
<script src="Plugins/literallycanvas-0.4.14/js/literallycanvas.js"></script>
<script src="Plugins/fullcalendar-3.3.0/lib/moment.min.js"></script>
<script src="Plugins/fullcalendar-3.3.0/fullcalendar.min.js"></script>
<?php
if(isset($_GET["app"])){
        if(file_exists($type . "/" . $app . "/header.php")){
            include($type . "/" . $app . "/header.php");
		}
        if(isset($sec) && file_exists($type . "/" . $app . "/header_" . $sec)){
            include($type . "/" . $app . "/header_" . $sec);
		}
    }
?>
</head>

<body>
	<div id="1tab" style="padding: 0px; margin: 0px; overflow: scroll; height: 100%; background-color: <?php 
if(file_exists($wd_root . '/User/' . $_SESSION["user"] . '/Admin/Pcolor.txt')){ 
    $pcolor = file_get_contents($wd_root . '/User/' . $_SESSION["user"] . '/Admin/Pcolor.txt');
    echo $pcolor;
}
else{
    echo '#FFFFFF';
}
?>;">

    <div style="background-color: #666699;">
    <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" data-toggle="tooltip" title="Back" id="wd_back" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-arrow-left"></span></a>
    <a href="<?php echo $_SERVER['REQUEST_URI']; ?>" data-toggle="tooltip" title="Refresh" id="wd_refresh" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-refresh"></span></a>
<a href="desktop.php" class="btn btn-info btn-sm" data-toggle="tooltip" title="Home"><span class="glyphicon glyphicon-home"></span></a>
<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#wd_app_help" title="Help Doc"><span class="glyphicon glyphicon-education"></span></button>
<?php
if(isset($_GET["app"])){echo ' <span><b>' . $app . '</b></span>'; }
?>
 <a href="desktop.php?wd_tab=settings" class="btn btn-info btn-sm" style="float: right;" data-toggle="tooltip" title="Home"><span class="glyphicon glyphicon-cog"></span></a>
</div>
<?php if(isset($_GET['wd_as'])){ ?>
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
    if(isset($_GET['link'])){ ?>
<div class="alert alert-info alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Link:</strong><span> To close the conection to the shared folder open and return to you own files please <a href="desktop.php" class="alert-link">click here</a>.</span>
  </div>
  <?php
}
if(isset($_GET["app"]) and isset($_GET["sec"])){
        include($type . "/" . $app . "/" . $sec);
    } 
      elseif(isset($_GET["wd_tab"]) && $_GET["wd_tab"] == "settings"){
        ?>
        <div style="background-color: <?php
if(file_exists($wd_root . '/User/' . $_SESSION["user"] . '/Admin/Pcolor.txt')){
    $pcolor = file_get_contents($wd_root . '/User/' . $_SESSION["user"] . '/Admin/Pcolor.txt');
    echo $pcolor;
}
else{
    echo '#FFFFFF';
}
?>; overflow: scroll; height: 90%;">
    <h1><span class="glyphicon glyphicon-cog"></span> <?php echo f_dec($_SESSION["user"]); ?>'s Settings</h1>
    <a href="logout.php"><button class="btn btn-danger"><span class="glyphicon glyphicon-off"></span> Logout</button></a>
<br><br>
    <form method="post" action="Home.php?id=<?php $val = test_input(file_get_contents($wd_adminFile . 'val.txt')); echo $_SESSION["user"] . '&val=' . $val; ?>&type=<?php echo $_SESSION["HUD"]; ?>">
        <input type="submit" name="lastPage" class="btn btn-primary" Value="AutoLogin">
    </form>
    <details>
    <summary><b style="font-size: 1.5em;">URL for your WebDesk</b></summary><br><br>
    <form method="post" action="url.php">
        <input type="text" name="url" placeholder="http://www.somthing.com" title="http://www.somthing.com" required><br><br>
        <input type="submit" value="Submit">
    </form>
    </details><br><br>
    <!--<details>
    <summary><b style="font-size: 1.5em;">Set Wallpaper</b></summary><br><br>
    <form method="post" action="back.php">
        <input type="text" name="back" value="<?php echo $back; ?>" placeholder="http://www.somthing.com/picture.jpg" title="http://www.somthing.com/picture.jpg" required><br><br>
        <input type="submit" value="Submit">
    </form>
    </details><br><br>
    <details>
    <summary><b style="font-size: 1.5em;">Background color</b></summary><br><br>
    <form method="post" action="color.php">
        <input type="color" name="color" value="<?php echo $color; ?>"><br><br>
        <input type="submit" value="Submit">
    </form>
    </details><br><br>-->
    <details>
    <summary><b style="font-size: 1.5em;">Page color</b></summary><br><br>
    <form method="post" action="Pcolor.php">
        <input type="color" name="color" value="<?php echo $pcolor; ?>"><br><br>
        <input type="submit" value="Submit">
    </form>
    </details><br><br>
    <details>
    <summary><b style="font-size: 1.5em;">Reset Password</b></summary><br><br>
    <form method="post" action="">
        <label for="opass">Old Password: </label><br>
        <input type="password" name="opass" id="opass" placeholder="Old Password" title="Old Password" required><br><br>
        <label for="npass">New Password: </label><br>
        <input type="password" name="npass" id="npass" placeholder="New Password" title="New Password" required><br><br>
        <label for="vpass">Verify Password: </label><br>
        <input type="password" name="vpass" id="vpass" placeholder="Verify Password" title="Verify Password" required><br><br>
        <input type="submit" value="Submit"><br><br>
    </form>
    </details><br><br>
    <details>
    <summary><b style="font-size: 1.5em;">Default Programs</b></summary>
    <form method="post" action="ext.php">
        <input type="text" name="ext" placeholder="ext example(doc, wd_writer, pdf)">
        <select name="prog">
<?php
if ($handle = opendir('Apps/')) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
?>
            <option value="Apps/<?php echo $entry; ?>"><?php echo $entry; ?></option>
<?php
}}}
if ($handle = opendir('MyApps/')) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
?>
            <option value="MyApps/<?php echo $entry; ?>"><?php echo $entry; ?></option>
<?php
}}}
?>
        </select>
        <input type="submit" value="Save">
    </form> 
    </details><br><br>
    <details>
    <summary><b style="font-size: 1.5em;">Delete Account</b></summary><br><br>
    </details><br><br>
    </div>
      <?php
      }
    else{
$wd = 0;
$wd_tier = test_input($wd_tier);
$wd_tierFile = $wd_admin . $wd_tier . '.json';
if(file_exists($wd_tierFile)){$wd_tierobj=json_decode(file_get_contents($wd_tierFile)); $wd_obj = $wd_tierobj;} 
else{
$wd_tierobj = "";
$wd_obj = "";
}
foreach (scandir('Apps/') as $entry){
                    if ($entry != "." && $entry != "..") {
                        if(!file_exists($wd_tierFile)){$wd_teatobj = 0;}
                        elseif(isset($wd_obj->$entry) && $wd_obj->$entry == 'Yes'){$wd_teatobj = 1;}
                        else{$wd_teatobj = 0;}
                        if($wd_tier === 'tA' || $wd_teatobj === 1){
						$wd = $wd + 1;
?>
<figure id="wd_<?php echo $wd; ?>" style="float: left; padding: 10px;">
    <a href="<?php wd_url('Apps', $entry, 'start.php', ''); ?>"><img src="Apps/<?php echo $entry; ?>/ic.png" style="height: 50px; width: 50px;"></a>
<figcaption style="text-align: center;"><a href="<?php wd_url('Apps', $entry, 'start.php', ''); ?>" title="<?php echo $entry; ?>" style="font-size: 0.5em; text-decoration: none;"><?php echo $entry; ?></a></figcaption>
</figure>
<?php
                    }
else{
    if(isset($_GET['app']) && $_GET['app'] == $entry){
        //header('Location: desktop.php?wd_aw=Do not try to hack the system.');
        exit('Do not try to hack the system');
    }
}
                    }
                }
?>
    <div style="width: 100%; clear: both;"><h1>My Apps</h1>
    <hr></div>
<?php 
foreach (scandir('MyApps/') as $entry){
                    if ($entry != "." && $entry != "..") {
                        if(!file_exists($wd_tierFile)){$wd_teatobj = 0;}
                        elseif(isset($wd_obj->$entry) && $wd_obj->$entry == 'Yes'){$wd_teatobj = 1;}
                        else{$wd_teatobj = 0;}
                        if($wd_tier === 'tA' || $wd_teatobj === 1){
?>
<figure id="wd_m<?php echo $wd; ?>" style="float: left; padding: 10px;">
    <a href="<?php wd_url('MyApps', $entry, 'start.php', ''); ?>"><img <?php if(file_exists("MyApps/" . $entry . "/ic.png")){ ?>src="MyApps/<?php echo $entry; ?>/ic.png" <?php } else{ ?> src="Apps/Dev/ic.png" <?php } ?> style="height: 50px; width: 50px;"></a>
<figcaption style="text-align: center;"><a href="<?php wd_url('MyApps', $entry, 'start.php', ''); ?>" title="<?php echo $entry; ?>" style="font-size: 0.5em; text-decoration: none;"><?php echo $entry; ?></a></figcaption>
</figure>
<?php
                    }}
                }
			}
?>
<!-- wd_app_help-->
  <div class="modal fade" id="wd_app_help" role="dialog">
    <div class="modal-dialog">
    
      
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php if(isset($wd_app)){ echo $wd_app; }; ?> Help</h4>
        </div>
        <div class="modal-body">
          <?php
if(isset($sec) && isset($wd_app)){
              if(file_exists($wd_type . '/' . $wd_app . '/help_' . $sec)){
                  $wd_help = file_get_contents($wd_type . '/' . $wd_app . '/help_' . $sec);
                  echo $wd_help;
              }
              elseif(file_exists($wd_type . '/' . $wd_app . '/help.php')){
                  $wd_help = file_get_contents($wd_type . '/' . $wd_app . '/help.php');
                  echo $wd_help;
              }
              else{
                  echo 'We are sorry but there is no help documentation available for this app.';
              }
}
else{
    $wd_help = file_get_contents('help.php');
    echo $wd_help;
}
          ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<!-- End wd_app_help -->
  </div>
<script>
var a=document.getElementsByTagName("a");
for(var i=0;i<a.length;i++) {
    if(!a[i].onclick && a[i].getAttribute("target") != "_blank") {
        a[i].onclick=function() {
                window.location=this.getAttribute("href");
                return false; 
        }
    }
}
    </script>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();  
    $(".wd_confirm").click(function(){
        if (!confirm("Please Confirm:")){ return false; }
    });
});
</script>
  <script src="Plugins/context.js"></script>
</body>
</html>
