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
include 'wd_ch.php';
if(isset($_GET["app"])){
        if(file_exists($type . "/" . $app . "/header.php")){
            include($type . "/" . $app . "/header.php");
		}
        if(isset($sec) && file_exists($type . "/" . $app . "/header_" . $sec)){
            include($type . "/" . $app . "/header_" . $sec);
		}
        if(file_exists($type . "/" . $app . "/style.css")){
          ?>
            <link rel="stylesheet" type="text/css" href="<?php echo $type . "/" . $app . "/style.css"; ?>">
                                                                                          <?php
		}
        if(isset($sec) && file_exists($type . "/" . $app . "/style_" . $sec)){
            ?>
            <link rel="stylesheet" type="text/css" href="<?php echo $type . "/" . $app . "/style_" . $sec; ?>">
  <?php
		}
    }
?>
<script>
    $( function() {
    var tabs = $( "#tabs" ).tabs();
    tabs.find( ".ui-tabs-nav" ).sortable({
      axis: "x",
      stop: function() {
        tabs.tabs( "refresh" );
      }
    });
  } );
  </script>
<script>
 $(function() {
$( "#tabs" ).tabs({

collapsible: true
//active: false
});
$( ".tab" ).resizable();
<?php if(!isset($_SESSION["wd_fullscreen"]) || $_SESSION["wd_fullscreen"] != 'on'){  ?> 
$( ".tab" ).draggable();
<?php } ?>
});
</script>
</head>
<body onload="display_ct();">
<div id="tabs" class="con">
<ul id="wd_tabs">
<li><a href="#tabs-1"><span class="glyphicon glyphicon-folder-open"></span> <?php if(isset($app)){echo $app;} else{echo "Welcome";} ?></a></li>
<li><a href="#tabs-2"><span class="glyphicon glyphicon-globe"></span> Web</a></li>
<li><a href="#tabs-3"><span class="glyphicon glyphicon-exclamation-sign"></span> Alerts <span class="badge"><?php
$wd = 0;
if ($handle = opendir($wd_root . '/User/' . $_SESSION["user"] . '/Sec/')) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
						$wd = $wd + 1;
					}}}
					echo $wd;
?></span></a></li>
<li><a href="#tabs-4"><span class="glyphicon glyphicon-user"></span> <?php echo f_dec($_SESSION["user"]); ?></a></li>
<li><a href="#tabs-5"><span class="glyphicon glyphicon-hourglass"></span> Tasks</a></li>
<li><a href="#tabs-6"><span class="glyphicon glyphicon-folder-close"></span> Apps</a></li>
&emsp; <a href="#" data-toggle="popover" title="Search Apps" data-placement="top" data-html="true" data-content='<form metod="get" action="desktop.php">
<input list="wd_app_sd" placeholder="Type App Name" id="wd_app_s" name="app">
  <datalist id="wd_app_sd">
  <?php 
$wd = 0;
$wd_tier = test_input($wd_tier);
$wd_tierFile = $wd_admin . $wd_tier . '.json';
if(file_exists($wd_tierFile)){$wd_tierobj=json_decode(file_get_contents($wd_tierFile)); $wd_obj = $wd_tierobj;} 
else{
$wd_tierobj = "";
$wd_obj = "";
}
if ($handle = opendir('Apps/')) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
                        if(!file_exists($wd_tierFile)){$wd_teatobj = 0;}
                        elseif(isset($wd_obj->$entry) && $wd_obj->$entry == 'Yes'){$wd_teatobj = 1;}
                        else{$wd_teatobj = 0;}
                        if($wd_tier === 'tA' || $wd_teatobj === 1){
						$wd = $wd + 1;
  ?>
  <option value="<?php echo $entry; ?>">
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
}
$wd = 0;
$wd_tier = test_input($wd_tier);
$wd_tierFile = $wd_admin . $wd_tier . '.json';
if(file_exists($wd_tierFile)){$wd_tierobj=json_decode(file_get_contents($wd_tierFile)); $wd_obj = $wd_tierobj;} 
else{
$wd_tierobj = "";
$wd_obj = "";
}
if ($handle = opendir('MyApps/')) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
                        if(!file_exists($wd_tierFile)){$wd_teatobj = 0;}
                        elseif(isset($wd_obj->$entry) && $wd_obj->$entry == 'Yes'){$wd_teatobj = 1;}
                        else{$wd_teatobj = 0;}
                        if($wd_tier === 'tA' || $wd_teatobj === 1){
						$wd = $wd + 1;
  ?>
  <option value="<?php echo $entry; ?>">
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
}
?>
  </datalist>
  <!--<input type="hidden" name="type" value="Apps">-->
  <input type="hidden" name="sec" value="start.php">
  <button type="submit" class="btn btn-primary">
  <i class="glyphicon glyphicon-search"></i>
