<!DOCTYPE html>
<?php
$wd_stype = 'MyApps';
$wd_sapp = 'BiddingFront';
include 'HUDstart.php';
if(!isset($_GET['type']) || !isset($_GET['app']) || !isset($_GET['sec'])){
  wd_head($wd_stype, $wd_sapp, 'start.php', '');
}
?>
<html>
  <head>
    <?php include 'HUDhead.php';?>
  </head>
  <body>
    <div class="page-header">
      <a href="<?php wd_url($wd_stype, $wd_sapp, 'start.php', ''); ?>" style="font-size: 2em;"><b><?php echo $wd_sapp; ?></b></a>
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
