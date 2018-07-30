<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; } ?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>">Developer Portal: Apps</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="desktop.php">Back</a></li>
        <li class="active"><a href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>">Apps</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'startApl.php', ''); ?>">Applets</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'startTheme.php', ''); ?>">Themes</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'startGame.php', ''); ?>">Game</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'startHud.php', ''); ?>">HUD</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'startMhud.php', ''); ?>">MHUD</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
		<li><a href="#" data-toggle="collapse" data-target="#NewA">Create App</a></li>
	  </ul>
    </div>
  </div>
</nav>
<div id="NewA" class="collapse">
<form method="post" action="<?php wd_urlSub($wd_type, $wd_app, 'startSub.php', ''); ?>">
    <label for="nameA">New App Name: </label>
    <input type="text" name="nameA" for="nameA" class="form-control" placeholder="Enter the name of your new App." title="Enter the name of your new App.">
    <input type="submit" class="btn btn-success" value="Start">
</form>
</div>
<br>
    <div class="panel panel-primary">
      <div class="panel-heading"><b>My Apps</b></div>
      <div class="panel-body">
        <table class="table table-striped">
<?php
$x = 0;
foreach (scandir('MyApps/') as $entry){
                    if ($entry != "." && $entry != "..") {
?>
<tr><td>
<?php
$x=$x+1;
echo $x . ": ";
?>
    <a href="<?php wd_url($wd_type, $wd_app, 'MyApp.php', '&MyApp=' . $entry); ?>"><?php echo $entry; ?></a>
    </td></tr>
<?php
}
}
?>
            </table>
        </div>
    </div>
