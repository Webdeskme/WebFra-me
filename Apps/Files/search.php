<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; } ?>
<div id="load">Loading</div>
<form method="post" action="<?php wd_urlSub($wd_type, $wd_app, 'searchSub.php', ''); ?>">
<input list="ldir" placeholder="Type App Name" id="dir" name="dir">
  <datalist id="ldir">
<?php
function search($wd_file, $file){
foreach(glob($file) as $entry){
 if($entry != '.' || $entry != '..'){
   ?>
   <option value="<?php echo str_replace($wd_file, "", $entry); ?>">
     <?php
   if(is_dir($entry)){
     $file = $entry . "/*";
     ob_flush();
     flush();
     search($wd_file, $file);
   }
 }
}
}
$file = $wd_file . "*";
search($wd_file, $file);
    ob_end_flush();
?>
     </datalist>
<input type="submit" value="Go" class="btn btn-primary">
</form>
<script>document.getElementById("load").innerHTML = "Loaded";</script>
