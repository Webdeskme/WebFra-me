 <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Link: Folder Sharing</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="#">Back</a></li>
        <li<?php if(!isset($_GET['me'])){echo ' class="active"';} ?>><a href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>">Shared with</a></li>
        <li<?php if(isset($_GET['me'])){echo ' class="active"';} ?>><a href="<?php wd_url($wd_type, $wd_app, 'start.php', '&me=on'); ?>">Sharing</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#" title="Connect to folder" data-toggle="collapse" data-target="#connect"><span class="glyphicon glyphicon-transfer"></span></a></li>
        <li><a href="#" title="Share Folder" data-toggle="collapse" data-target="#link"><span class="glyphicon glyphicon-link"></span> <span class="glyphicon glyphicon-folder-open"></span></a></li>
      </ul>
    </div>
  </div>
</nav>
<div id="connect" class="collapse">
  <div class="panel panel-success">
    <div class="panel-heading"><b>Connect to a Folder</b></div>
      <div class="panel-body">
        <form method="post" action="<?php wd_urlSub($wd_type, $wd_app, 'startSubShare.php', ''); ?>">
          <div class="form-group">
          <label for="code"><b>Connection Code: </b></label>
          <input type="text" name="code" id="code" class="form-control" placeholder="Connection Code">
            <br>
          <input type="submit" value="Connect" class="btn btn-success">
          </div>
        </form>
    </div>
  </div>
</div>
<div id="link" class="collapse">
  <div class="panel panel-success">
      <div class="panel-heading">Share a Folder</div>
      <div class="panel-body">
          <a href="<?php wd_url('Apps', 'Files', 'start.php', '&prog=' . $wd_app . '&ptype=' . $wd_type . '&psec=start.php&pb=Share this folder'); ?>"><button class="btn btn-primary">Find Folder</button></a>
      </div>
  </div>
</div>
<?php
if(isset($_GET['pb'])){
  if(!file_exists($wd_appr . $wd_app . '/')){
    mkdir($wd_appr . $wd_app . '/');
  }
  $pb = test_input($_GET['pb']);
  function applink($pb, $wd_appr, $wd_app){
  $rand = rand(100000, 999999);
  $name = rand(1000, 9999);
  $file = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' . $name;
  $file = str_shuffle($file);
  $file = substr($file, 0, 6);
    $obj = array(
  'user' => $_SESSION["user"],
  'dirpath' => $pb,
  'pass' => $rand,
  'name' => $name,
  'type' => 'hide'
    );
  $con = json_encode($obj);
  if(!file_exists($wd_appr . $wd_app . '/' . $file . '.json')){
  file_put_contents($wd_appr . $wd_app . '/' . $file . '.json', $con);
  }
    else{
      applink($pb, $wd_appr, $wd_app);
    }
  }
  applink($pb, $wd_appr, $wd_app);
}
if(isset($_GET['me'])){
  foreach (scandir($wd_appr . $wd_app . '/') as $entry){
                    if ($entry != "." && $entry != "..") {
                      $dobj = file_get_contents($wd_appr . $wd_app . '/' . $entry);
                      $dobj = json_decode($dobj);
                      $user = $dobj->user;
                      $file = explode('.', $entry);
                      if($user == $_SESSION["user"]){
  ?>
<div class="panel panel-primary">
  <div class="panel-heading"><b><?php echo $dobj->name; ?></b><span style="float: right;"><?php wd_confirm($wd_type, $wd_app, 'startSubDelete.php', '&file=' . $entry, '2', '<i class="glyphicon glyphicon-trash"> Delete</i>'); ?></span></div>
      <div class="panel-body">
<form method="post" action="<?php wd_urlSub($wd_type, $wd_app, 'startSubSave.php', ''); ?>">
  <input type="hidden" name="dirpath" value="<?php echo $dobj->dirpath; ?>">
  <input type="hidden" name="file" value="<?php echo $entry; ?>">
  <b>FilePath: </b><i><?php echo $dobj->dirpath; ?></i>
  <span class="form-group">
    <b>Folder Name: </b>
    <input type="text" name='name' value="<?php echo $dobj->name; ?>" placeholer="Folder Name">
  </span>
  <span class="form-group">
    <b>Permissions: </b>
  <select name="type">
    <option value="hide"<?php if($dobj->type == 'hide'){ echo ' selected="selected"';} ?>>Hide</option>
    <option value="fa"<?php if($dobj->type == 'fa'){ echo ' selected="selected"';} ?>>Full Access</option>
    <option value="no"<?php if($dobj->type == 'no'){ echo ' selected="selected"';} ?>>No Add or Delete</option>
    <option value="up"<?php if($dobj->type == 'up'){ echo ' selected="selected"';} ?>>Upload Only</option>
  </select>
    </span>
  <span class="form-group">
    <b>Folder Password: </b>
    <input type="text" name='pass' value="<?php echo $dobj->pass; ?>" placeholer="Folder Password">
  </span>
  <input type="submit" value="Save" class="btn btn-success">
</form>
        </div>
  <div class="panel-footer"><b>Connection Code to Share: </b><?php echo $file[0] . '-' . $dobj->pass; ?><a href="<?php wd_url($wd_type, $wd_app, "clients.php", "&file=" . $entry); ?>"><button  class="btn btn-info" style="float: right;">Clients</button></a></div>
  </div>
<?php
                    }}}
}
else{
  if(file_exists($wd_appFile . $wd_app . '/' . $wd_app . '.json')){
    $dobj = file_get_contents($wd_appFile . $wd_app . '/' . $wd_app . '.json');
    $dobj = json_decode($dobj);
    foreach($dobj as $key => $entry){
      $sep = explode('-', $key);
      ?>
<div class="panel panel-primary">
  <div class="panel-heading"><b><?php echo $entry; ?></b><span style="float: right;"><?php wd_confirm($wd_type, $wd_app, 'startSubShareDelete.php', '&file=' . $key, '2', '<i class="glyphicon glyphicon-trash"> Delete</i>'); ?></span></div>
      <div class="panel-body">
        <?php
      if(file_exists($wd_appr . $wd_app . '/' . $sep[0] . '.json')){
      $MyObj = file_get_contents($wd_appr . $wd_app . '/' . $sep[0] . '.json');
      $MyObj = json_decode($MyObj);
      if($MyObj->pass == $sep[1]){
          ?>
        <a href="<?php wd_url('Apps', 'Files', 'start.php', '&link=' . $key); ?>" title="View Folder"><button class="btn btn-primary">View Folder</button></a>
        <?php
      }
      }
      else{
        echo 'This folder has been removed.';
      }
      ?>
        </div>
  </div>
<?php
    }
  }
}
?>