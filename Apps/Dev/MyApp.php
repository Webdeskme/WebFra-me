<?php $MyApp = test_input($_GET["MyApp"]); ?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>">Developer Portal: <?php echo $MyApp; ?></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>">Back</a></li>
        <li class="active"><a href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>">Apps</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'startApl.php', ''); ?>">Applets</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'startTheme.php', ''); ?>">Themes</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'startGame.php', ''); ?>">Games</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
		<li><a href="#" data-toggle="collapse" data-target="#newP"><span class="glyphicon glyphicon-pencil"></span> Add Page</a></li>
		<li><a href="#" data-toggle="collapse" data-target="#newI"><span class="glyphicon glyphicon-picture"></span> Add Icon</a></li>
        <li><button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">Publish</button></li> 
        <li><?php wd_confirm($wd_type, $wd_app, 'MyAppSubDelete.php', '&MyApp=' . $MyApp, '1', '<span class="glyphicon glyphicon-trash"></span> Delete'); ?></li>
      </ul>
    </div>
  </div>
</nav>
<!--<form method="POST" action="http://desktop.webdesk.me/marketSub.php">
    <input type="hidden" name="host" value="<?php if(isset($_SERVER['HTTPS'])){ echo "https://" . $_SERVER['SERVER_NAME']; } else{ echo "http://" . $_SERVER['SERVER_NAME']; } ?>">
    <input type="hidden" name="MyApp" value="<?php echo $MyApp; ?>">
    <input type="submit" value="Publish">
</form>-->
<div id="newP" class="collapse">
<form method="post" action="<?php wd_urlSub($wd_type, $wd_app, 'MyAppSub.php', ''); ?>">
    <div class="form-group">
        <label for="nameA">New Page Name: </label>
        <input type="hidden" name="nameA" value="<?php echo $MyApp; ?>">
        <input type="text" class="form-control" name="nameP" for="nameA" placeholder="Enter the name of your new Page." title="Enter the name of your new Page.">
        <input type="submit" class="btn btn-success" value="Start">
    </div>
</form>
</div>
<div id="newI" class="collapse">
<form action="<?php wd_urlSub($wd_type, $wd_app, 'upload.php', ''); ?>" method="post" enctype="multipart/form-data">
    Select png to upload as icon:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="hidden" name="app" value="<?php echo $MyApp; ?>">
    <input type="submit" class="btn btn-success" value="Upload" name="submit">
</form>
</div>
<?php if(isset($_SESSION["wd_copy_file"])){ ?><div><a href="<?php wd_urlSub($wd_type, $wd_app, 'pasteSub.php', '&MyApp=' . $MyApp); ?>"><span class="glyphicon glyphicon-paste"></span> Paste</a></div><?php } ?>
<br>
    <div class="panel panel-primary">
      <div class="panel-heading"><b>Files & Folders</b></div>
      <div class="panel-body">
          <table class="table table-striped">
<?php
$x = 0;
foreach (scandir('MyApps/' . $MyApp . '/') as $entry){
                    if ($entry != "." && $entry != "..") {
?>
<tr><td>
<?php
$x=$x+1;
echo $x . ": ";
?>
    <a href="<?php wd_url($wd_type, $wd_app, 'MyPage.php', '&MyApp=' . $MyApp . '&MyPage=' . $entry); ?>"><?php echo $entry; ?></a></td></tr>
<?php
}
}
?>
        </table>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Publish <?php echo $MyApp; ?></h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="http://webdesk.me/indexSub.php?page=marketSub.php">
          <input type="hidden" name="host" value="<?php if(isset($_SERVER['HTTPS'])){ echo "https://" . $_SERVER['SERVER_NAME']; } else{ echo "http://" . $_SERVER['SERVER_NAME']; } ?>">
          <input type="hidden" name="MyApp" value="<?php echo $MyApp; ?>">
          <div class="form-group">
            <label for="email">Email: </label>
            <div class="input-group margin-bottom-sm">
              <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
              <input type="email" id="email" name="email" class="form-control" placeholder="you@mail.com" required>
            </div>
          </div>
          <div class="form-group">
            <label for="pass">Password: </label>
            <div class="input-group margin-bottom-sm">
              <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
              <input type="password" id="pass" name="pass" class="form-control" placeholder="your password" required>
            </div>
          </div>
          <div class="form-group">
            <label for="cat">Category: </label>
            <select id="cat" name="cat" class="form-control">
              <option value="Accessories">Accessories</option>
              <option value="Education">Education</option>
              <option value="Graphics">Graphics</option>
              <option value="Internet">Internet</option>
              <option value="Office">Office</option>
              <option value="Other">Other</option>
              <option value="Programming">Programming</option>
              <option value="Sound Video">Sound Video</option>
              <option value="Administration">Administration</option>
            </select>
          </div>
          <div class="form-group">
            <label for="rate">Rating: </label>
            <select id="rate" name="rate" class="form-control">
              <option value="Everyone">Everyone</option>
              <option value="Teen">Teen</option>
              <option value="Mature">Mature</option>
            </select>
          </div>
          <div class="form-group">
            <label for="vr">Version: </label>
            <input type="number" step="0.01" id="vr" name="vr" class="form-control" placeholder="2.01" required>
          </div>
          <input type="submit" class="btn btn-success" value="Publish">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
