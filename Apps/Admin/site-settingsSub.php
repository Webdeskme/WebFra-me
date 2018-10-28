<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }

if(empty($_POST["site_name"]))
	wd_head($wd_type, $wd_app, 'site-settings.php', '&wd_ad='.urlencode("Site name cannot be blank"));
else if(empty($_POST["site_description"]))
	wd_head($wd_type, $wd_app, 'site-settings.php', '&wd_ad='.urlencode("Site description cannot be blank"));
else{
	
	$site_name = test_input($_POST["site_name"]);
	$site_description = test_input($_POST["site_description"]);
	
	if(!file_put_contents($wd_admin."title.txt", $site_name))
		wd_head($wd_type, $wd_app, 'site-settings.php', '&wd_ad='.urlencode("Could not save site name. Do you have permission?"));
	else if(!file_put_contents($wd_admin."description.txt", $site_description))
		wd_head($wd_type, $wd_app, 'site-settings.php', '&wd_ad='.urlencode("Could not save site description. Do you have permission?"));
	else{
		wd_head($wd_type, $wd_app, 'site-settings.php', '&wd_as=Settings+saved+successfully');
	}
	
}

?>