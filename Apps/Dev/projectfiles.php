<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
include_once("config.inc.php");
include("appHeader.php");

if(!empty($req["editType"]) && !empty($req["editApp"])){
  if(file_exists($req["editType"]."/".$req["editApp"]."/app.json")){
    $app_json = json_decode(file_get_contents($req["editType"]."/".$req["editApp"]."/app.json"),true);
    $wd_dt->setProjName($app_json["name"]);
  }
  else
    $wd_dt->setProjName($req["editApp"]);
}

?>

<?php if(isset($_SESSION["wd_copy_file"])){ ?><div><a href="<?php wd_urlSub($wd_type, $wd_app, 'pasteSub.php', '&MyApp=' . $MyApp); ?>"><span class="fa fa-paste"></span> Paste</a></div><?php } ?>

<div class="webdesk_bg-light webdesk_border-top webdesk_p-2">
  <div class="webdesk_float-right">
    <?php echo wd_confirm($wd_type, $wd_app, "removeProjectSub.php", "&editType=" . $req["editType"] . "&editApp=" . $req["editApp"], "removeAppModal", "<i class='fa fa-trash fa-fw'></i> Remove Project"); ?>
  </div>
  <h4><?php echo $wd_dt->getProjName() ?></h4>
</div>

<div class="webdesk_container webdesk_my-5">
  
  <div class="webdesk_dropdown">
    <button class="webdesk_btn webdesk_btn-link webdesk_dropdown-toggle" type="button" id="fileSelectMenuButton" data-toggle="webdesk_dropdown" aria-haspopup="true" aria-expanded="false">
      Files and folders
    </button>
    <div class="webdesk_dropdown-menu" aria-labelledby="fileSelectMenuButton">
      <button class="webdesk_dropdown-item" data-toggle="webdesk_modal" data-target="#newFileModal"><i class="fa fa-code fa-fw"></i> New File</button>
      <!--<button class="webdesk_dropdown-item" data-toggle="webdesk_modal" data-target="#newFolderModal"><i class="fa fa-folder fa-fw"></i> New Folder</button>-->
      <?php
      if($req["editType"] == "MyApps"){
        ?>
        <button class="webdesk_dropdown-item" data-toggle="webdesk_modal" data-target="#newMediaUploadModal"><i class="fa fa-image fa-fw"></i> Upload icon</button>
        <?php
      }
      ?>
    </div>
  </div>
  
  <table class="webdesk_table webdesk_table-hover" width="100%">
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
      </tr>
    </thead>
    <tbody>
      <?php
      $contents = $wd_dt->getProjectFiles($req["editType"] . '/' . $req["editApp"] . '/');
      
      foreach($contents as $key => $entry){
        $file_size = $wd_dt->getFormattedFileSize($entry["path"] . $entry["name"]);
        $file_time = filemtime($entry["path"] . $entry["name"]);
        
        ?>
        <tr>
          <td>
            <i class="fa fa-<?php echo $entry["icon"] ?> fa-fw"></i> &nbsp;
            <a href="<?php wd_url($wd_type, $wd_app, 'editfile.php', '&editType=' . $req["editType"] . '&editApp=' . $req["editApp"] . '&file=' . $entry["name"]); ?>"><?php echo $entry["name"] ?></a>
          </td>
          <td>
            <small><?php echo date((time() - $file_time < (60 * 60 * 24 * 365)) ? "M j" : "M j, Y", $file_time) ?></small>
          </td>
          <td>
            <small><?php echo $file_size ?></small>
          </td>
        </tr>
        <?php
      }
      ?>
    </tbody>
  </table>
</div>

<!-- Modal -->
<div id="publishModal" class="webdesk_modal fade" role="dialog">
  <div class="webdesk_modal-dialog">

    <!-- Modal content-->
    <div class="webdesk_modal-content">
      <div class="webdesk_modal-header">
        <button type="button" class="close" data-dismiss="webdesk_modal">&times;</button>
        <h4 class="webdesk_modal-title">Publish <?php echo $MyApp; ?></h4>
      </div>
      <div class="webdesk_modal-body">
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
      <div class="webdesk_modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="webdesk_modal">Close</button>
      </div>
    </div>

  </div>
</div>
<?php
include("appFooter.php");
?>