</button>
</form>'><span class="glyphicon glyphicon-search"></span></a>
<span style="float: right;"><?php if(file_exists($wd_admin . $_SESSION['tier'] . '.json')){$myObj = file_get_contents($wd_admin . $_SESSION['tier'] . '.json');
$myObj = json_decode($myObj); $wd_chat = $myObj->wd_chat;} else{ $wd_chat = "Yes";} if($wd_chat == 'Yes'){ ?><a href="#" id="chat" title="Chat"><span class="glyphicon glyphicon-comment"></span></a> &emsp; <?php } ?><a href="#" data-toggle="popover" title="Applets" data-placement="top" data-html="true" data-content='<a href="#" id=wd_lock><i class="fa fa-coffee" aria-hidden="true"></i></a><script>$("#wd_lock").click(function(){
    $("#clouds").show();
});</script> &emsp;
<?php
if ($handle = opendir("Applets/")) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") { 
$aplname = explode(".", $entry); 
$aplxml=json_decode(file_get_contents("Applets/" . $entry));
?> 
<i class="<?php echo $aplxml->icon ; ?>" style="text-align: right;" data-toggle="modal" data-target="#<?php echo $aplname[0]; ?>" title="<?php echo $aplxml->tooltip; ?>"></i> &emsp;
<?php
}}}
if ($handle = opendir("MyApplets/")) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") { 
$aplname = explode(".", $entry); 
$aplxml=json_decode(file_get_contents("MyApplets/" . $entry));
?> 
<i class="<?php echo $aplxml->icon ; ?>" style="text-align: right;" data-toggle="modal" data-target="#M<?php echo $aplname[0]; ?>" title="<?php echo $aplxml->tooltip; ?>"></i> &emsp;
<?php
}}}
?>'><span class="glyphicon glyphicon-option-horizontal"></span></a>
   &emsp; <a href="desktop.php" target="_blank" style="text-align: right;" data-toggle="tooltip" title="Add WorkSpace"><i class="glyphicon glyphicon-new-window"></i></a> &emsp;
    <span style="text-align: right;" data-toggle="modal" data-target="#wd_cal"><b id="dt"></b></span>,
    <span style="text-align: right;" data-toggle="modal" data-target="#wd_clock"><b id="ct"></b></span>&emsp;
    <span style="text-align: right;" class="glyphicon glyphicon-info-sign" data-toggle="modal" data-target="#wd_info" title="info"></span></span>
</ul>
    <div style="height: 95%; padding: 0px; margin: 0px; background-color: <?php echo $color; ?>; background-image: url(<?php echo $back; ?>); background-repeat: no-repeat; background-position: center; background-size: contain; -moz-background-size: contain; -webkit-background-size: contain; -o-background-size: contain;">
<div id="tabs-6" class="tab" style="background-color: <?php
if(file_exists($wd_root . '/User/' . $_SESSION["user"] . '/Admin/Pcolor.txt')){
    $pcolor = file_get_contents($wd_root . '/User/' . $_SESSION["user"] . '/Admin/Pcolor.txt');
    echo $pcolor;
}
else{
    echo '#FFFFFF';
}
?>;">
    <!--<a href="" style="float: right;">Add App to Desktop</a>-->
    <h1>Apps</h1>
    <hr><br>
