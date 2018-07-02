<?php 
$title = test_input($_GET['title']);
$price = test_input($_POST['price']);
$date = test_input($_POST['date']);
$stores = test_input($_POST['stores']);
$ctype = test_input($_POST['ctype']);
$obj = file_get_contents($wd_appFile . 'Budget/' . $title . '.json');
$obj = json_decode($obj);
if(!isset($obj->id)){
  $obj->id = 1;
}
else{
  $obj->id = $obj->id + 1;
}
if($ctype === "Debit"){
  $price = -1 * $price;
  $ctype = '<span style="color: #ff0000;">' . $ctype . '</span>';
  $obj->total = $obj->total + $price;
  $price = '<span style="color: #ff0000;">' . $price . '</span>';
}
else{
  $obj->total = $obj->total + $price;
  $ctype = '<span style="color: #33cc33;">' . $ctype . '</span>';
  $price = '<span style="color: #33cc33;">' . $price . '</span>';
}
if($obj->total >= 0){
  $bal = '<span style="color: #33cc33;">' . $obj->total . '</span>';
}
else{
  $bal = '<span style="color: #ff0000;">' . $obj->total . '</span>';
}
$x = '<tr><td>' . $obj->id . '</td><td>' . $date . '</td><td>' . $stores . '</td><td>' . $ctype . '</td><td>' . $price . '</td><td>' . $bal . '</td></tr>';
if(isset($obj->items)){
  $obj->items = $obj->items . $x;
}
else{
  $obj->items = $x;
}
$myJSON = json_encode($obj);
file_put_contents($wd_appFile . 'Budget/' . $title . '.json', $myJSON);
wd_head($wd_type, $wd_app, 'budget.php', '&title=' . $title);
?>