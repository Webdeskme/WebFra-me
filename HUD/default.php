<!DOCTYPE html>
<?php include 'HUDstart.php';?>
<html>
<head>
    <?php include 'HUDhead.php';?>
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
    <?php include 'HUDapp.php';?>
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
    <?php include 'HUDweb.php';?>
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
<?php include 'HUDalerts.php';?>
</div>
<div id="tabs-4" class="tab" style="background-color: <?php echo $color; ?>;">
    <?php include 'HUDsettings.php';?>
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
<?php include 'HUDtask.php';?>
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
<?php include 'HUDcon.php';?>
</div>
</div>
    </div>
</div>
<?php include 'HUDfoot.php';?>
</body>
</html>
