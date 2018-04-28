<h1>Monthly Failed Login Log</h1>
<a href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>">Back</a><br><hr><br>
<?php 
if(file_exists($wd_admin . 'LoginFLog.txt')){
echo file_get_contents($wd_admin . 'LoginFLog.txt');
}
else{
echo 'No logged entries this month.';
}
?>