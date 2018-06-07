<?php
if(isset($_POST['nameP'])){
  $nameP = test_input($_POST['nameP']);
  file_put_contents("www/Pages/" . $nameP, "This is an empty page.");
  if(!file_exists("www/Pages/nav.json")){
  $obj = new stdClass;
  }
  else{
    $obj = file_get_contents("www/Pages/nav.json");
    $obj = json_decode($obj);
  }
  $pagen = array("par"=>"h", "pr"=>"9", "title"=>"New Page", "page"=>$nameP);
  $obj->$nameP = $pagen;
  $jobj = json_encode($obj);
  file_put_contents("www/Pages/nav.json", $jobj);
}
?>
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
        <li class="active"><a href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>">Pages</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'ppost.php', ''); ?>">Post</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pcss.php', ''); ?>">CSS</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pheader.php', ''); ?>">Header</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pmedia.php', ''); ?>">Media</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pbanner.php', ''); ?>">Banner</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pfooter.php', ''); ?>">Footer</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'psettings.php', ''); ?>">Settings</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pplugins.php', ''); ?>">Plugins</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pthemes.php', ''); ?>">Themes</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'stats.php', ''); ?>">Stats</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'log.php', ''); ?>">Log</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#" data-toggle="collapse" data-target="#NewP">Create Page</a></li>
      </ul>
    </div>
  </div>
</nav>
<div id="NewP" class="collapse">
<form method="post" action="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>">
    <label for="nameP">New Page Name: </label>
    <input type="text" name="nameP" for="nameP" class="form-control" placeholder="Enter the name of your new page." title="Enter the name of your new page.">
    <input type="submit" class="btn btn-success" value="Start">
</form>
</div>
<br>
<div class="panel panel-primary">
      <div class="panel-heading"><b>Pages</b></div>
      <div class="panel-body">
        <table class="table table-striped">
<?php
$x = 0;
foreach (scandir('www/Pages/') as $entry){
                    if ($entry != "." && $entry != ".." && $entry != "style.css" && $entry != "header.php" && $entry != "banner.php" && $entry != "feed.json" && $entry != "nav.json" && $entry != "footer.php") {
?>
<tr><td>
<?php
$x=$x+1;
echo $x . ": ";
?>
    <a href="<?php wd_url($wd_type, $wd_app, 'page.php', '&page=' . $entry); ?>"><?php echo $entry; ?></a>
    </td></tr>
<?php
}
}
?>
            </table>
        </div>
    </div>