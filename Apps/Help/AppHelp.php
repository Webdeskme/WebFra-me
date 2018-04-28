<br><br>
<a href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>"><button class="btn btn-primary">Back</button></a>
<?php 
$htype = test_input($_GET['htype']);
$happ = test_input($_GET['happ']);
if(file_exists($htype . '/' . $happ . '/help.php')){
  echo '<h1>' . $happ . '</h1>' . file_get_contents($htype . '/' . $happ . '/help.php');
}
foreach (scandir($htype . '/' . $happ . '/') as $entry){
                    if ($entry != "." && $entry != "..") {
                      $test = explode('_', $entry);
                      if(isset($test[1]) && $test[0] = 'help'){
                        $test = explode('.', $test[1]);
?>
<a href="<?php wd_url($wd_type, $wd_app, 'AppHelpPage.php', '&htype=' . $htype . '&happ=' . $happ . '&page=' . $entry); ?>"><h3><?php echo $test[0]; ?></h3></a>
<?php
                                       }
                    }
}
?>