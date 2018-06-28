<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }

$_SESSION['root'] = getcwd() . '/';

if(isset($_GET['dir']))
  $dir = test_input($_GET['dir']);
else
  $dir = ""; 
?>
<nav class="webdesk_navbar webdesk_navbar-expand-md webdesk_bg-light">
  <div class="webdesk_container-fluid">
    <div class="webdesk_navbar-header">
      <a class="webdesk_navbar-brand webdesk_text-dark" href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>"><img src="//<?php echo $_SERVER["HTTP_HOST"] ?>/Apps/Terminal/ic.png" width="24" class="webdesk_img" /> Terminal Portal</a>
      <button class="webdesk_navbar-toggler" type="button" data-toggle="webdesk_collapse" data-target="#terminalNavbar" aria-controls="terminalNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars fa-fw"></i>
      </button>
    </div>
    <div class="webdesk_collapse webdesk_justify-content-end webdesk_navbar-collapse" id="terminalNavbar">
      <!--<ul class="webdesk_navbar-nav">-->
      <!--  <li class="webdesk_nav-item"><a href="desktop.php">Exit</a></li>-->
      <!--</ul>-->
      <ul class="webdesk_navbar-nav webdesk_justify-content-end">
        <li class="webdesk_nav-item">
          
          <!--<button type="button" data-toggle="webdesk_collapse" data-target="#Wadd" class="webdesk_btn webdesk_btn-link webdesk_text-white"><i class="fa fa-plus fa-fw"></i> New</button>-->
          <!--<?php //wd_confirm($wd_type, $wd_app, 'startSubRemove.php', '&dir=' . $dir, '1', '<i class="fa fa-trash-alt fa-fw"></i> Delete'); ?>-->
          
        </li>
      </ul>
    </div>
  </div>
</nav>

<!--<div id="Wadd" class="webdesk_collapse">-->
<!--  <div class="webdesk_card">-->
<!--    <div class="webdesk_card-header">Add New File/Directory</div>-->
<!--    <div class="webdesk_card-body">-->
<!--      <form method="post" action="<?php echo wd_urlSub($wd_type, $wd_app, 'startSub.php', ''); ?>" class="form-group">-->
        
<!--        <input type="hidden" name="dir" value="<?php echo $dir; ?>" />-->
<!--        <div class="form-group">-->
<!--          <label for="nameA">New File/Directory Name: </label>-->
<!--          <div class="webdesk_input-group">-->
<!--            <div class="webdesk_input-group-prepend">-->
<!--              <select name="type" class="webdesk_form-control webdesk_custom-select">-->
<!--                <option value="File">File</option>-->
<!--                <option value="Directory">Directory</option>-->
<!--              </select>-->
<!--            </div>            -->
<!--            <input type="text" name="nameA" class="webdesk_form-control" id="nameA" placeholder="Enter the name of your new File." title="Enter the name of your new file or directory" />-->
<!--            <div class="webdesk_input-group-append">-->
<!--              <input type="submit" class="webdesk_btn webdesk_btn-success" value="Create" />-->
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
<div class="webdesk_container">
  <div class="webdesk_card">
    <div class="webdesk_card-header webdesk_bg-primary">
      
      <div class="webdesk_float-right">
        <button type="button" data-toggle="webdesk_collapse" data-target="#Wadd" class="webdesk_btn webdesk_btn-link webdesk_text-white"><i class="fa fa-plus fa-fw"></i> New</button> 
        <?php
        if(!empty($dir))
          wd_confirm($wd_type, $wd_app, 'startSubRemove.php', '&dir=' . $dir, '1', '<i class="fa fa-trash-alt fa-fw"></i> Delete directory');
        ?>
      </div>
      
      <nav aria-label="breadcrumb">
        <ol class="webdesk_breadcrumb webdesk_bg-primary webdesk_m-0">
          <li class="webdesk_breadcrumb-item webdesk_text-white">Directory: <a href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>" class="webdesk_text-white">wd_root</a></li>
          <?php
          if(isset($_GET['dir']) && $_GET['dir'] != "" && $_GET['dir'] != "/"){
            $bread = explode('/', $dir);
            $valuex="";
            foreach($bread as $key => $value){
              $valuex .= $value . '/';
              $valuey = rtrim($valuex, '/');
              
              ?>
              <li class="webdesk_breadcrumb-item webdesk_text-white <?php echo ($key == count($bread)-1) ? "webdesk_active" : ""; ?>"><a href="<?php wd_url($wd_type, $wd_app, 'start.php', '&dir=' . $valuey ); ?>" class="webdesk_text-white"><?php echo $value; ?></a></li>
              <?php
            } 
          }
          if(!empty($_GET['dir']))
            $dir = $dir . '/';
          
          ?>
        </ol>
      </nav>
      
    </div>
    <div class="webdesk_card-body">
      <div id="Wadd" class="webdesk_collapse">
        <div class="webdesk_card">
          <div class="webdesk_card-header">Add New File/Directory</div>
          <div class="webdesk_card-body">
            <form method="post" action="<?php echo wd_urlSub($wd_type, $wd_app, 'startSub.php', ''); ?>" class="form-group">
              
              <input type="hidden" name="dir" value="<?php echo $dir; ?>" />
              <div class="form-group">
                <label for="nameA">New File/Directory Name: </label>
                <div class="webdesk_input-group">
                  <div class="webdesk_input-group-prepend">
                    <select name="type" class="webdesk_form-control webdesk_custom-select">
                      <option value="File">File</option>
                      <option value="Directory">Directory</option>
                    </select>
                  </div>            
                  <input type="text" name="nameA" class="webdesk_form-control" id="nameA" placeholder="Enter the name of your new File." title="Enter the name of your new file or directory" />
                  <div class="webdesk_input-group-append">
                    <input type="submit" class="webdesk_btn webdesk_btn-success" value="Create" />
                  </div>
                </div>
              </div>
              
              
            </form>
          </div>
        </div>
      </div>
      
      <table class="webdesk_table webdesk_table-striped">
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
          echo '<span class="webdesk_text-muted">Directory listing empty</span>';
        ?>
      </table>
    </div>
  </div>
</div>
