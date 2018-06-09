<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
$htype = test_input($_GET['htype']);
$app = test_input($_GET['happ']);
?>
<br><br>
<a href="<?php wd_url($wd_type, $wd_app, 'AppHelp.php', '&htype= ' . $htype . '&happ=' . $app); ?>"><button class="btn btn-primary">Back</button></a>
<?php
$page = test_input($_GET['page']);
if(file_exists($htype . '/' . $app . '/' . $page)){
  echo '<h1>' . $app . '/' . $page . '</h1>' . file_get_contents($htype . '/' . $app . '/' . $page);
}
?>
