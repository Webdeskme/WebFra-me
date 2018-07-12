<?php
if(isset($_GET['item'])){
  if(file_exists($wd_appFile . $wd_app . '/list.json')){
    $obj = json_decode(file_get_contents($wd_appFile . $wd_app . '/list.json'), true);
    $item = test_input($_GET['item']);
    if(isset($obj[$item])){
      unset($obj[$item]);
      $json = json_encode($obj);
      file_put_contents($wd_appFile . $wd_app . '/list.json', $json);
    }
  }
}
wd_head($wd_type, $wd_app, 'start.php', '');
?>