<?php
  $title = test_input($_GET['title']);
  $obj = file_get_contents($wd_appFile . 'Budget/' . $title . '.json');
  $obj = json_decode($obj);
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
    file_put_contents($wd_appFile . 'Budget/' . $title . '.json', $myJSON);
  }
}
?>
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
        <li class="active"><a href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>">Back</a></li>
        <li><a href="#" data-toggle="collapse" data-target="#store"><span class="glyphicon glyphicon-plus"></span> Store</a></li>
        <li><a href="#" data-toggle="collapse" data-target="#item"><span class="glyphicon glyphicon-plus"></span> Item</a></li>
        <li><a href="#" data-toggle="collapse" data-target="#monthly"><span class="glyphicon glyphicon-repeat"></span> Monthly</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#" data-toggle="collapse" data-target="#mstore"><span class="glyphicon glyphicon-minus"></span> Store</a></li>
        <li><?php wd_confirm($wd_type, $wd_app, 'rtable.php', '&title=' . $title, '1', 'Clear Table'); ?></li>
        <li><?php wd_confirm($wd_type, $wd_app, 'remove.php', '&title=' . $title, '2', '<i class="glyphicon glyphicon-trash"> Delete</i>'); ?></li>
      </ul>
    </div>
  </div>
</nav>
<div id="store" class="collapse">
  <div class="panel panel-success">
    <div class="panel-heading"><b>Add Store</b></div>
    <div class="panel-body">
      <form method="post" action="<?php wd_urlSub($wd_type, $wd_app, 'store.php', '&title=' . $title); ?>">
        <input type="text" name="store" placeholder="Add store here." class="form-control">
        <input type="submit" value="Save" class="btn btn-success">
        <br>
      </form>
    </div>
  </div>
</div>
<div id="mstore" class="collapse">
  <div class="panel panel-danger">
    <div class="panel-heading"><b>Remove Store</b></div>
    <div class="panel-body">
      <form method="post" action="<?php wd_urlSub($wd_type, $wd_app, 'rstore.php', '&title=' . $title); ?>">
        <select name="stores" id="stores" class="form-control">
          <?php
          foreach($obj->stores as $entry){
           ?>
          <option value="<?php echo $entry; ?>"><?php echo $entry; ?></option>
          <?php
          }
          ?>
        </select>
        <input type="submit" value="Delete" class="btn btn-danger">
        <br>
      </form>
    </div>
  </div>
</div>
<div id="item" class="collapse">
  <div class="panel panel-success">
    <div class="panel-heading"><b>Add Item</b></div>
    <div class="panel-body">
      <form method="post" action="<?php wd_urlSub($wd_type, $wd_app, 'item.php', '&title=' . $title); ?>">
        <div class="form-group">
        <label for="price">Price: </label>
        <input type="number" step="0.01" name="price" id="price" placeholder="$50.12" class="form-control">
        </div>
        <div class="form-group">
        <label for="date">Date: </label>
        <input type="date" name="date" id="date" placeholder="05/11/2017" class="form-control">
        </div>
        <div class="form-group">
        <label for="stores">Store: </label>
        <select name="stores" id="stores" class="form-control">
          <option value="NA">NA</option>
          <?php
          foreach($obj->stores as $entry){
           ?>
          <option value="<?php echo $entry; ?>"><?php echo $entry; ?></option>
          <?php
          }
          ?>
        </select>
        </div>
        <br>
        <input type="submit" name="ctype" value="Debit" class="btn btn-danger">
        <input type="submit" name="ctype" value="Credit" class="btn btn-success">
      </form>
    </div>
  </div>
</div>
<div id="monthly" class="collapse">
  <div class="panel panel-success">
    <div class="panel-heading"><b>Recurring Monthly Debit/Credit Total</b></div>
    <div class="panel-body">
      <form method="post" action="<?php wd_urlSub($wd_type, $wd_app, 'monthly.php', '&title=' . $title); ?>">
        <input type="number" step="0.01" name="monthly" placeholder="$50.12" class="form-control" value="<?php if(isset($obj->monthlya)){ echo $obj->monthlya; } ?>">
        <input type="submit" value="Submit" class="btn btn-success">
      </form>
    </div>
  </div>
</div>
<div class="panel panel-primary">
  <div class="panel-heading"><b><?php echo $title . ' has $' . $obj->total . ' left!'; ?></b></div>
  <div class="panel-body" style="color: #000000;">
    <table class="table table-striped" style="color: #000000;">
    <thead>
      <tr>
        <th>ID</th>
        <th>Date</th>
        <th>Note</th>
        <th>Type</th>
        <th>Amount</th>
        <th>Balance</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if(isset($obj->items)){
        echo $obj->items;
      }
      ?>
    </tbody>
    </table>
  </div>
</div>