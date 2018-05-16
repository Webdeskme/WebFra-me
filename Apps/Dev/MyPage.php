<?php 
$MyApp = test_input($_GET["MyApp"]); 
$MyPage = test_input($_GET["MyPage"]); 
?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>">Developer Portal: <?php echo $MyApp . "/" . $MyPage; ?></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="<?php wd_url($wd_type, $wd_app, 'MyApp.php', '&MyApp=' . $MyApp); ?>">Back</a></li>
        <li class="active"><a href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>">Apps</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'startApl.php', ''); ?>">Applets</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'startTheme.php', ''); ?>">Themes</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'startGame.php', ''); ?>">Games</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'startHud.php', ''); ?>">HUD</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'startMhud.php', ''); ?>">Mobile HUD</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-usd"></span> WD Functions</a></li>
        <li><a href="<?php wd_urlSub($wd_type, $wd_app, 'view.php', '&MyApp=' . $MyApp . '&MyPage=' . $MyPage); ?>" target="_blank"><span class="glyphicon glyphicon-file"></span> View</a></li>
        <li><?php wd_confirm($wd_type, $wd_app, 'MyPageSubDelete.php', '&MyApp=' . $MyApp . '&MyPage=' . $MyPage, '1', '<i class="glyphicon glyphicon-trash"> Delete</i>'); ?></li>
      </ul>
    </div>
  </div>
</nav>
<form method="post" action="<?php wd_urlSub($wd_type, $wd_app, 'MyPageSub.php', ''); ?>" style="width: 90%; height: 70%;">
    <label for="nameA">New Page Content: </label><br>
    <input type="hidden" name="nameA" value="<?php echo $MyApp; ?>">
    <input type="hidden" name="nameP" value="<?php echo $MyPage; ?>">
    <textarea name="con" id="con" for="con" placeholder="Enter your content." title="Enter your content." style="width: 100%; height:100%; background-color: #000000; color: #ffffff; font-weight: bold; font-size: 1.25em;"  autofocus><?php 
if(file_exists("MyApps/" . $MyApp . "/" . $MyPage)){
    echo htmlspecialchars(file_get_contents("MyApps/" . $MyApp . "/" . $MyPage));} 
?></textarea>
    <br>
    <input type="submit" class="btn btn-success" value="Save">
</form>
<br><br><br>
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
