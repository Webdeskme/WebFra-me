<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="#">Files</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Back</a></li>
        <?php if(isset($_SESSION["wd_copy_file"])){ ?><li><a href="<?php wd_urlSub($wd_type, $wd_app, 'pasteSub.php', '&dir=' . $dir); ?>"><span class="glyphicon glyphicon-paste"></span> Paste</a></li><?php } ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
		  <?php
		  if(!isset($_GET['link']) || (isset($_GET['link']) && $obj->type == "fa")){
		  ?>
        <li><a href="#" data-toggle="tooltip" title="Remove files or folders" id="show"><span class="glyphicon glyphicon-remove"> </span><span class="glyphicon glyphicon-file"></span>/<span class="glyphicon glyphicon-folder-close"></span></a></li>
        <li><a href="#" data-toggle="tooltip" title="Download files" id="Dshow"><span class="glyphicon glyphicon-cloud-download"></span><span class="glyphicon glyphicon-file"></span>/<span class="glyphicon glyphicon-folder-close"></span></a></li>
        <li><a href="#" data-toggle="collapse" data-target="#uWeb" title="Upload from Web"><span class="glyphicon glyphicon-globe"></span><span class="glyphicon glyphicon-cloud-upload"></span></a></li>
        <li><a href="#" data-toggle="collapse" data-target="#ufile" title="Upload File"><span class="glyphicon glyphicon-file"></span><span class="glyphicon glyphicon-cloud-upload"></span></a></li>
        <li><a href="#" data-toggle="collapse" data-target="#afolder" title="Add folder"><span class="glyphicon glyphicon-plus"></span><span class="glyphicon glyphicon-folder-close"></span></a></li>
        <li><a href="#" data-toggle="collapse" data-target="#afile" title="Add file"><span class="glyphicon glyphicon-plus"></span><span class="glyphicon glyphicon-file"></span></a></li>
        <?php
	}
        ?>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'search.php', ''); ?>" data-toggle="tooltip" title="Search"><span class="glyphicon glyphicon-search"></span></a></li>
      </ul>
    </div>
  </div>
</nav>
<?php 
//ini_set("error_reporting", E_ALL);
if(isset($_GET['dir'])){$dir = test_input($_GET['dir']);} else{$dir = "";} ?>
<div style="width: 100%; height: 100%; padding: 0px; margin: 0px;">
<h1>Files: <a href="<?php wd_url($wd_type, $wd_app, 'start.php', $wd_url); ?>">/</a> <?php
if($dir != ""){
$dir=rtrim($dir, '/');
$dir=ltrim($dir, '/');
$bread = explode('/', $dir); 
$valuex=""; 
foreach($bread as $value){
$valuex = $valuex . $value . '/';
//$valuey = rtrim($valuex, '/'); 
?><a href="<?php wd_url($wd_type, $wd_app, 'start.php', '&dir=' . $valuex); ?>"><?php echo $value; ?>/</a> 
<?php 
} }
if(isset($_GET['dir'])){$dir = $dir . '/';}
?></h1>
<?php
if(isset($_GET['pb']) and isset($_GET['prog']) and isset($_GET['ptype']) and isset($_GET['psec'])){
$pb = test_input($_GET['pb']); $prog = test_input($_GET['prog']); $ptype = test_input($_GET['ptype']); $psec = test_input($_GET['psec']);
?>
<div><a href="<?php wd_url($ptype, $prog, $psec, '&pb=' . $dir); ?>"><?php echo $pb;  ?></a></div><br>
<?php
}
?>
<!--<?php if(isset($_SESSION["wd_copy_file"])){ ?><div><a href="<?php wd_urlSub($wd_type, $wd_app, 'pasteSub.php', '&dir=' . $dir); ?>">Paste</a></div><?php } ?>
<details style="float: left;">
    <summary>Remove Files/Folders | </summary>
<button id="show">Remove Files/Folders</button>
</details>
<details style="float: left;">
    <summary>Download File | </summary>
<button id="Dshow">Download File</button>
</details>-->
    <div id="afolder" class="collapse">
<form style="float: left;" method="post" action="<?php wd_urlSub($wd_type, $wd_app, 'dirSub.php', '&dir=' . $dir); ?>">
    <input type="text" name="name" placeholder="Make Folder">
    <input type="submit" value="create">
</form>
  </div>
<div id="afile" class="collapse">
<form style="float: left;" method="post" action="<?php wd_urlSub($wd_type, $wd_app, 'fileSub.php', '&dir=' . $dir); ?>">
    <input type="text" name="name" placeholder="File_Name.txt">
    <input type="submit" value="create">
</form>
  </div>
