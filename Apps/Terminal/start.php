<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
$_SESSION['root'] = getcwd() . '/';
//$_SESSION['root'] = '../../html';
if(isset($_GET['dir'])){$dir = test_input($_GET['dir']);}
else{ $dir = ""; }
?>
<nav class="webdesk_navbar webdesk_navbar-expand-md webdesk_bg-light">
  <div class="webdesk_container-fluid">
    <div class="webdesk_navbar-header">
      <a class="webdesk_navbar-brand" href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>">Terminal Portal</a>
      <button class="webdesk_navbar-toggler" type="button" data-toggle="webdesk_collapse" data-target="#terminalNavbar" aria-controls="terminalNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars fa-fw"></i>
      </button>
    </div>
    <div class="webdesk_collapse webdesk_justify-content-end webdesk_navbar-collapse" id="terminalNavbar">
      <!--<ul class="webdesk_navbar-nav">-->
      <!--  <li class="webdesk_nav-item"><a href="desktop.php">Exit</a></li>-->
      <!--</ul>-->
      <ul class="webdesk_navbar-nav webdesk_mr-auto">
        <li class="webdesk_nav-item">
          
          <button type="button" data-toggle="webdesk_collapse" data-target="#Wadd" class="webdesk_btn webdesk_btn-secondary"><i class="fa fa-plus fa-fw"></i> New</a>
          <?php wd_confirm($wd_type, $wd_app, 'startSubRemove.php', '&dir=' . $dir, '1', '<i class="fa fa-trash-alt fa-fw"></i> Delete'); ?>
          
        </li>
      </ul>
    </div>
  </div>
</nav>
 <ul class="webdesk_breadcrumb webdesk_sticky-top">
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
<div id="Wadd" class="webdesk_collapse">
  <div class="webdesk_card">
    <div class="webdesk_card-header">Add New File/Directory</div>
    <div class="webdesk_card-body">
      <form method="post" action="<?php echo wd_urlSub($wd_type, $wd_app, 'startSub.php', ''); ?>" class="form-group">
        <label for="nameA">New File/Directory Name: </label>
        <input type="hidden" name="dir" value="<?php echo $dir; ?>">
        <input type="text" name="nameA" class="webdesk_form-control" for="nameA" placeholder="Enter the name of your new File." title="Enter the name of your new File.">
        <br>
        <select name="type" class="webdesk_form-control webdesk_custom-select">
            <option value="File">File</option>
            <option value="Directory">Directory</option>
        </select>
        <br>
        <input type="submit" class="webdesk_btn webdesk_btn-success" value="Start">
      </form>
    </div>
  </div>
</div>
<?php if(isset($_SESSION["wd_copy_file"])){ ?><div><a href="<?php wd_urlSub($wd_type, $wd_app, 'pasteSub.php', '&dir=' . $dir); ?>"><span class="glyphicon glyphicon-paste"></span> Paste</a></div><?php } ?>
<br>
<div class="webdesk_container">
  <div class="webdesk_card">
    <div class="webdesk_card-header webdesk_bg-primary webdesk_text-white">Directory: </div>
    <div class="webdesk_card-body">
      <table class="webdesk_table webdesk_table-striped">
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
        if(isset($ls["folders"])){
          foreach($ls["folders"] as $entry){
            ?>
            <tr><td>
              <a href="<?php wd_url($wd_type, $wd_app, 'start.php', '&dir=' . $dir . $entry); ?>" style="color: #3333ff;"><i class="fa fa-folder fa-fw"></i> <?php echo $entry; ?></a><br>
            </td></tr>
            <?php 
          }
        }
        if(isset($ls["files"])){
          natcasesort($ls["files"]);
          foreach($ls["files"] as $entry){
            $entry_parts = explode(".",$entry);
            ?>
            <tr><td>
              <a href="<?php wd_url($wd_type, $wd_app, 'MyPage.php', '&dir=' . $dir . '&file=' . $entry); ?>"><i class="fa fa-<?php if(!empty($entry_parts[1]) && preg_match("/jpg|gif|png|bmp|ico|svg/i", $entry_parts[1])) echo "image"; else if(!empty($entry_parts[1]) && preg_match("/php|js|css|json/i", explode(".",$entry)[1])) echo "file-code"; else if(!empty($entry_parts[1]) && preg_match("/mov|mp4/i", explode(".",$entry)[1])) echo "film"; else echo "file"; ?> fa-fw"></i> <?php echo $entry; ?></a>
            </td></tr>
            <?php
          }
        }
  ?>
          
        </table>
      </div>
    </div>
  </div>
