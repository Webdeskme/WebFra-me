<?php
$tier = test_input($_GET['tier']);
$myObj = new stdClass();
foreach ($_POST as $k=>$v) { 
    $k = test_input($k);
    $v = test_input($v);
    $myObj->$k = $v; 
}  
$myJSON = json_encode($myObj);
file_put_contents($wd_admin . 't' . $tier . ".json", $myJSON);
wd_head($wd_type, $wd_app, 'Permissions.php', '&wd_as=Settings have been saved.');
?>