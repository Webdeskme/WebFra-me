<nav class="webdesk_navbar webdesk_navbar-expand-md webdesk_bg-light">
  <div class="webdesk_container-fluid">
    <div class="webdesk_navbar-header">
      <a class="webdesk_navbar-brand webdesk_text-dark" href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>"><img src="//<?php echo $_SERVER["HTTP_HOST"] ?>/<?php echo $wd_type ?>/<?php echo $wd_app ?>/ic.png" width="48" class="webdesk_img webdesk_mr-2" /> Developer Tools</a>
      <button class="webdesk_navbar-toggler" type="button" data-toggle="webdesk_collapse" data-target="#terminalNavbar" aria-controls="terminalNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars fa-fw"></i>
      </button>
    </div>
    <div class="webdesk_collapse webdesk_justify-content-end webdesk_navbar-collapse" id="terminalNavbar">
      
      <ul class="webdesk_navbar-nav webdesk_justify-content-end">
        <li class="webdesk_nav-item">
          
          <?php
          if(test_input($_GET["sec"]) == "projectEditor.php"){
            ?>
            <a href="#" class="webdesk_btn webdesk_btn-secondary webdesk_text-white" data-toggle="webdesk_tooltip" title="Publish to Marketplace">
              <i class="fa fa-shipping-fast fa-fw"></i> Publish App
            </a>
            <span data-toggle="webdesk_tooltip" title="Delete app from WebDesk">
            <a href="#" class="webdesk_btn webdesk_btn-danger webdesk_text-white" data-toggle="webdesk_modal" data-target="#deleteAppModal">
              <i class="fa fa-trash fa-fw"></i>
            </a>
            </span>
            <?php
          }
          ?>
          
        </li>
      </ul>
      
    </div>
  </div>
</nav>
<nav class="webdesk_navbar webdesk_bg-light webdesk_border-top">
  <div class="">
    <?php
    if(test_input($_GET["sec"]) == "start.php"){
    	?>
	  <!--  <div class="webdesk_dropdown">-->
			<!--  <button class="webdesk_btn webdesk_btn-light webdesk_shadow webdesk_dropdown-toggle" type="button" id="wd_dt_optionsDropdown" data-toggle="webdesk_dropdown" aria-haspopup="true" aria-expanded="false">-->
			<!--    <i class="fa fa-bars"></i> Options-->
			<!--  </button>-->
			<!--  <div class="webdesk_dropdown-menu" aria-labelledby="wd_dt_optionsDropdown">-->
			<!--    <a class="webdesk_dropdown-item" href="#">Action</a>-->
			<!--    <a class="webdesk_dropdown-item" href="#">Another action</a>-->
			<!--    <a class="webdesk_dropdown-item" href="#">Something else here</a>-->
			<!--  </div>-->
			<!--</div>-->
			<button class="webdesk_btn webdesk_btn-light webdesk_shadow" data-toggle="webdesk_modal" data-target="#newProjectModal" type="button"><i class="fa fa-plus fa=fw"></i> New Project</button>
			<?php
    }
    else if(test_input($_GET["sec"]) == "projectEditor.php"){
      ?>
      
      <div class="webdesk_btn-group">
        <button type="button" class="webdesk_btn webdesk_btn-outline-secondary webdesk_rounded-0" title="New file" data-toggle="webdesk_modal" data-target="#newFileModal">
          <span class="fa-layers fa-fw" style="">
            <i class="fa fa-file"></i>
            <i class="fa fa-plus fa-inverse" data-fa-transform="shrink-7 down-2"></i>
          </span>
        </button>
        <button id="dt_editor-saveButton" type="button" class="webdesk_btn webdesk_btn-outline-secondary webdesk_rounded-0" data-toggle="webdesk_tooltip" title="Save open file">
          <i class="fa fa-save fa-fw"></i>
        </button>
      </div>
      
      <?php
    }//
    ?>
    
  </div>
