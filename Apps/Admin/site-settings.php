<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
//_wf_backbutton(wd_url($wd_type, $wd_app, 'start.php', ''));
include_once("config.inc.php");
include("appHeader.php");
?>
<nav class="navbar bg-light border-top">
    <ul class="navbar-nav">
    	<li class="navbar-item">
        <a class="navbar-link" href="<?php echo wd_url($wd_type, $wd_app, 'start.php', ''); ?>"><i class="fa fa-arrow-circle-left fa-fw fa-lg"></i></a>
      </li>
      <li class="navbar-item">
        <h4>Webframe Settings</h4>
      </li>
      
    </ul>
</nav>
<form name="saveSettingsForm" action="<?php wd_urlSub($wd_type, $wd_app, 'site-settingsSub.php', ''); ?>" method="POST">
	<div class="container my-5">
		<div class="row for-group text-right">
			<label for="site-name" class="m-0 col-sm-3 col-form-label">Site Name</label>
			<div class="col-sm-7">
				<input type="text" name="site_name" id="site-name" class="form-control" value="<?php echo $wf_admin->getSiteName() ?>" />
			</div>
		</div>
		<div class="row form-group mt-3 text-right">
			<label for="site-description" class="col-sm-3 col-form-label">Site Description</label>
			<div class="col-sm-7">
				<textarea name="site_description" id="site-description" class="form-control"><?php echo $wf_admin->getSiteDescription() ?></textarea>
				<small class="text-left form-text text-muted">This is placed in the header and is read by search engines and other bots that crawl your site.</small>
			</div>
		</div>
		<div class="row form-group mt-3 text-right">
			<label for="site-path" class="col-sm-3 col-form-label">Config Files Path</label>
			<div class="col-sm-7">
				<input type="text" name="site_path" id="site_path" readonly class="form-control" value="<?php echo $wf_admin->getSitePath() ?>" />
			</div>
		</div>
		<div class="text-center mt-5">
			<button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> Save</button>
		</div>
	</div>
</form>
<?php
include("appFooter.php");
?>