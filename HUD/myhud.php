<!DOCTYPE html>
<?php
$wd_stype = "MyApps";
$wd_sapp = "MyHUD";
include 'HUDstart.php';
if(!isset($_GET['type']) || !isset($_GET['app']) || !isset($_GET['sec'])){
  wd_head($wd_stype, $wd_sapp, 'app_nav.php', '');
}
?>
<html>
  <head>
    <?php include 'HUDhead.php';?>
    <style>
      html, body{
        background-color: #fffa4e;
        color: #37ff29;
      }
      a, h1, h2, h3, h4, h5, h6, p, b{
        color: #37ff29;
      }
    </style>
  </head>
  <body>
    <div class="page-header">
      <a href="<?php wd_url($wd_stype, $wd_sapp, 'app_nav.php', ''); ?>" style="font-size: 2em;"><b><?php echo "myhudd"; ?></b></a>
      <span style="float: right;">
        <a href="logout.php">
          <button type="button" class="btn btn-danger btn-sm">
            <span class="glyphicon glyphicon-off"></span> Logout
          </button>
        </a>
      </span>
      <span style="float: right;">
        <form method="post" action="Home.php?id=<?php $val = test_input(file_get_contents($wd_adminFile . 'val.txt')); echo $_SESSION["user"] . '&val=' . $val; ?>&type=<?php echo $_SESSION["HUD"]; ?>">
        <input type="submit" name="lastPage" class="btn btn-primary btn-sm" Value="AutoLogin">
    </form>
      </span>
    </div>
    <?php
    include 'HUDcon.php';
    include 'HUDfoot.php';
    ?>
    <?php
  if(isset($_GET['wd_dev'])){
    ?>
  <script src="Plugins/tota11y-master/build/tota11y.min.js"></script>
    <?php
  }
     ?>
  </body>
</html>