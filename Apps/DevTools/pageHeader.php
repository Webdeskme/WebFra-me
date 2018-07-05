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
	    <div class="webdesk_dropdown">
			  <button class="webdesk_btn webdesk_btn-light webdesk_shadow webdesk_dropdown-toggle" type="button" id="wd_dt_optionsDropdown" data-toggle="webdesk_dropdown" aria-haspopup="true" aria-expanded="false">
			    <i class="fa fa-bars"></i> Options
			  </button>
			  <div class="webdesk_dropdown-menu" aria-labelledby="wd_dt_optionsDropdown">
			    <a class="webdesk_dropdown-item" href="#">Action</a>
			    <a class="webdesk_dropdown-item" href="#">Another action</a>
			    <a class="webdesk_dropdown-item" href="#">Something else here</a>
			  </div>
			</div>
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