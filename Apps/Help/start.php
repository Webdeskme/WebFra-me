<?php
$wd_tier = test_input($wd_tier);
$wd_tierFile = $wd_admin . $wd_tier . '.json';
if(file_exists($wd_tierFile)){$wd_tierobj=json_decode(file_get_contents($wd_tierFile)); $wd_obj = $wd_tierobj;} 
else{
$wd_tierobj = "";
$wd_obj = "";
}
?>
<h1>Help</h1>
<p>This is a help section for all of Webdesk and its aplications.</p>
<?php
if(file_exists('help.php')){
  echo file_get_contents('help.php');
}
foreach (scandir('Apps/') as $entry){
                    if ($entry != "." && $entry != "..") {
                       if(!file_exists($wd_tierFile)){$wd_teatobj = 0;}
                        elseif(isset($wd_obj->$entry) && $wd_obj->$entry == 'Yes'){$wd_teatobj = 1;}
                        else{$wd_teatobj = 0;}
                        if($wd_tier === 'tA' || $wd_teatobj === 1){
                      if(file_exists('Apps/' . $entry . '/help.php')){
?>
<a href="<?php wd_url($wd_type, $wd_app, 'AppHelp.php', '&htype=Apps&happ=' . $entry); ?>"><h3><?php echo $entry; ?></h3></a>
<?php
                                       }}
                    }
}
foreach (scandir('MyApps/') as $entry){
                    if ($entry != "." && $entry != "..") {
                       if(!file_exists($wd_tierFile)){$wd_teatobj = 0;}
                        elseif(isset($wd_obj->$entry) && $wd_obj->$entry == 'Yes'){$wd_teatobj = 1;}
                        else{$wd_teatobj = 0;}
                        if($wd_tier === 'tA' || $wd_teatobj === 1){
                      if(file_exists('MyApps/' . $entry . '/help.php')){
?>
<a href="<?php wd_url($wd_type, $wd_app, 'AppHelp.php', '&htype=MyApps&happ=' . $entry); ?>"><h3><?php echo $entry; ?></h3></a>
<?php
                                       }}
                    }
}
?>