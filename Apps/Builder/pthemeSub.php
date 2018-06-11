<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
$theme = test_input($_GET['theme']);
file_put_contents($wd_root . "/Admin/dtheme.txt", $theme);
wd_head($wd_type, $wd_app, 'pthemes.php', '&wd_as=Your theme was successfuly changed!');
?>
