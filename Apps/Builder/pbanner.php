<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
include_once("config.inc.php");
include("appHeader.php");

if(isset($wd_POST['con'])){
  $con = htmlspecialchars_decode($wd_POST["con"], ENT_QUOTES);
  file_put_contents($wd_www . "banner.php", $con);
}
?>

<form method="post" action="<?php wd_url($wd_type, $wd_app, 'pbanner.php', ''); ?>" style="width: 100%; height: 100%;">

  <div class="row bg-light">
    <div class="col py-3 px-5">
      <h3>Banner Content</h3>
    </div>
  </div>
  <div class="row no-gutters" style="height: 100%;">
    <div class="col-md-9" style="height: 100%;">
  
    <textarea name="con" id="con" for="con" placeholder="Enter your content." title="Enter your content." style="width: 100%; height:100%; background-color: #000000; color: #ffffff; font-weight: bold; font-size: 1.25em;"  autofocus><?php
      if(file_exists($wd_www . "banner.php")){
        echo htmlspecialchars(file_get_contents($wd_www . "banner.php"));
      }
    ?></textarea>
  </div>
  <div class="col-md-3" style="height: 100%">
      <div class="bg-light py-3 px-4 sticky-top" style="height: 100%;">
        <p>
          This is the banner at the top of every page. It should include a navigation and any logos or sign in information.
        </p>
        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-save fa-fw"></i> Update</button>
      </div>
    </div>
</form>
<br>
<?php
include("appFooter.php");
?>