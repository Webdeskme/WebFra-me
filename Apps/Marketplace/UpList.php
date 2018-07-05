<?php
file_put_contents("wd_market.json", fopen("http://webdesk.me/www/Pages/wd_market.json", 'r'));
wd_head($wd_type, $wd_app, 'start.php', '');
?>