<?php 
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
                      $tentry = 'myApp_' . $entry;
                        if(!file_exists($wd_tierFile)){$wd_teatobj = 0;}
                        elseif(isset($wd_obj->$tentry) && $wd_obj->$tentry == 'Yes'){$wd_teatobj = 1;}
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
?>
</div>
<div id="tabs-2" class="tab" style="background-color: <?php 
if(file_exists($wd_root . '/User/' . $_SESSION["user"] . '/Admin/Pcolor.txt')){ 
    $pcolor = file_get_contents($wd_root . '/User/' . $_SESSION["user"] . '/Admin/Pcolor.txt');
    echo $pcolor;
}
else{
    echo '#FFFFFF';
}
?>;">
    <h1>Web</h1>
    <form method="post" action="webSubAdd.php">
        <iframe src="http://duckduckgo.com/search.html?prefill=Search The Web&kn=1&kf=fw&kz=1&kp=1&kh=1&kg=p" style="overflow:hidden;margin:0;padding:0;width:408px;height:40px;" frameborder="0">Your browser boes not support iframes.</iframe><br>
        <label for="add">Add Website: </label>
        <input type="text" name="add" id="add" placeholder="http://www.somthing.com" title="http://www.somthing.com" required>
        <input type="submit" value="add">
    </form><br><hr><br>
    <div>
        <?php 
        if ($handle = opendir($wd_root . '/User/' . $_SESSION["user"] . '/Web/')) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
                $url = file_get_contents($wd_root . '/User/' . $_SESSION["user"] . '/Web/' . $entry);
                $arr = parse_url($url);
                $host = explode('.', $arr["host"]);
                if(isset($host[2])){
                $host = $host[1];
                }
                else{
                $host = $host[0];
                }
                //$host = preg_replace('/^www\./', '', $arr["host"]);
                //$host = basename($host, ".com");
                $ico = $arr["scheme"] . '://' . $arr["host"] . '/favicon.ico';
                ?>
        <figure style="float: left;">
                <figcaption style="text-align: center;"><a style="font-size: 1.2em;" href="<?php echo $url; ?>" target="_blank" title="<?php echo $url; ?>" style="font-size: 0.5em;"><?php if(strlen($host) > 12){echo substr($host,0,12);} else{echo $host;} ?></a></figcaption>
                <a href="<?php echo $url; ?>" target="_blank" title = "<?php echo $url; ?>" style="text-align: center;"><img src="<?php echo $ico; ?>" style="display: block; height: 50px; width: 50px; margin: 2px; padding: 2px;"></a>
                <figcaption style="text-align: center;"><a href="webSubDelete.php?id=<?php echo basename($entry, '.txt'); ?>" class="text-danger" style="font-size: 1em;">remove</a></figcaption>
        </figure>
                <?php
                    }
                }
                closedir($handle);
                }
                ?>
    </div>
</div>
<div id="tabs-3" class="tab" style="background-color: <?php
if(file_exists($wd_root . '/User/' . $_SESSION["user"] . '/Admin/Pcolor.txt')){
    $pcolor = file_get_contents($wd_root . '/User/' . $_SESSION["user"] . '/Admin/Pcolor.txt');
    echo $pcolor;
}
else{
    echo '#FFFFFF';
}
?>;">

    <h1>Alerts</h1>
    <form method="post" action="notfySub.php">
        <input type="text" name="post" placeholder="Post here." style="width: 80%;">
        <input type="submit" class="btn btn-success" value="Post">
    </form>
<br><br>
<?php
if ($handle = opendir($wd_root . '/User/' . $_SESSION["user"] . '/Sec/')) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
echo "<b>" . $entry . "</b> " . file_get_contents($wd_root . '/User/' . $_SESSION["user"] . '/Sec/' . $entry) . ' <a href="notfySubDelete.php?stamp=' . $entry . '"><i class="text-danger">-Dismiss</i></a><br>';
}}}
?>
</div>
<div id="tabs-4" class="tab" style="background-color: <?php echo $color; ?>;">
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
    <details>
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
    </details><br><br>
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
</div>
<div id="tabs-5" class="tab" style="background-color: <?php
if( isset($_SERVER['HTTPS'] ) ) {
$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
}
else{
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
}
if(file_exists($wd_root . '/User/' . $_SESSION["user"] . '/Admin/Pcolor.txt')){
    $pcolor = file_get_contents($wd_root . '/User/' . $_SESSION["user"] . '/Admin/Pcolor.txt');
    echo $pcolor;
}
else{
    echo '#FFFFFF';
}
?>;">
    <h1>Task Manager</h1>
    <form method="post" action="taskSub.php">
        <input type="text" name="title" value="<?php echo date("m-d-Y h:i-sa"); ?>" placeholder="Add Task Title">
        <input type="hidden" name="task" value="<?php echo $actual_link; ?>">
        <input type="hidden" name="app" value="<?php $app = test_input($_GET["app"]); echo $app; ?>">
        <input type="submit" class="btn btn-success" value="Add">
    </form>
