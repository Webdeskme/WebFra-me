<?php
if(!file_exists($wd_appFile . $wd_app . '/')){
  mkdir($wd_appFile . $wd_app . '/');
}
if(!file_exists($wd_appFile . $wd_app . '/date.txt')){
  $date = date('Y-m-d');
  file_put_contents($wd_appFile . $wd_app . '/date.txt', $date);
}
$odate = file_get_contents($wd_appFile . $wd_app . '/date.txt');
$date = date('Y-m-d');
if($odate != $date){
  if(file_exists($wd_appFile . $wd_app . '/list.json')){
  $obj = json_decode(file_get_contents($wd_appFile . $wd_app . '/list.json'), true);
    foreach($obj as $key => $entry){
      if($obj[$key]['done'] != 'yes'){
        $obj[$key]['streak'] = '0';
      }
      else{
        $obj[$key]['done'] = 'no';
      }
    }
    $json = json_encode($obj);
    file_put_contents($wd_appFile . $wd_app . '/list.json', $json);
  }
  file_put_contents($wd_appFile . $wd_app . '/date.txt', $date);
}
?>
<a href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>"><h1>Habits</h1></a>
<div class="panel panel-primary black">
  <div class="panel-heading">
    <form method="POST" action="<?php wd_urlSub($wd_type, $wd_app, 'startSub.php', ''); ?>">
    <div class="row">
      <div class="col-sm-4"><input type="text" name="item" class="form-control" placeholder="Add a habit you want to do every day." required autofocus></div>
      <div class="col-sm-2"><button class="btn btn-success" type="submit">Add</button></div>
    </div>
    </form>
  </div>
  <div class="panel-body">
    <table class="table table-striped">
      <tbody>
        <?php
if(file_exists($wd_appFile . $wd_app . '/list.json')){
  $obj = json_decode(file_get_contents($wd_appFile . $wd_app . '/list.json'), true);
  $x = 0;
  foreach($obj as $key => $entry){
    $x = $x + 1;
    ?>
    <tr><td style="font-size: 2em;"><a href="<?php wd_urlSub($wd_type, $wd_app, 'update.php', '&id=' . $key); ?>"><b><?php echo $x; ?>: </b><?php if($obj[$key]['done'] != 'yes'){ echo base64_decode($obj[$key]['item']);} else{ echo '<strike>' . base64_decode($obj[$key]['item']) . '</strike>';} ?> <span class="badge"><?php echo $obj[$key]['streak'] ?></span></a> <a href="<?php wd_urlSub($wd_type, $wd_app, 'startSubDelete.php', '&item=' . $key); ?>" style="float:right;"><span class="label label-danger">Remove</span></a></td></tr>
        <?php
  }
}
        ?>
      </tbody>
    </table>
  </div>
</div>