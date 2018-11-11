<?php
$start_time = microtime(true);
echo "---------------------------------------\n";
echo "WEBFRAME CRON JOB SCRIPT\n";
echo "---------------------------------------\n\n";

$wd_path = dirname(__FILE__) . "/";
$_CRON["wd_path"] = $wd_path;
include_once($wd_path."testInput.php");
require $wd_path . 'Plugins/PHPMailer-master/src/PHPMailer.php';
include_once($wd_path . "path.php");

for($x=0;$x<2;$x++){
  $subdir = ($x==0) ? "Apps" : "MyApps"; 
  $scan = scandir($wd_path . $subdir);
  foreach($scan as $entry){
    if(file_exists($wd_path . $subdir . "/" . $entry . '/cron.php')){
      echo "------\n" . strtoupper($entry) . " SCRIPT\n\n";
      include $wd_path . $subdir . "/" . $entry . '/cron.php';
    }
  }
}

echo "\n\n";
echo "---------------------------------------\n";
$total_time = round(microtime(true) - $start_time,4);
echo "CRON JOB COMPLETED IN " . $total_time . " SECOND" . (($total_time!=1) ? "S" : "") . "\n";
echo "---------------------------------------\nEND OF SCRIPT\n\n";

file_put_contents($wd_roots['default']."/Admin/cronLog.txt","Script completed in " . $total_time . " seconds on " . date("Y-m-d H:i:s"));
?>