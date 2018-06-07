<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>">WebSite Builder</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>">Pages</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pcss.php', ''); ?>">CSS</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pheader.php', ''); ?>">Header</a></li>
        <li class="active"><a href="<?php wd_url($wd_type, $wd_app, 'pmedia.php', ''); ?>">Media</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pbanner.php', ''); ?>">Banner</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pfooter.php', ''); ?>">Footer</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'psettings.php', ''); ?>">Settings</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pplugins.php', ''); ?>">Plugins</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pthemes.php', ''); ?>">Themes</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'stats.php', ''); ?>">Stats</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'log.php', ''); ?>">Log</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#" data-toggle="collapse" data-target="#new"><span class="glyphicon glyphicon-cloud-upload"></span> Upload</a></li>
      </ul>
    </div>
  </div>
</nav>
<div id="new" class="collapse">
<form action="<?php wd_urlSub($wd_type, $wd_app, 'upload.php', ''); ?>" method="post" enctype="multipart/form-data">
    Select file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" class="btn btn-success" value="Upload" name="submit">
</form>
</div>
<p>Copy and paste this url for the media directly into your html element.</p>
<div class="panel panel-primary">
      <div class="panel-heading"><b>Media</b></div>
      <div class="panel-body">
        <table class="table table-striped">
<?php
$x = 0;
foreach (scandir('www/Media/') as $entry){
                    if ($entry != "." && $entry != "..") {
?>
<tr><td>
<?php
$x=$x+1;
echo "<b>" . $x . ": </b>";
?>
    <a href="www/Media/<?php echo $entry; ?>" target="_blank">www/Media/<?php echo $entry; ?></a>
  </td><td><?php wd_confirm($wd_type, $wd_app, 'mediaDelete.php', '&media=' . $entry, $x, '<i class="glyphicon glyphicon-trash"> Delete</i>'); ?></td></tr>
<?php
}
}
?>
            </table>
        </div>
    </div>