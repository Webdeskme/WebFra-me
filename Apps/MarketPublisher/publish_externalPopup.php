<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; } 
include_once("config.inc.php");
?>
<?php
if(!empty($wd_app) && ($wd_app == "MarketPublisher")){
	?>
	<p>
		This page is accessed from external applications, not from the Marketplace Publisher app
	</p>
	<?php
}
else{
	?>
	<div class="webdesk_container webdesk_text-center">
		
		<button class="webdesk_btn webdesk_btn-light webdesk_shadow-sm webdesk_border" onclick="window.open('<?php echo $wd_marketpublisher->publisher_oauth_url ?>','_blank','width=800,height=600,scrollbars=yes,resizeable=yes');"><img src="Apps/MarketPublisher/assets/Webdesk_Logo.png" alt="" class="webdesk_img" style="max-width: 24px;" /> Connect to Webdesk Publisher</button>
		<br />
		<div class="webdesk_mt-2">
			<small>You must have a Webdesk Publisher&apos;s account before you publish.</small>
		</div>
	</div>
	<?php
}
?>