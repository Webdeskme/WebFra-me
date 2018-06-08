<?php include_once "../../wd_protect.php"; ?>
<h1>File Path</h1>
<form method="post" action="<?php wd_urlSub($wd_type, $wd_app, 'FpathSub.php', ''); ?>">
  <input type="text" name="path" value="<?php echo file_get_contents("path.php"); ?>">
  <input type="submit" value="Save Path">
</form>
