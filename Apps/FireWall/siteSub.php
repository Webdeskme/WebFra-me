<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
$num = test_input($_POST['num']);
$default = test_input($_POST['default']);
$con = "<?php return [ ";
for ($x = 1; $x <= $num; $x++) {
  if($_POST['n' . $x] != ""){
  $n['n' . $x] = test_input($_POST['n' . $x]);
  $p['p' . $x] = test_input($_POST['p' . $x]);
  $con = $con . "'" . $n['n' . $x] . "' => '" . $p['p' . $x] . "', ";
  }
}
$con = $con . "'default' => '" . $p[$default] . "' ]; ?>";
file_put_contents("path.php", $con);
wd_head($wd_type, $wd_app, 'site.php', '&wd_as=Path saved');
?>
