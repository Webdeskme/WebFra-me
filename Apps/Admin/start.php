<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
include_once("config.inc.php");
include("appHeader.php");
?>

<div class="webdesk_container webdesk_py-md-5">
	<div class="webdesk_row webdesk_my-5 webdesk_no-gutters">
		<div class="webdesk_col-md-3 webdesk_col-xs-6 webdesk_text-center">
			<a href="<?php echo wd_url($wd_type, $wd_app, 'site-settings.php',''); ?>" class="webdesk_btn webdesk_btn-light webdesk_btn-block webdesk_p-5 webdesk_rounded-0 d-block">
				<i class="fa fa-cogs fa-fw fa-3x"></i><br />
				WF SETTINGS
			</a>
		</div>
		<div class="webdesk_col-md-3 webdesk_col-xs-6 webdesk_text-center">
			<a href="<?php echo wd_url($wd_type, $wd_app, 'manage-users.php',''); ?>" class="webdesk_btn webdesk_btn-light webdesk_btn-block webdesk_p-5 webdesk_rounded-0 d-block">
				<i class="fa fa-users fa-fw fa-3x"></i><br />
				USERS
			</a>
		</div>
		<div class="webdesk_col-md-3 webdesk_col-xs-6 webdesk_text-center">
			<a href="<?php echo wd_url($wd_type, $wd_app, 'permissions.php', ''); ?>" class="webdesk_btn webdesk_btn-light webdesk_btn-block webdesk_p-5 webdesk_rounded-0 d-block">
				<i class="fa fa-lock fa-fw fa-3x"></i><br />
				PERMISSIONS
			</a>
		</div>
		<div class="webdesk_col-md-3 webdesk_col-xs-6 webdesk_text-center">
			<a href="<?php echo wd_url($wd_type, $wd_app, 'log.php', ''); ?>" class="webdesk_btn webdesk_btn-light webdesk_btn-block webdesk_p-5 webdesk_rounded-0 d-block">
				<i class="fa fa-clipboard-list fa-fw fa-3x"></i><br />
				AUDIT LOG
			</a>
		</div>
	</div>
</div>

<?php
include("appFooter.php");
?>