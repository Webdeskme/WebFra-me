<div class="wd_console">
  <h1 id="title">-></h1>
  <?php echo $wd_console; ?>
  <form method="post" action="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>">
    <input type="hidden" name="wd_console" value="<?php echo htmlspecialchars($wd_console); ?>">
    <input type="hidden" name="wd_cnum" value="<?php echo $wd_cnum = $wd_cnum + 1; ?>">
    <?php
    foreach($wd_cvar as $key => $value){
    ?>
    <input type="hidden" name="wd_cvar[<?php echo $key; ?>]" value="<?php echo $value; ?>">
    <?php
    }
    ?>
    <input type="text" class="wd_cinput" name="wd_cinput" placeholder="$" required autofocus>
  </form>
</div>
<script>
  var showText = function (target, message, index, interval) {   
  if (index < message.length) {
    $(target).append(message[index++]);
    setTimeout(function () { showText(target, message, index, interval); }, interval);
  }
}
  $(function () {

  showText("#title", "<?php echo $wd_app; ?>", 0, 500);   

});
</script>