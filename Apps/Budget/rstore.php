<?php
  $title = test_input($_GET['title']);
  $store = test_input($_POST['stores']);
  $obj = file_get_contents($wd_appFile . 'Budget/' . $title . '.json');
  $obj = json_decode($obj);
  $a = array($store);
  $obj->stores = array_diff($obj->stores, $a);
  $myJSON = json_encode($obj);
  file_put_contents($wd_appFile . 'Budget/' . $title . '.json', $myJSON);
  wd_head($wd_type, $wd_app, 'budget.php', '&title=' . $title);
?>