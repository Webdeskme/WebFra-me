<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; } ?>
<h1>Monthly Login Log</h1>
<a href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>">Back</a><br><hr><br>
<?php
if(file_exists($wd_admin . 'LoginLog.txt')){
echo file_get_contents($wd_admin . 'LoginLog.txt');
}
else{
echo 'No logged entries this month.';
}
?>
