<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>">Budget</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="desktop.php">Back</a></li>
      </ul>
      <form class="navbar-form navbar-left" method="post" action="<?php wd_urlSub($wd_type, $wd_app, 'startSub.php', ''); ?>">
        <input type="text" name="title" class="form-control" placeholder="New Budget">
          <button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-floppy-disk"></i></button>
    </form>
      <ul class="nav navbar-nav navbar-right">
      </ul>
    </div>
  </div>
</nav>
<div class="panel panel-primary">
  <div class="panel-heading"><b>Categories</b></div>
  <div class="panel-body" style="color: 000000;">
<?php
    $x = 0;
    $t = 0;
  if(file_exists($wd_appFile . 'Budget/')){
?>
    <table class="table table-striped">
      <tbody>
    <?php
    foreach (scandir($wd_appFile . 'Budget/') as $entry){
      if ($entry != "." && $entry != "..") {
        $x = $x + 1;
        ?>
      <tr><td>
        <a href="<?php wd_url($wd_type, $wd_app, 'budget.php', '&title=' . str_replace('.json', '', $entry)); ?>"><b><?php echo $x; ?>: </b><?php echo str_replace('.json', '', $entry); 
          $obj = file_get_contents($wd_appFile . 'Budget/' . $entry);
          $obj = json_decode($obj);
        
        //----------------------------//
        
        if(isset($obj->monthlyd)){
  if($obj->monthlyd !== date('Y-m')){
    $d1 = date_create($obj->monthlyd);
    $d2 = date_create(date('Y-m'));
    $diff = date_diff($d1, $d2);
    $obj->monthlyd = date('Y-m');
    $difff = $diff->format("%Y-%m");
    $edifff = explode('-', $difff);
    $y = $edifff[0] * 12;
    $m = $y + $edifff[1];
    $price = $m * $obj->monthlya;
    $obj->total = $obj->total + $price;
    if($price >= 0){
      $ctype = '<span style="color: #33cc33;">Credit</span>';
      $price = '<span style="color: #33cc33;">' . $price . '</span>';
    }
    else{
      $ctype = '<span style="color: #ff0000;">Debit</span>';
      $price = '<span style="color: #ff0000;">' . $price . '</span>';
    }
    if($obj->total >= 0){
      $bal = '<span style="color: #33cc33;">' . $obj->total . '</span>';
    }
    else{
      $bal = '<span style="color: #ff0000;">' . $obj->total . '</span>';
    }
    $x = '<tr><td>' . $obj->id . '</td><td>' . date('m-Y') . '</td><td>Monthly</td><td>' . $ctype . '</td><td>' . $price . '</td><td>' . $bal . '</td></tr>';
    $obj->items = $obj->items . $x;
    $myJSON = json_encode($obj);
    file_put_contents($wd_appFile . 'Budget/' . $entry, $myJSON);
  }
}

$obj = file_get_contents($wd_appFile . 'Budget/' . $entry);
$obj = json_decode($obj);
        //-----------------------------//
        
          if($obj->total >= 0){
            echo '<span style="color: #33cc33;">: <b>' . $obj->total . '</b></span>';
          }
          else{
            echo '<span style="color: #ff0000;">: <b>' . $obj->total . '</b></span>';
          }
          ?></a>
      </td></tr>
        <?php
        $t = $t + $obj->total;
      }
    }
    ?>
        </tbody>
      </table>
<?php
  }
?>
  </div>
  <div class="panel-footer"><?php if($t >= 0){$color = "#33cc33";} else{$color = "#ff0000";} echo '<p style="color: #000000;">Total from all categories <b style="color: ' . $color . ';">$' . $t . '</b></p>'; ?></div>
</div>