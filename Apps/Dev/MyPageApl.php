<h1>Developer Portal</h1>
<?php 
$MyApp = test_input($_GET["MyApp"]); 
?>
<a href="<?php wd_url($wd_type, $wd_app, 'startApl.php', ''); ?>"><button class="btn btn-primary">Back</button></a>  
<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal">WD Functions</button> 
<a href="<?php wd_urlSub($wd_type, $wd_app, 'view.php', '&MyApp=' . $MyApp); ?>" target="_blank"><button class="btn btn-info btn-xs">View</button></a>
<a href="<?php wd_urlSub($wd_type, $wd_app, 'MyPageSubDelete.php', '&MyApp=' . $MyApp); ?>"><button class="btn btn-danger">Delete</button></a>
<br>
<h2><?php echo $MyApp . ": "; ?></h2>
<form method="post" action="<?php wd_urlSub($wd_type, $wd_app, 'MyPageAplSub.php', ''); ?>" style="width: 100%; height: 70%;">
    <label for="tooltip">ToolTip: </label><br>
    <input type="text" id="tooltip" name="tooltip" value="<?php 
if(file_exists("MyApplets/" . $MyApp)){
  $Obj=json_decode(file_get_contents('MyApplets/' . $MyApp));
    echo $Obj->tooltip;} 
?>">
<br>
<label for="icon">Icon: </label>
<br>
<input type="text" id="icon" name="icon" value="<?php echo $Obj->icon; ?>">
<br>
    <label for="con">New Applet Content: </label><br>
    <input type="hidden" name="nameA" value="<?php if(file_exists("MyApplets/" . $MyApp)){echo $MyApp;} ?>">
    <textarea name="con" id="con" placeholder="Enter your content." title="Enter your content." style="width: 90%; height:85%; background-color: #000000; color: #ffffff; font-weight: bold; font-size: 1.25em;"  autofocus><?php 
if(file_exists("MyApplets/" . $MyApp)){
//$Obj=simplexml_load_file('Applets/' . $MyApp) or die("Error: Cannot create object");
    echo $Obj->code;} 
?></textarea>
    <br>
    <input type="submit" class="btn btn-success" value="Save">
</form>
<br>
<?php
include("FunctionHelp.php");
?>
<script>
var myCodeMirror = CodeMirror.fromTextArea(con, {
lineNumbers: true,
  mode:  "php",
  theme: "abcdef",
matchBrackets: true,
matchTags: {bothTags: true},
lineWrapping: true,
foldGutter: true,
gutters: ["CodeMirror-linenumbers", "CodeMirror-foldgutter", "CodeMirror-lint-markers"],
lint: true,
extraKeys: {"Ctrl-Space": "autocomplete",
"F11": function(cm) {
          cm.setOption("fullScreen", !cm.getOption("fullScreen"));
        },
        "Esc": function(cm) {
          if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
        },
"Ctrl-J": "toMatchingTag"
}
});
</script>
