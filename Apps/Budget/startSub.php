<?php 
$title = test_input($_POST['title']);
if(!file_exists($wd_appFile . 'Budget/')){
  mkdir($wd_appFile . 'Budget/');
}
$myObj = new stdClass();
$myObj->total = 0;
$myJSON = json_encode($myObj);
file_put_contents($wd_appFile . 'Budget/' . $title . '.json', $myJSON);
wd_head($wd_type, $wd_app, 'budget.php', '&title=' . $title);
?>