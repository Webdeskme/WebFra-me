<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
include_once("config.inc.php");
include("appHeader.php");

if(isset($_POST['con'])){
  $con = htmlspecialchars_decode($wd_POST["con"], ENT_QUOTES);
  file_put_contents($wd_www . "header.php", $con);
}
?>

<form method="post" action="<?php wd_url($wd_type, $wd_app, 'pheader.php', ''); ?>" style="width: 100%; height: 90%;">
  
  <div class="webdesk_row webdesk_bg-light">
    <div class="webdesk_col py-3 px-5">
      <h3>Site Head</h3>
    </div>
  </div>
  <div class="webdesk_row webdesk_no-gutters" style="height: 100%;">
    <div class="webdesk_col-md-9" style="height: 100%;">
      <textarea name="con" id="con" for="con" class="webdesk_form-control" placeholder="Enter your content." title="Enter your content." style="width: 100%; height:100%; background-color: #000000; color: #ffffff; font-weight: bold; font-size: 1.25em;"  autofocus><?php
    if(file_exists($wd_www . "header.php")){
      echo htmlspecialchars(file_get_contents($wd_www . "header.php"));
    }
    ?></textarea>
    </div>
    <div class="webdesk_col-md-3">
      <div class="webdesk_bg-light webdesk_py-3 webdesk_px-4 webdesk_sticky-top">
        <p>
          This is the contents of the &lt;head&gt; tag. You should include your css, javascript and other meta information here.
        </p>
        <button type="submit" class="webdesk_btn webdesk_btn-primary webdesk_btn-block"><i class="fa fa-save fa-fw"></i> Update</button>
      </div>
    </div>
  </div>
  
</form>
<?php
include("appFooter.php");
?>