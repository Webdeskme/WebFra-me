<?php // start.php 
// THIS IS THE DEFAULT PAGE FOR YOUR APP. REFER TO WD_FUNCTIONS FOR ENVIRONMENTAL VARIABLES.
if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
include("appHeader.php");
?>
<p class="lead p-5">
	Access this app through the "Publish" button in <a href="<?php echo wd_url("Apps", 'Dev'); ?>" class="text-primary">Developer Tools</a>.
</p>