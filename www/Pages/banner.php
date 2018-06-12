<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; } ?>
<br><br>
<div class="jumbotron" style="margin: 0px; background-color: #9966ff;">
  <div class="container">
    <h1 style="color: #000000;"><?php echo $wd_Title; ?></h1>
  </div>
</div>
<?php
wd_nav($page, "light", $wd_Title, "yes", "fixed", "simple", "");
?>