<?php
    if ($handle = opendir($wd_root . '/User/' . $_SESSION["user"] . '/Book/')) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
                        echo file_get_contents($wd_root . '/User/' . $_SESSION["user"] . '/Book/' . $entry);
                    }}}
?>
</div>
<div id="tabs-1" class="tab" style="overflow: hidden; padding: 0px; margin: 0px;">
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
    <?php
    if(isset($_SESSION["wd_fullscreen"]) && $_SESSION["wd_fullscreen"] == 'on'){
		?>
		<a href="<?php if (empty($_GET)) { echo $_SERVER['REQUEST_URI'] . '?wd_fullS=off';} else{ echo $_SERVER['REQUEST_URI'] . '&wd_fullS=off';} ?>" class="btn btn-info btn-sm" data-toggle="tooltip" title="Minimize"><span class="glyphicon glyphicon-resize-small"></span></a>
		<?php
	} 
	else{
?>
<a href="<?php if (empty($_GET)) { echo $_SERVER['REQUEST_URI'] . '?wd_fullS=on';} else{ echo $_SERVER['REQUEST_URI'] . '&wd_fullS=on';} ?>" class="btn btn-info btn-sm" data-toggle="tooltip" title="Maximize"><span class="glyphicon glyphicon-resize-full"></span></a>
<?php
}
?>
<a href="<?php $get = explode('?', $_SERVER['REQUEST_URI']); if(isset($get[1])){ echo 'desktop_full.php?' . $get[1];} else{ echo 'desktop_full.php'; } ?>" class="btn btn-info btn-sm" data-toggle="tooltip" title="Fullscreen"><span class="glyphicon glyphicon-fullscreen"></span></a>
<a href="desktop.php" class="btn btn-info btn-sm" data-toggle="tooltip" title="Home"><span class="glyphicon glyphicon-home"></span></a>
<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#wd_app_help" title="Help Doc"><span class="glyphicon glyphicon-education"></span></button>
<?php
if(isset($_GET["app"])){?> <span id="-wd_t1Title"><a href="<?php wd_url($type, $app, 'start.php', ''); ?>"><b><?php echo $app; ?></b></a></span> <?php }
?>
</div>
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
</div>
</div>
    </div>
</div>

<!-- wd_clock -->
  <div class="modal fade" id="wd_clock" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Time</h4>
        </div>
        <div class="modal-body">
          
          <canvas id="canvas" width="400" height="400"
style="background-color:#333">
</canvas>

<script>
var canvas = document.getElementById("canvas");
var ctx = canvas.getContext("2d");
var radius = canvas.height / 2;
ctx.translate(radius, radius);
radius = radius * 0.90
setInterval(drawClock, 1000);

function drawClock() {
  drawFace(ctx, radius);
  drawNumbers(ctx, radius);
  drawTime(ctx, radius);
}

function drawFace(ctx, radius) {
  var grad;
  ctx.beginPath();
  ctx.arc(0, 0, radius, 0, 2*Math.PI);
  ctx.fillStyle = 'white';
  ctx.fill();
  grad = ctx.createRadialGradient(0,0,radius*0.95, 0,0,radius*1.05);
  grad.addColorStop(0, '#333');
  grad.addColorStop(0.5, 'white');
  grad.addColorStop(1, '#333');
  ctx.strokeStyle = grad;
  ctx.lineWidth = radius*0.1;
  ctx.stroke();
  ctx.beginPath();
  ctx.arc(0, 0, radius*0.1, 0, 2*Math.PI);
  ctx.fillStyle = '#333';
  ctx.fill();
}

function drawNumbers(ctx, radius) {
  var ang;
  var num;
  ctx.font = radius*0.15 + "px arial";
  ctx.textBaseline="middle";
  ctx.textAlign="center";
  for(num = 1; num < 13; num++){
    ang = num * Math.PI / 6;
    ctx.rotate(ang);
    ctx.translate(0, -radius*0.85);
    ctx.rotate(-ang);
    ctx.fillText(num.toString(), 0, 0);
    ctx.rotate(ang);
    ctx.translate(0, radius*0.85);
    ctx.rotate(-ang);
  }
}

