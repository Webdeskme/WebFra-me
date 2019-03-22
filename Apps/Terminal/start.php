<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }

$_SESSION['root'] = getcwd() . '/';

if(isset($_GET['dir']))
  $dir = test_input($_GET['dir']);
else
  $dir = ""; 
?>
<nav class="navbar navbar-expand-md bg-light">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand text-dark" href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>"><img src="//<?php echo $_SERVER["HTTP_HOST"] ?>/Apps/Terminal/ic.png" width="24" class="img" /> Terminal Portal</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#terminalNavbar" aria-controls="terminalNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars fa-fw"></i>
      </button>
    </div>
    <div class="collapse justify-content-end navbar-collapse" id="terminalNavbar">
      <!--<ul class="navbar-nav">-->
      <!--  <li class="nav-item"><a href="desktop.php">Exit</a></li>-->
      <!--</ul>-->
      <ul class="navbar-nav justify-content-end">
        <li class="nav-item">
          
          <!--<button type="button" data-toggle="collapse" data-target="#Wadd" class="btn btn-link text-white"><i class="fa fa-plus fa-fw"></i> New</button>-->
          <!--<?php //wd_confirm($wd_type, $wd_app, 'startSubRemove.php', '&dir=' . $dir, '1', '<i class="fa fa-trash-alt fa-fw"></i> Delete'); ?>-->
          
        </li>
      </ul>
    </div>
  </div>
</nav>

<!--<div id="Wadd" class="collapse">-->
<!--  <div class="card">-->
<!--    <div class="card-header">Add New File/Directory</div>-->
<!--    <div class="card-body">-->
<!--      <form method="post" action="<?php echo wd_urlSub($wd_type, $wd_app, 'startSub.php', ''); ?>" class="form-group">-->
        
<!--        <input type="hidden" name="dir" value="<?php echo $dir; ?>" />-->
<!--        <div class="form-group">-->
<!--          <label for="nameA">New File/Directory Name: </label>-->
<!--          <div class="input-group">-->
<!--            <div class="input-group-prepend">-->
<!--              <select name="type" class="form-control custom-select">-->
<!--                <option value="File">File</option>-->
<!--                <option value="Directory">Directory</option>-->
<!--              </select>-->
<!--            </div>            -->
<!--            <input type="text" name="nameA" class="form-control" id="nameA" placeholder="Enter the name of your new File." title="Enter the name of your new file or directory" />-->
<!--            <div class="input-group-append">-->
<!--              <input type="submit" class="btn btn-success" value="Create" />-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
        
        
<!--      </form>-->
<!--    </div>-->
<!--  </div>-->
<!--</div>-->
<?php 
if(isset($_SESSION["wd_copy_file"])){ 
  ?>
  <div>
    <a href="<?php wd_urlSub($wd_type, $wd_app, 'pasteSub.php', '&dir=' . $dir); ?>"><span class="fa fa-paste"></span> Paste</a>
  </div>
  <?php 
} 
?>
<br />
<div class="container">
  <div class="card">
    <div class="card-header bg-primary">
      
      <div class="float-right">
        <button type="button" data-toggle="collapse" data-target="#Wadd" class="btn btn-link text-white"><i class="fa fa-plus fa-fw"></i> New</button> 
        <?php
        if(!empty($dir))
          wd_confirm($wd_type, $wd_app, 'startSubRemove.php', '&dir=' . $dir, '1', '<i class="fa fa-trash-alt fa-fw"></i> Delete directory');
        ?>
      </div>
      
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-primary m-0">
          <li class="breadcrumb-item text-white">Directory: <a href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>" class="text-white">wd_root</a></li>
          <?php
          if(isset($_GET['dir']) && $_GET['dir'] != "" && $_GET['dir'] != "/"){
            $bread = explode('/', $dir);
            $valuex="";
            foreach($bread as $key => $value){
              $valuex .= $value . '/';
              $valuey = rtrim($valuex, '/');
              
              ?>
              <li class="breadcrumb-item text-white <?php echo ($key == count($bread)-1) ? "active" : ""; ?>"><a href="<?php wd_url($wd_type, $wd_app, 'start.php', '&dir=' . $valuey ); ?>" class="text-white"><?php echo $value; ?></a></li>
              <?php
            } 
          }
          if(!empty($_GET['dir']))
            $dir = $dir . '/';
          
          ?>
        </ol>
      </nav>
      
    </div>
    <div class="card-body">
      <div id="Wadd" class="collapse">
        <div class="card">
          <div class="card-header">Add New File/Directory</div>
          <div class="card-body">
            <form method="post" action="<?php echo wd_urlSub($wd_type, $wd_app, 'startSub.php', ''); ?>" class="form-group">
              
              <input type="hidden" name="dir" value="<?php echo $dir; ?>" />
              <div class="form-group">
                <label for="nameA">New File/Directory Name: </label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <select name="type" class="form-control custom-select">
                      <option value="File">File</option>
                      <option value="Directory">Directory</option>
                    </select>
                  </div>            
                  <input type="text" name="nameA" class="form-control" id="nameA" placeholder="Enter the name of your new File." title="Enter the name of your new file or directory" />
                  <div class="input-group-append">
                    <input type="submit" class="btn btn-success" value="Create" />
                  </div>
                </div>
              </div>
              
              
            </form>
          </div>
        </div>
      </div>
      
      <table class="table table-striped">
        <?php
        if(isset($_GET['a'])){
          $a = test_input($_GET['a']); 
          echo $a; 
        }
        $countfilesfolders = 0;
        $ls = array();
        foreach (scandir($_SESSION['root'] . $dir) as $entry){
  
          if ($entry != "." && $entry != "..") {
            if(is_dir($dir . $entry))
              $ls["folders"][] = $entry;
            else
              $ls["files"][] = $entry;
              
            $countfilesfolders ++;
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
        if($countfilesfolders == 0)
          echo '<span class="text-muted">Directory listing empty</span>';
        ?>
      </table>
    </div>
  </div>
</div>
