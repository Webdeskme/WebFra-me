<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
$theme = test_input($_GET['theme']);
if(file_exists("www/Themes/" . $theme . "/settingsSub.php")){
  include "www/Themes/" . $theme . "/settingsSub.php";
}
wd_head($wd_type, $wd_app, 'psettings.php', '');
?>