function drawTime(ctx, radius){
    var now = new Date();
    var hour = now.getHours();
    var minute = now.getMinutes();
    var second = now.getSeconds();
    //hour
    hour=hour%12;
    hour=(hour*Math.PI/6)+
    (minute*Math.PI/(6*60))+
    (second*Math.PI/(360*60));
    drawHand(ctx, hour, radius*0.5, radius*0.07);
    //minute
    minute=(minute*Math.PI/30)+(second*Math.PI/(30*60));
    drawHand(ctx, minute, radius*0.8, radius*0.07);
    // second
    second=(second*Math.PI/30);
    drawHand(ctx, second, radius*0.9, radius*0.02);
}

function drawHand(ctx, pos, length, width) {
    ctx.beginPath();
    ctx.lineWidth = width;
    ctx.lineCap = "round";
    ctx.moveTo(0,0);
    ctx.rotate(pos);
    ctx.lineTo(0, -length);
    ctx.stroke();
    ctx.rotate(-pos);
}
</script>


          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<!-- End wd_clock -->
  
<!-- wd_cal -->
  <div class="modal fade" id="wd_cal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Date: <?php echo date("F j, Y"); ?></h4>
        </div>
        <div class="modal-body">
			<script>

	$(document).ready(function() {

		$('#calendar').fullCalendar({
			defaultDate: '<?php echo date("Y-m-d"); ?>',
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: [
				<?php
if(isset($_GET['title'])){
  if($app = "Calendar"){
    $title = test_input($_GET['title']);
    echo file_get_contents($wd_file . $title);
  }
}
?>
			]
		});
		
	});

</script>

<div id='calendar'></div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<!-- End wd_cal -->
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
<!-- wd_info -->
<div id="wd_info" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">WebDesk Information</h4>
      </div>
      <div class="modal-body">
		  <p><b>Version: </b>1.0</p>
        <a href="">License</a><br>
        <a href="">Terms of Use</a><br>
        <a href="">Pricay Policy</a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- End wd_info -->
<!-- lock -->
<style>
  #clouds{
	padding: 100px 0;
	background: #c9dbe9;
	background: -webkit-linear-gradient(top, #c9dbe9 0%, #fff 100%);
	background: -linear-gradient(top, #c9dbe9 0%, #fff 100%);
	background: -moz-linear-gradient(top, #c9dbe9 0%, #fff 100%);
    position: absolute;
    left: 0px;
    top: 0px;
    z-index: 999;
    width: 100%;
    height: 100%;
    text-align: center;
    display: none;
}

/*Time to finalise the cloud shape*/
.cloud {
	width: 200px; height: 60px;
	background: #fff;
	
	border-radius: 200px;
	-moz-border-radius: 200px;
	-webkit-border-radius: 200px;
	
	position: relative; 
}

.cloud:before, .cloud:after {
	content: '';
	position: absolute; 
	background: #fff;
	width: 100px; height: 80px;
	position: absolute; top: -15px; left: 10px;
	
	border-radius: 100px;
	-moz-border-radius: 100px;
	-webkit-border-radius: 100px;
	
	-webkit-transform: rotate(30deg);
	transform: rotate(30deg);
	-moz-transform: rotate(30deg);
}

.cloud:after {
	width: 120px; height: 120px;
	top: -55px; left: auto; right: 15px;
}

/*Time to animate*/
.x1 {
	-webkit-animation: moveclouds 15s linear infinite;
	-moz-animation: moveclouds 15s linear infinite;
	-o-animation: moveclouds 15s linear infinite;
}

/*variable speed, opacity, and position of clouds for realistic effect*/
.x2 {
	left: 200px;
	
	-webkit-transform: scale(0.6);
	-moz-transform: scale(0.6);
	transform: scale(0.6);
	opacity: 0.6; /*opacity proportional to the size*/
	
	/*Speed will also be proportional to the size and opacity*/
	/*More the speed. Less the time in 's' = seconds*/
	-webkit-animation: moveclouds 25s linear infinite;
	-moz-animation: moveclouds 25s linear infinite;
	-o-animation: moveclouds 25s linear infinite;
}

.x3 {
	left: -250px; top: -200px;
	
	-webkit-transform: scale(0.8);
	-moz-transform: scale(0.8);
	transform: scale(0.8);
	opacity: 0.8; /*opacity proportional to the size*/
	
	-webkit-animation: moveclouds 20s linear infinite;
	-moz-animation: moveclouds 20s linear infinite;
	-o-animation: moveclouds 20s linear infinite;
}

.x4 {
	left: 470px; top: -250px;
	
	-webkit-transform: scale(0.75);
	-moz-transform: scale(0.75);
	transform: scale(0.75);
	opacity: 0.75; /*opacity proportional to the size*/
	
	-webkit-animation: moveclouds 18s linear infinite;
	-moz-animation: moveclouds 18s linear infinite;
	-o-animation: moveclouds 18s linear infinite;
}

.x5 {
	left: -150px; top: -150px;
	
	-webkit-transform: scale(0.8);
	-moz-transform: scale(0.8);
	transform: scale(0.8);
	opacity: 0.8; /*opacity proportional to the size*/
	
	-webkit-animation: moveclouds 20s linear infinite;
	-moz-animation: moveclouds 20s linear infinite;
	-o-animation: moveclouds 20s linear infinite;
}

@-webkit-keyframes moveclouds {
	0% {margin-left: 1000px;}
	100% {margin-left: -1000px;}
}
@-moz-keyframes moveclouds {
	0% {margin-left: 1000px;}
	100% {margin-left: -1000px;}
}
@-o-keyframes moveclouds {
	0% {margin-left: 1000px;}
	100% {margin-left: -1000px;}
}
</style>
<div id="clouds">
	<div class="cloud x1"></div>
	<div class="cloud x2"></div>
	<div class="cloud x3"></div>
	<div class="cloud x4"></div>
	<div class="cloud x5"></div>
  <!--<div class="form-group" class="center">
<label for="wd_lockC">--><h1><?php echo $_SERVER['HTTP_HOST']; ?></h1><!--</label>
  <input type="text" id="wd_lockC" placeholder="password"><button class="btn btn-success" id="wd_lockP">Lock</button>
  </div>-->
</div>
<script>
  $("#clouds").click(function(){
    $("#clouds").hide();
  });
</script>
  <!-- End Lock -->
<?php
if ($handle = opendir('Applets/')) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") { 
$aplname = explode(".", $entry); 
$aplxml=json_decode(file_get_contents("Applets/" . $entry));
?> 
  <div class="modal fade" id="<?php echo $aplname[0]; ?>" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $aplname[0]; ?></h4>
        </div>
        <div class="modal-body">
<?php echo htmlspecialchars_decode($aplxml->code, ENT_QUOTES); ?>
</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<?php
}}}
if ($handle = opendir('MyApplets/')) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") { 
$aplname = explode(".", $entry); 
$aplxml=json_decode(file_get_contents("MyApplets/" . $entry));
?> 
  <div class="modal fade" id="M<?php echo $aplname[0]; ?>" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php echo $aplname[0]; ?></h4>
        </div>
        <div class="modal-body">
