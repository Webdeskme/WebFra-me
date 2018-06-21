<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
$_SESSION['root'] = getcwd() . '/';
//$_SESSION['root'] = '../../html';
if(isset($_GET['dir'])){$dir = test_input($_GET['dir']);}
else{ $dir = ""; }
?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>">Terminal Portal</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="desktop.php">Exit</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#" data-toggle="collapse" data-target="#Wadd"><span class="glyphicon glyphicon-plus"></span> Add</a></li>
        <li><?php wd_confirm($wd_type, $wd_app, 'startSubRemove.php', '&dir=' . $dir, '1', '<i class="glyphicon glyphicon-trash"> Delete</i>'); ?></li>
      </ul>
    </div>
  </div>
</nav>
 <ul class="breadcrumb">
  <li><a href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>">wd://root</a></li>
  <?php
  if(isset($_GET['dir']) && $_GET['dir'] != "" && $_GET['dir'] != "/"){
$bread = explode('/', $dir);
$valuex="";
foreach($bread as $value){
$valuex = $valuex . $value . '/';
$valuey = rtrim($valuex, '/');
?>
<li><a href="<?php wd_url($wd_type, $wd_app, 'start.php', '&dir=' . $valuey ); ?>"><?php echo $value; ?></a></li>
<?php
} }
if(isset($_GET['dir'])){$dir = $dir . '/';}
?>
 </ul>
<div id="Wadd" class="collapse">
  <div class="panel panel-success">
      <div class="panel-heading">Add New File/Directory</div>
      <div class="panel-body">
<form method="post" action="<?php echo wd_urlSub($wd_type, $wd_app, 'startSub.php', ''); ?>" class="form-group">
    <label for="nameA">New File/Directory Name: </label>
    <input type="hidden" name="dir" value="<?php echo $dir; ?>">
    <input type="text" name="nameA" class="form-control" for="nameA" placeholder="Enter the name of your new File." title="Enter the name of your new File.">
  <br>
    <select name="type" class="form-control">
        <option value="File">File</option>
        <option value="Directory">Directory</option>
    </select>
  <br>
    <input type="submit" class="btn btn-success" value="Start">
</form>
    </div>
  </div>
</div>
<?php if(isset($_SESSION["wd_copy_file"])){ ?><div><a href="<?php wd_urlSub($wd_type, $wd_app, 'pasteSub.php', '&dir=' . $dir); ?>"><span class="glyphicon glyphicon-paste"></span> Paste</a></div><?php } ?>
<br>
<div class="container">
  <div class="panel panel-primary">
    <div class="panel-heading">Directory: </div>
    <div class="panel-body">
      <table class="table table-striped">
        <?php
        if(isset($_GET['a'])){$a = test_input($_GET['a']); echo $a; }
        $x = 0;
        $ls = array();
        foreach (scandir($_SESSION['root'] . $dir) as $entry){
  
          if ($entry != "." && $entry != "..") {
            if(is_dir($dir . $entry))
              $ls["folders"][] = $entry;
            else
              $ls["files"][] = $entry;
          }
          
        }
        foreach($ls["folders"] as $entry){
          ?>
          <tr><td>
            <a href="<?php wd_url($wd_type, $wd_app, 'start.php', '&dir=' . $dir . $entry); ?>" style="color: #3333ff;"><i class="fa fa-folder fa-fw"></i> <?php echo $entry; ?></a><br>
          </td></tr>
          <?php 
        }
        if(isset($ls["files"])){
          natcasesort($ls["files"]);
          foreach($ls["files"] as $entry){
            $entry_parts = explode(".",$entry);
            ?>
            <tr><td>
              <a href="<?php wd_url($wd_type, $wd_app, 'MyPage.php', '&dir=' . $dir . '&file=' . $entry); ?>"><i class="fa fa-<?php if(preg_match("/jpg|gif|png|bmp|ico|svg/i", $entry_parts[1])) echo "image"; else if(preg_match("/php/i", explode(".",$entry)[1])) echo "file-code"; else echo "file"; ?> fa-fw"></i> <?php echo $entry; ?></a>
            </td></tr>
            <?php
          }
        }
  ?>
          
        </table>
      </div>
    </div>
  </div>
