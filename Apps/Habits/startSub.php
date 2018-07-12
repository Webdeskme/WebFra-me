<?php 
if(isset($_POST['item'])){
  $item = test_input($_POST['item']);
  $date=date_create();
  $stamp = date_timestamp_get($date);
  if(file_exists($wd_appFile . $wd_app . '/list.json')){
    $obj = json_decode(file_get_contents($wd_appFile . $wd_app . '/list.json'), true);
  }
  $obj[$stamp]['item'] = base64_encode($item);
  $obj[$stamp]['done'] = 'no';
  $obj[$stamp]['streak'] = '0';
  $json = json_encode($obj);
  file_put_contents($wd_appFile . $wd_app . '/list.json', $json);
}
wd_head($wd_type, $wd_app, 'start.php', '');
?>