</nav>
<div class="webdesk_modal webdesk_fade" id="newFileModal" tabindex="-1" role="dialog" aria-labelledby="newFileModalLabel" aria-hidden="true">
  <div class="webdesk_modal-dialog" role="document">
    <form name="newFile" class="no-loader" onsubmit="devTools.newFile(this);return false;">
      <div class="webdesk_modal-content">
        <div class="webdesk_modal-header">
          <h5 class="webdesk_modal-title" id="newFileModalLabel"><i class="fa fa-file"></i> New File</h5>
          <button type="button" class="webdesk_close" data-dismiss="webdesk_modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="webdesk_modal-body">
        
          <div class="webdesk_form-group">
            <label for="file_title">Name of file</label>
            <input type="text" name="file_name" class="webdesk_form-control" id="file_title" value="newFile.php" onfocus="$(this).select();" />
          </div>
        
        </div>
        <div class="webdesk_modal-footer">
          <button type="button" class="webdesk_btn webdesk_btn-secondary" data-dismiss="webdesk_modal">Close</button>
          <button type="submit" class="webdesk_btn webdesk_btn-primary">Create</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="webdesk_modal webdesk_fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
  <div class="webdesk_modal-dialog" role="document">
    <form name="deleteFile" class="no-loader" onsubmit="devTools.deleteFile(this);return false;">
      <div class="webdesk_modal-content">
        <div class="webdesk_modal-header">
          <h5 class="webdesk_modal-title" id="newFileModalLabel"><i class="fa fa-exclamation-circle"></i> Confirm</h5>
          <button type="button" class="webdesk_close" data-dismiss="webdesk_modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="webdesk_modal-body">
        
          <p>
            Are you sure you want to delete <b class="file">{{fileName}}</b>?
          </p>
          <input type="hidden" name="file" value="" />
        
        </div>
        <div class="webdesk_modal-footer">
          <button type="button" class="webdesk_btn webdesk_btn-secondary" data-dismiss="webdesk_modal">Cancel</button>
          <button type="submit" class="webdesk_btn webdesk_btn-primary">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="webdesk_modal webdesk_fade" id="deleteAppModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
  <div class="webdesk_modal-dialog" role="document">
    <form name="deleteApp" class="no-loader" onsubmit="">
      <div class="webdesk_modal-content">
        <div class="webdesk_modal-header">
          <h5 class="webdesk_modal-title" id="newFileModalLabel"><i class="fa fa-exclamation-circle"></i> Confirm</h5>
          <button type="button" class="webdesk_close" data-dismiss="webdesk_modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="webdesk_modal-body">
        
          <p>
            This action will remove the app from WebDesk and all associated files and folders. Do you wish to proceed? 
          </p>
          <input type="hidden" name="app" value="<?php echo $wd_app ?>" />
        
        </div>
        <div class="webdesk_modal-footer">
          <button type="button" class="webdesk_btn webdesk_btn-secondary" data-dismiss="webdesk_modal">Cancel</button>
          <button type="submit" class="webdesk_btn webdesk_btn-primary">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="webdesk_modal webdesk_fade" id="newProjectModal" tabindex="-1" role="dialog" aria-labelledby="newProjectModalLabel" aria-hidden="true">
  <div class="webdesk_modal-dialog webdesk_shadow-lg webdesk_modal-lg" role="document">
    <form name="newProject" class="no-loader" onsubmit="createProject(this);return false;">
      <div class="webdesk_modal-content">
        <div class="webdesk_modal-header">
          <h5 class="webdesk_modal-title" id="newProjectModalLabel"><i class="fa fa-plus"></i> New Project</h5>
          <button type="button" class="webdesk_close" data-dismiss="webdesk_modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="webdesk_modal-body">
          
          <div class="webdesk_row webdesk_no-gutters webdesk_mb-4">
            <div class="webdesk_col">
              <div class="webdesk_btn-group webdesk_btn-group-toggle" data-toggle="webdesk_buttons">
              <?php
              foreach($wd_dt->create_types as $key => $dt_type){
                ?>
                
                <label class="webdesk_btn webdesk_btn-outline-secondary <?php echo ($key == 0) ? "webdesk_active" : ""; ?> webdesk_pt-3 webdesk_px-4" data-toggle="webdesk_tooltip" title="<?php echo $dt_type["blurb"] ?>" onclick="$('.app_base_path').text('<?php echo $dt_type["dir"] ?>');">
                  <input type="radio" name="project_type" autocomplete="off" <?php echo ($key == 0) ? "checked" : ""; ?>>
                  <i class="fa fa-<?php echo $dt_type["icon"] ?> fa-fw fa-2x"></i>
                  <h5 class="webdesk_mt-1 webdesk_card-title"><?php echo $dt_type["name"] ?></h5>
                </label>
                
                <?php
              }
              ?>
              </div>
            </div>
          </div>
          
          <div class="webdesk_form-group">
            <label for="new_project_name">Project Name</label>
            <input type="text" name="project_name" id="new_project_name" class="webdesk_form-control" onblur="$('#new_project_path').val(devTools.remove_characters($(this).val()));" />
          </div>
          <div class="webdesk_form-group">
            <label for="new_project_description">Description (Optional)</label>
            <textarea name="project_description" id="new_project_description" class="webdesk_form-control"></textarea>
          </div>
          <div class="webdesk_form-group">
            <label for="new_project_path">File Path</label>
            <div class="webdesk_input-group">
              <div class="webdesk_input-group-prepend">
                <span class="webdesk_input-group-text"><span class="app_base_path">MyApps</span>/</span>
              </div>
              <input type="text" name="project_path" id="new_project_path" class="webdesk_form-control" aria-described-by="new_project_path_help" />
            </div>
            <small id="new_project_path_help" class="webdesk_text-muted webdesk_form-text">This is where your project files will be saved</small>
          </div>
          
        </div>
        <div class="webdesk_modal-footer">
          <button type="button" class="webdesk_btn webdesk_btn-secondary" data-dismiss="webdesk_modal">Cancel</button>
          <button type="submit" class="webdesk_btn webdesk_btn-primary">Create</button>
        </div>
      </form>
    </div>
  </div>
</div>