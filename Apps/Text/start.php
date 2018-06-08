<?php include_once "../../wd_protect.php"; ?>
<div style="width: 100%; height: 100%; background-color: yellow; padding: 0px; margin: 0px;">
<h1 style="margin: 0px;">Text</h1>
<a href="<?php wd_url('Apps', 'Files', 'start.php', '&prog=' . $wd_app . '&ptype=' . $wd_type . '&psec=start.php'); ?>">Open File</a><br>
<hr>
<form method="post" action="<?php wd_urlSub($wd_type, $wd_app, 'startSub.php', ''); ?>">
<input type="text" name="title" placeholder="Title Text" value="<?php if(isset($_GET["title"])){
$title = test_input($_GET["title"]); echo $title;} ?>">
<br><br>
<textarea id="text" name="text" rows="10" placeholder="Place text here." style="width: 80%;" autofocus><?php if(isset($_GET["title"])){
if(file_exists($wd_file . $title)){
echo htmlspecialchars(file_get_contents($wd_file  . $title));}} ?></textarea>
<br>
<input type="submit" value="Save">
</form>
</div>
