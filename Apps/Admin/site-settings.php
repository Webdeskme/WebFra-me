<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
//_wf_backbutton(wd_url($wd_type, $wd_app, 'start.php', ''));
include_once("config.inc.php");
include("appHeader.php");
?>
<nav class="webdesk_navbar webdesk_bg-light webdesk_border-top">
    <ul class="webdesk_navbar-nav">
    	<li class="webdesk_navbar-item">
        <a class="webdesk_navbar-link" href="<?php echo wd_url($wd_type, $wd_app, 'start.php', ''); ?>"><i class="fa fa-arrow-circle-left fa-fw fa-lg"></i></a>
      </li>
      <li class="webdesk_navbar-item">
        <h4>Webframe Settings</h4>
      </li>
      
    </ul>
</nav>
<form name="saveSettingsForm" action="<?php wd_urlSub($wd_type, $wd_app, 'site-settingsSub.php', ''); ?>" method="POST">
	<div class="webdesk_container webdesk_my-5">
		<div class="webdesk_row webdesk_for-group webdesk_text-right">
			<label for="site-name" class="webdesk_m-0 webdesk_col-sm-3 webdesk_col-form-label">Site Name</label>
			<div class="webdesk_col-sm-7">
				<input type="text" name="site_name" id="site-name" class="webdesk_form-control" value="<?php echo $wf_admin->getSiteName() ?>" />
			</div>
		</div>
		<div class="webdesk_row webdesk_form-group webdesk_mt-3 webdesk_text-right">
			<label for="site-description" class="webdesk_col-sm-3 webdesk_col-form-label">Site Description</label>
			<div class="webdesk_col-sm-7">
				<textarea name="site_description" id="site-description" class="webdesk_form-control"><?php echo $wf_admin->getSiteDescription() ?></textarea>
				<small class="webdesk_text-left webdesk_form-text webdesk_text-muted">This is placed in the header and is read by search engines and other bots that crawl your site.</small>
			</div>
		</div>
		<div class="webdesk_row webdesk_form-group webdesk_mt-3 webdesk_text-right">
			<label for="site-path" class="webdesk_col-sm-3 webdesk_col-form-label">Config Files Path</label>
			<div class="webdesk_col-sm-7">
				<input type="text" name="site_path" id="site_path" readonly class="webdesk_form-control" value="<?php echo $wf_admin->getSitePath() ?>" />
			</div>
		</div>
		<div class="webdesk_text-center webdesk_mt-5">
			<button type="submit" class="webdesk_btn webdesk_btn-primary"><i class="fa fa-save fa-fw"></i> Save</button>
		</div>
	</div>
</form>
<?php
include("appFooter.php");
?>