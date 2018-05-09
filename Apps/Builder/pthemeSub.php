<?php 
$theme = test_input($_GET['theme']);
file_put_contents("www/dtheme.txt", $theme);
wd_head($wd_type, $wd_app, 'pthemes.php', '&wd_as=Your theme was successfuly changed!');
?>