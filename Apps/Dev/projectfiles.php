<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
include_once("config.inc.php");
include("appHeader.php");

if(!empty($req["editType"]) && !empty($req["editApp"])){
  
  $wd_dt->loadApp($req["editType"], $req["editApp"]);

  ?>
  <div class="bg-light border-top p-2">
    <div class="float-right">
      
      <div class="btn-group">
        <a href="<?php echo wd_url(test_input($_GET["editType"]), test_input($_GET["editApp"]), 'start.php', ''); ?>" target="_blank" class="btn btn-secondary text-white" title="Preview app in a new window" data-toggle="tooltip">
          <i class="fa fa-eye fa-fw"></i> Preview
        </a>
        <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
          <a href="#publishAppModal" class="dropdown-item" data-toggle="modal" title="Publish to Marketplace">
            <i class="fa fa-shipping-fast fa-fw"></i> Publish
          </a>
          <a href="<?php echo wd_urlSub($wd_type, $wd_app, 'projectFilesSub.php', '&f=export&editType=' . $req["editType"] . '&editApp=' . $req["editApp"]); ?>" target="_blank" class="dropdown-item" title="Export app files to a zip" data-toggle="tooltip">
            <i class="fa fa-download fa-fw"></i> Export
          </a>
          <div class="dropdown-divider"></div>
          <a href="#removeAppModal" class="dropdown-item" data-toggle="modal" title="Remove app from Webframe">
            <i class="fa fa-trash fa-fw"></i> Remove project
          </a>
        </div>
      </div>
    </div>
    <!--<h4>-->
    <?php
      /*
      if(file_exists($req["editType"] . '/' . $req["editApp"] . '/ic.png')){
        ?>
        <img src="//<?php echo $_SERVER["HTTP_HOST"] ?>/<?php echo $req["editType"] ?>/<?php echo $req["editApp"] ?>/ic.png" class="img" width="25" /> &nbsp; 
        <?php
      }
      */
    ?>
    <!--  <?php echo $wd_dt->getProjName() ?>-->
    <!--</h4>-->
    
    <div class="dropdown">
      <button class="btn btn-light shadow" type="button" id="projectSelectMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img src="<?php echo $wd_dt->getProjIcon(); ?>" class="img" width="25" /> &nbsp; <?php echo $wd_dt->getProjName() ?>
      </button>
      <div class="dropdown-menu" aria-labelledby="projectSelectMenuButton">
        <a class="dropdown-item" href="<?php wd_url($wd_type, $wd_app, 'start.php', '') ?>">Project Dashboard</a>
        <div class="dropdown-divider"></div>
        <?php
        $dt_my_apps = $wd_dt->getLocalProjects($req["editType"]);
        foreach($dt_my_apps as $key => $myproject){
          ?>
          <a class="dropdown-item" href="<?php wd_url($wd_type, $wd_app, 'projectfiles.php', '&editType=' . $req["editType"] . '&editApp=' . $myproject["handle"]) ?>"><?php echo $myproject["name"] ?></a>
          <?php
        }
        ?>
      </div>
    </div>
    
    
  </div>
  
  <div class="container my-5">
    
    <div class="dropdown">
      <?php
      $last = "Files and folders";
      if(!empty($req["dir"])){
        
        ?>
        <a class="btn btn-link" href="<?php wd_url($wd_type, $wd_app, 'projectfiles.php', '&editType=' . $req["editType"] . '&editApp=' . $req["editApp"]); ?>">
          Files &amp; Folders
        </a>
        
        <i class="fa fa-caret-right fa-fw"></i>
        
        <?php
        
        $dir = explode("/", $req["dir"]);
        foreach($dir as $key => $value){
          
          $cwd[] = $value;
          
          if(!empty($dir[$key+1])){
            ?>
            <a class="btn btn-link" href="<?php wd_url($wd_type, $wd_app, 'projectfiles.php', '&editType=' . $req["editType"] . '&editApp=' . $req["editApp"] . '&dir=' . implode("/", $cwd)) ?>">
              <?php echo $value ?>
            </a>
            &nbsp;
            <i class="fa fa-caret-right fa-fw"></i>
            &nbsp;
            <?php
          }
          $last = $value;
          
        }
        
      }
      ?>
      <button class="btn btn-link dropdown-toggle" type="button" id="fileSelectMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php echo $last ?>
      </button>
      <div class="dropdown-menu" aria-labelledby="fileSelectMenuButton">
        <button class="dropdown-item" data-toggle="modal" data-target="#newFileModal"><i class="fa fa-code fa-fw"></i> New File</button>
        <button class="dropdown-item" data-toggle="modal" data-target="#newFolderModal"><i class="fa fa-folder fa-fw"></i> New Folder</button>
        <?php
        if( ($req["editType"] == "MyApps") && empty($req["dir"]) ){
          ?>
          <button class="dropdown-item" data-toggle="modal" data-target="#newMediaUploadModal"><i class="fa fa-image fa-fw"></i> Upload icon</button>
          <?php
        }
        ?>
      </div>
    </div>
    
    <?php
    if(!empty($_SESSION["fileCopy"])){
      ?>
      <div class="position-absolute border shadow-lg py-2 px-4 bg-white" style="right: 0;">
        <div class="text-center">
          <i class="fa fa-paste fa-fw fa-2x"></i>
          <br />
          <small>CLIPBOARD</small>
          <br />
          <?php echo count($_SESSION["fileCopy"]) ?> item<?php echo (count($_SESSION["fileCopy"]) != 1) ? "s" : ""; ?>
          <br />
          <a href="<?php wd_urlSub($wd_type, $wd_app, 'projectFilesSub.php', '&f=pasteFile&editType=' . $req["editType"] . '&editApp=' . $req["editApp"] . '&file=' . $entry['name'] . '&dir=' . ((!empty($req["dir"])) ? $req["dir"] : "")) ?>" class="mt-1 btn btn-primary text-white">Paste here</a>
        </div>
      </div>
      <?php
      
    }
    ?>
    
    <table class="table table-hover directory-listing" width="100%">
      <thead>
        <tr>
          <th>
            Name
          </th>
          <th>
            Last modified
          </th>
          <th>
            Size
          </th>
          <th width="5"></th>
        </tr>
      </thead>
      <tbody>
        <?php
        $dir = (!empty($req["dir"])) ? $req["dir"] . "/" : "";
        $contents = $wd_dt->getProjectFiles($req["editType"] . '/' . $req["editApp"] . '/' . $dir);
        
        foreach($contents as $key => $entry){
          
          $file_size = $wd_dt->getFormattedFileSize($entry["path"] . $entry["name"]);
          $file_time = filemtime($entry["path"] . $entry["name"]);
          
          $row_class = "";
          if(!empty($_SESSION["fileHighlight"])){
            
            foreach($_SESSION["fileHighlight"] as $hl_key => $hl){
              if(($hl["file"] == $entry["name"])){
                $row_class = "bg-warning";
                unset($_SESSION["fileHighlight"][$hl_key]);
              }
            }
            
          }
          
          ?>
          <tr class="<?php echo $row_class ?>">
            <td>
              <i class="fa fa-<?php echo $entry["icon"] ?> fa-fw"></i> &nbsp;
              <?php
              if($entry["type"] == "dir"){
                ?>
                <a href="<?php wd_url($wd_type, $wd_app, 'projectfiles.php', '&editType=' . $req["editType"] . '&editApp=' . $req["editApp"] . '&dir=' . ( (!empty($cwd)) ? implode("/", $cwd) . "/" : "") . $entry["name"]); ?>"><?php echo $entry["name"] ?></a>
                <?php
              }
              else{
                ?>
                <a href="<?php wd_url($wd_type, $wd_app, 'editfile.php', '&editType=' . $req["editType"] . '&editApp=' . $req["editApp"] . '&dir=' . $dir . '&file=' . $entry["name"]); ?>"><?php echo $entry["name"] ?></a>
                <?php
              }
              ?>
            </td>
            <td>
              <small><?php echo date((time() - $file_time < (60 * 60 * 24 * 365)) ? "M j" : "M j, Y", $file_time) ?></small>
            </td>
            <td>
              <small><?php echo $file_size ?></small>
            </td>
            <td class="text-right">
              <div class="options-link">
                
                <div class="dropdown">
                  <button class="btn btn-light dropdown-toggle" type="button" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-ellipsis-v fa-fw"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="<?php wd_urlSub($wd_type, $wd_app, 'projectFilesSub.php', '&f=copyFile&editType=' . $req["editType"] . '&editApp=' . $req["editApp"] . '&file=' . $entry['name'] . '&dir=' . ((!empty($req["dir"])) ? $req["dir"] : "")) ?>"><i class="fa fa-copy fa-fw"></i> &nbsp; Copy</a>
                    <a class="dropdown-item" href="<?php wd_urlSub($wd_type, $wd_app, 'projectFilesSub.php', '&f=duplicateFile&editType=' . $req["editType"] . '&editApp=' . $req["editApp"] . '&file=' . $entry['name'] . '&dir=' . ((!empty($req["dir"])) ? $req["dir"] : "")) ?>"><i class="fa fa-copy fa-fw"></i> &nbsp; Duplicate</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" data-toggle="modal" data-target="#renameFileModal" href="#" onclick="$('#renameFileModal form :input[name=file]').val('<?php echo $entry["name"] ?>');$('#renameFileModal form :input[name=newFileName]').val('<?php echo $entry["name"] ?>');$('#renameFileModal form :input[name=dir]').val('<?php echo (!empty($req["dir"])) ? $req["dir"] : "" ?>');$('#renameFileModal form :input[name=newFileName]').select();"><i class="fa fa-edit fa-fw"></i> &nbsp; Rename</a>
                    <div class="dropdown-divider"></div>
                    
                    <a class="dropdown-item" data-toggle="modal" data-target="#removeFileModal" href="#" onclick="$('#removeFileModal form :input[name=file]').val('<?php echo $entry["name"] ?>');"><i class="fa fa-trash fa-fw"></i> &nbsp; Remove</a>
                    
                  </div>
                </div>
              </div>
            </td>
          </tr>
          <?php
        }
        if(count($contents) == 0){
          ?>
          <tr><td colspan="200" class="my-5 text-center"><small>There are no files in this directory</small></td></tr>
          <?php
        }
        ?>
      </tbody>
    </table>
  </div>
  
  <!-- Modal -->
  <div id="publishModal" class="modal fade" role="dialog">
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
  <?php
}
else
  echo '<div class="container pt-5 text-center"><h1 class="display-1">400</h1><h4>Sorry, couldn&apos;t find that app!</h4></div>';
  
include("appFooter.php");
?>