<?php echo htmlspecialchars_decode($aplxml->code, ENT_QUOTES); ?>
</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<?php
}}}
?>			
<script>
  $(function() {
    $( "#tabers" ).tabs({
      beforeLoad: function( event, ui ) {
        ui.jqXHR.fail(function() {
          ui.panel.html(
            "Couldn't load this tab. We'll try to fix this as soon as possible.");
        });
      }
    });
  });
  </script>
<script>
    function display_c() {
            var refresh=1000;
            mytime=setTimeout('display_ct()', refresh)
        }


    function display_ct() {
            var strcount;
            var xf5 = new Date();
            var date = xf5;
            var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'pm' : 'am';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = hours + ':' + minutes + ' ' + ampm;
            
            document.getElementById('ct').innerHTML = strTime;
            document.getElementById('dt').innerHTML = xf5.toDateString();
            tt=display_c();
        }
</script>
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
<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
</script>
  <?php
  if(isset($_GET['sec'])){
  if(file_exists($wd_type . '/' . $wd_app . '/ext.txt')){
  $wd = 1;
  if(file_exists($wd_extFile . "ext.json")){
    $obj = file_get_contents($wd_extFile . "ext.json");
    $obj = json_decode($obj); 
    $wd_prog = $wd_type . '/' . $wd_app;
    foreach($obj as $key => $value){
      if($wd_prog == $value){
        $wd = 0;
      }
    }
  }
  else{
    $wd = 1;
  }
  if($wd === 1){
  ?>
  <script type="text/javascript">
  $(document).ready(function() {
    $('#wd_ext').modal({
      show: true,
    })
  });
</script>
  <div id="wd_ext" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Set as Default</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="dext.php?type=<?php echo $wd_type; ?>&app=<?php echo $wd_app; ?>">
        <p>Would you like to set this app as the primary app to use the following ext:</p>
        <b><i><?php 
    $wd = file_get_contents($wd_type . '/' . $wd_app . '/ext.txt'); 
    $wd = explode(',', $wd); 
    foreach($wd as $entry){
      echo $entry;
      ?>
          <select name="<?php echo $entry; ?>">
            <option value="<?php echo $wd_type . '/' . $wd_app; ?>">Yes</option>
            <option value="no">No</option>
          </select>
          <?php
    } ?></i></b>
        <p>You can change you ext default app setting on your settings tab.</p>
        <input type="submit" value="Save" class="btn btn-success">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
  <?php
  }
  }
  }
    ?>
  
  <div id="wd_chatting" class="chat"><div class="container"><h3><button id="wd_hChat" class="btn btn-info"><span class="glyphicon glyphicon-chevron-down"></span></button> <button id="wd_fChat" class="btn btn-info"><span class="glyphicon glyphicon-resize-full"></span></button> <button id="wd_mChat" class="btn btn-info"><span class="glyphicon glyphicon-resize-small"></span></button> Chat</h3><div class="col-xs-4"><input type="text" id="wd_tChat" class="form-control" placeholder="Type you message here..."></div><button id="wd_bChat" class="btn btn-success">Send</button><br><div class="scroll"><div id="wd_chat"></div><div id="wd_sto_chat"></div></div></div></div>
  
