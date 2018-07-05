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
          
          <a href="#" class="webdesk_btn webdesk_btn-secondary webdesk_text-white" data-toggle="webdesk_tooltip" title="Publish to Marketplace">
            <i class="fa fa-upload fa-fw"></i> Publish
          </a>
          
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
        <button type="button" class="webdesk_btn webdesk_btn-outline-secondary webdesk_rounded-0" data-toggle="webdesk_tooltip" title="New file">
          <i class="fa fa-file fa-fw"></i>
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