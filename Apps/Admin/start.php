<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
include_once("config.inc.php");
include("appHeader.php");
?>

<div class="container py-md-5">
	<div class="row my-5 no-gutters">
		<div class="col-md-3 col-xs-6 text-center">
			<a href="<?php echo wd_url($wd_type, $wd_app, 'site-settings.php',''); ?>" class="btn btn-light btn-block p-5 rounded-0 d-block">
				<i class="fa fa-cogs fa-fw fa-3x"></i><br />
				WF SETTINGS
			</a>
		</div>
		<div class="col-md-3 col-xs-6 text-center">
			<a href="<?php echo wd_url($wd_type, $wd_app, 'manage-users.php',''); ?>" class="btn btn-light btn-block p-5 rounded-0 d-block">
				<i class="fa fa-users fa-fw fa-3x"></i><br />
				USERS
			</a>
		</div>
		<div class="col-md-3 col-xs-6 text-center">
			<a href="<?php echo wd_url($wd_type, $wd_app, 'permissions.php', ''); ?>" class="btn btn-light btn-block p-5 rounded-0 d-block">
				<i class="fa fa-lock fa-fw fa-3x"></i><br />
				PERMISSIONS
			</a>
		</div>
		<div class="col-md-3 col-xs-6 text-center">
			<a href="<?php echo wd_url($wd_type, $wd_app, 'log.php', ''); ?>" class="btn btn-light btn-block p-5 rounded-0 d-block">
				<i class="fa fa-clipboard-list fa-fw fa-3x"></i><br />
				AUDIT LOG
			</a>
		</div>
	</div>
</div>

<?php
include("appFooter.php");
?>