<script>
  var oldD = "";
if(typeof(EventSource) !== "undefined") {
    var source = new EventSource("chat.php");
    source.onmessage = function(event) {
      if(oldD != event.data){
        if(typeof(Storage) !== "undefined") {
        var wd_sto_c = document.getElementById("wd_chat").innerHTML;
        wd_sto_c = wd_sto_c + sessionStorage.wd_chat;
        }
        document.getElementById("wd_chat").innerHTML = event.data + "<br>" + document.getElementById("wd_chat").innerHTML;
        oldD = event.data;
        if(typeof(Storage) !== "undefined") {
        sessionStorage.setItem("wd_chat", wd_sto_c);
        }
      }
    };
} else {
    document.getElementById("wd_chat").innerHTML = "Sorry, your browser does not support server-sent events...";
}
</script>
<script>
$(document).ready(function(){
  $(".chat").hide();
    $("#chat").click(function(){
        $(".chat").toggle();
    });
    $( "#wd_chatting" ).draggable();
    $( "#wd_chatting" ).resizable();
  $("#wd_hChat").click(function(){
    $(".chat").hide();
  });
    $("#wd_bChat").click(function(){
      var wd_ctext = $('#wd_tChat').val();
        $.post("chatSub.php",
        {
          chat: wd_ctext
        });
      $('#wd_tChat').val('');
    });
  $('#wd_tChat').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
       var wd_ctext = $('#wd_tChat').val();
        $.post("chatSub.php",
        {
          chat: wd_ctext
        });
      $('#wd_tChat').val('');  
    }
});
  if(typeof(Storage) !== "undefined") {
    if(sessionStorage.wd_chat != "undefined") {
  document.getElementById("wd_sto_chat").innerHTML = sessionStorage.wd_chat;
    }
  }
  $("#wd_t1Title").animate({fontSize: '3em', opacity: '0.4'}, "slow").animate({fontSize: '1em', opacity: '1'}, "slow").css("color", "white");
  $("#wd_mChat").hide();
$("#wd_fChat").click(function(){
  $("#wd_chatting").animate({bottom: '0px', width: '100%', height: '100%'}, "slow")
  $("#wd_fChat").hide();
  $("#wd_mChat").show();
});
$("#wd_mChat").click(function(){
  $("#wd_chatting").animate({bottom: '50px', width: '50%', height: '50%'}, "slow")
  $("#wd_mChat").hide();
  $("#wd_fChat").show();
});
});
</script>
<script src="Plugins/context.js"></script>
<?php
if(isset($_GET["app"])){
        if(file_exists($type . "/" . $app . "/script.js")){
          ?>
            <script src="<?php echo $type . "/" . $app . "/script.js"; ?>"></script>
                                                                                          <?php
		}
        if(isset($sec) && file_exists($type . "/" . $app . "/script_" . $sec)){
            ?>
            <script src="<?php echo $type . "/" . $app . "/script_" . $sec; ?>"></script>
  <?php
		}
    }
?>
</body>
</html>
