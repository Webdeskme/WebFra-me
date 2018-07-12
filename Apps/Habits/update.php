<?php 
if(isset($_GET['id'])){
  $id = test_input($_GET['id']);
  if(file_exists($wd_appFile . $wd_app . '/list.json')){
    $obj = json_decode(file_get_contents($wd_appFile . $wd_app . '/list.json'), true);
    if($obj[$id]['done'] != 'yes'){
      $obj[$id]['done'] = 'yes';
      $obj[$id]['streak'] = $obj[$id]['streak'] + 1;
    }
    else{
      $obj[$id]['done'] = 'no';
      $obj[$id]['streak'] = $obj[$id]['streak'] - 1;
    }
    $json = json_encode($obj);
    file_put_contents($wd_appFile . $wd_app . '/list.json', $json);
  }
}
wd_head($wd_type, $wd_app, 'start.php', '');
?>