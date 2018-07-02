<?php
  $title = test_input($_GET['title']);
  $store = test_input($_POST['store']);
  $obj = file_get_contents($wd_appFile . 'Budget/' . $title . '.json');
  $obj = json_decode($obj);
if(isset($obj->stores)){
  array_push($obj->stores, $store);
}
else{
 $a = array($store);
  $obj->stores = $a;
}
  $myJSON = json_encode($obj);
  file_put_contents($wd_appFile . 'Budget/' . $title . '.json', $myJSON);
  wd_head($wd_type, $wd_app, 'budget.php', '&title=' . $title);
?>