<div id="ufile" class="collapse">
<form style="float: left;" action="<?php wd_urlSub($wd_type, $wd_app, 'upload.php', $wd_url);  ?>" method="post" enctype="multipart/form-data">
    <span style="float: left;">Select a file to upload:</span>
    <input type="hidden" name="dir" value="<?php echo $dir; ?>">
    <input type="file" style="float: left;" name="fileToUpload" id="fileToUpload">
    <input type="submit" style="float: left;" value="Upload Image" name="submit" class="btn btn-success">
</form>
</div>
  <div id="uWeb" class="collapse">
<form method="post" action="#">
  <input type="url" name="url" placeholder="URL">
  <input type="text" name="temp" placeholder="file name">
  <input type="submit" value="Download to files root directory" class="btn btn-success">
</form>
<?php 
if(isset($_POST['url']) && $_POST['temp']){
file_put_contents($wd_file . $_POST['temp'], fopen($_POST['url'], 'r'));
//echo 'done';
}
?>
</div>
<!--<form method="POST" action="">
    <select name="view" style="float: right;">
        <option value="icon">Icon</option>
        <option value="list">List</option>
    </select>
</form>-->
<br>
<div id="files">

<?php
$wd = 0;
if ($handle = opendir($wd_file . $dir)) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
$wd = $wd + 1;
?>
<script>
$(document).ready(function(){
$( window ).on( "load", function(){
        $("#hide<?php echo $wd; ?>").hide();
});
    $("#show").click(function(){
        $("#hide<?php echo $wd; ?>").toggle();
        $("#Dhide<?php echo $wd; ?>").hide();
    });

$( window ).on( "load", function(){
        $("#Dhide<?php echo $wd; ?>").hide();
});
    $("#Dshow").click(function(){
        $("#Dhide<?php echo $wd; ?>").toggle();
        $("#hide<?php echo $wd; ?>").hide();
    });
});
</script>
<?php
                        if(!is_dir($wd_file . $dir . $entry)){
?>
<script>
  $( function() {
    $( "#draggable<?php echo $wd; ?>" ).draggable();
  } );
</script>
<?php
$newEntry = explode('.', $entry); 
if(isset($newEntry[1])){$wd_extE = $newEntry[1];}
else{$wd_extE = "";}

if(isset($_GET['prog']) and isset($_GET['ptype']) and isset($_GET['psec'])){
$prog = test_input($_GET['prog']); 
$ptype = test_input($_GET['ptype']); 
$psec = test_input($_GET['psec']); 
//$newEntry = explode('.', $entry);
}
elseif(file_exists($wd_extFile . "ext.json")){ 
  $obj = file_get_contents($wd_extFile . "ext.json");
  $obj = json_decode($obj); 
  if(isset($obj->$wd_extE)){
	$gr = $obj->$wd_extE;
	$gr1 = explode('/', $gr);
	$ptype = $gr1[0];
	$prog = $gr1[1];
	$psec = 'start.php';
  }
  else{
$ptype = 'Apps'; 
$prog = 'Viewer'; 
$psec = 'start.php';
}
} 
else{
$ptype = 'Apps'; 
$prog = 'Viewer'; 
$psec = 'start.php';
}
?>
<figure style="float: left; padding: 10px;" id="draggable<?php echo $wd; ?>">
<a href="<?php wd_url($ptype, $prog, $psec, '&title=' . $dir . $entry . '&dir=' . $dir . '&entry=' . $entry); ?>" data-toggle="tooltip" title="<?php echo $entry; ?>"><img src="<?php echo $ptype . '/' . $prog; ?>/ic.png" style="height: 50px; width: 50px; padding: 2px;"><br><?php if(strlen($entry) > 8){echo substr($entry,0,8);} else{echo $entry;} ?></a><br><a href="<?php wd_urlSub($wd_type, $wd_app, 'removeSub.php', '&dir=' . $dir . '&file=' . $entry); ?>" id="hide<?php echo $wd; ?>">Remove <?php echo $wd_extE; ?></a><a href="<?php wd_urlSub($wd_type, $wd_app, 'download.php', '&dir=' . $dir . '&file=' . $entry); ?>" id="Dhide<?php echo $wd; ?>">Download <?php echo $wd_extE; ?></a></figure>
<script>
$(document).ready(function(){

context.init({preventDoubleContext: false});

context.settings({compress: true});

context.attach('#draggable<?php echo $wd; ?>', [
{header: 'Menu'},
{text: 'Go To', href: '<?php wd_url($ptype, $prog, $psec, '&title=' . $dir . $entry . '&dir=' . $dir . '&entry=' . $entry); ?>'},
{text: 'Download', href: '<?php wd_urlSub($wd_type, $wd_app, 'download.php', '&dir=' . $dir . '&file=' . $entry); ?>'},
{text: 'Copy', href: '<?php wd_urlSub($wd_type, $wd_app, 'copySub.php', '&dir=' . $dir . '&file=' . $entry); ?>'},
{divider: true},
{text: 'Delete', href: '<?php wd_urlSub($wd_type, $wd_app, 'removeSub.php', '&dir=' . $dir . '&file=' . $entry); ?>'},
{divider: true}
]);

});
context.init({
fadeSpeed: 100, // The speed in which the context menu fades in (in milliseconds)
filter: function ($obj){}, // Function that each finished list element will pass through for extra modification.
above: 'auto', // If set to 'auto', menu will appear as a "dropup" if there is not enough room below it. Settings to true will make the menu a "<a href="http://www.jqueryscript.net/tags.php?/popup/">popup</a>" by default.
preventDoubleContext: true, // If set to true, browser-based context menus will not work on contextjs menus.
compress: false // If set to true, context menus will have less padding, making them (hopefully) more unobtrusive
});
</script>
<?php
}
else{
if(isset($_GET['prog']) and isset($_GET['ptype']) and isset($_GET['psec'])){$prog = test_input($_GET['prog']); $ptype = test_input($_GET['ptype']); $psec = test_input($_GET['psec']); $wd1 = '&prog=' . $prog . '&ptype=' . $ptype . '&psec=' . $psec;  
}
else{$wd1 = "";}
?>
<script>
  $( function() {
    $( "#droppable<?php echo $wd; ?>" ).droppable();
  } );
</script>
<figure style="float: left; padding: 10px;" id="droppable<?php echo $wd; ?>">
<a href="<?php wd_url($wd_type, $wd_app, 'start.php', '&dir=' . $dir . $entry . '/' . $wd1); if(isset($_GET['pb'])){echo '&pb=' . $pb; } ?>"><img src="Apps/Files/ic.png" style="height: 50px; width: 50px; padding: 2px;"><br><?php if(strlen($entry) > 8){echo substr($entry,0,8);} else{echo $entry;} ?></a><br><a href="<?php wd_urlSub($wd_type, $wd_app, 'removeSub.php', '&dir=' . $dir . '&file=' . $entry); ?>" id="hide<?php echo $wd; ?>">Remove</a></figure>
<script>
$(document).ready(function(){

context.init({preventDoubleContext: false});

context.settings({compress: true});

context.attach('#droppable<?php echo $wd; ?>', [
{header: 'Menu'},
{text: 'Go To', href: '<?php wd_url($wd_type, $wd_app, 'start.php', '&dir=' . $dir . $entry . '/' . $wd1); if(isset($_GET['pb'])){echo '&pb=' . $pb; } ?>'},
{text: 'Copy', href: '<?php wd_urlSub($wd_type, $wd_app, 'copySub.php', '&dir=' . $dir . '&file='. $entry . '/'); ?>'},
{divider: true},
{text: 'Delete', href: '<?php wd_urlSub($wd_type, $wd_app, 'removeSub.php', '&dir=' . $dir . '&file=' . $entry); ?>'},
{divider: true}
]);

});
context.init({
fadeSpeed: 100, // The speed in which the context menu fades in (in milliseconds)
filter: function ($obj){}, // Function that each finished list element will pass through for extra modification.
above: 'auto', // If set to 'auto', menu will appear as a "dropup" if there is not enough room below it. Settings to true will make the menu a "<a href="http://www.jqueryscript.net/tags.php?/popup/">popup</a>" by default.
preventDoubleContext: true, // If set to true, browser-based context menus will not work on contextjs menus.
compress: false // If set to true, context menus will have less padding, making them (hopefully) more unobtrusive
});
</script>
<?php
}

}}}
?>
</div>
<form method="post" action="">
<input type="hidden" name="file" id="hfile" val="">
<input type="hidden" name="dir" id="hdir" val="">
</form>
</div>
<?php if(isset($_SESSION["wd_copy_file"])){ ?>
<script>
$(document).ready(function(){

context.init({preventDoubleContext: false});

context.settings({compress: true});

context.attach('#files', [
{header: 'Menu'},
{text: 'Paste', href: '<?php wd_urlSub($wd_type, $wd_app, 'pasteSub.php', '&dir=' . $dir); ?>'},
{text: 'Disable This Menu', action: function(e){
e.preventDefault();
context.destroy('html');
alert('html contextual menu destroyed!');
}}
]);

});
context.init({
fadeSpeed: 100, // The speed in which the context menu fades in (in milliseconds)
filter: function ($obj){}, // Function that each finished list element will pass through for extra modification.
above: 'auto', // If set to 'auto', menu will appear as a "dropup" if there is not enough room below it. Settings to true will make the menu a "<a href="http://www.jqueryscript.net/tags.php?/popup/">popup</a>" by default.
preventDoubleContext: true, // If set to true, browser-based context menus will not work on contextjs menus.
compress: false // If set to true, context menus will have less padding, making them (hopefully) more unobtrusive
});
</script>
<?php
}
?>
