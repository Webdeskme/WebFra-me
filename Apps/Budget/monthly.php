<?php 
$title = test_input($_GET['title']);
$monthly = test_input($_POST['monthly']);
$obj = file_get_contents($wd_appFile . 'Budget/' . $title . '.json');
$obj = json_decode($obj);
$obj->monthlyd = date('Y-m');
$obj->monthlya = $monthly;
$myJSON = json_encode($obj);
file_put_contents($wd_appFile . 'Budget/' . $title . '.json', $myJSON);
wd_head($wd_type, $wd_app, 'budget.php', '&title=' . $title);
?>