<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
if(isset($_GET['dir'])){$dir = test_input($_GET['dir']); if(isset($_GET['file'])){$file = test_input($_GET['file']);}}
else{ $dir = ""; $file=""; }
$OldDir = $dir;
$dir = $dir . $file;
if(isset($_POST['css'])){
	$css = test_input($_POST['css']);
}
else{
	$css = "agate.css";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Terminal View</title>
        <link href="<?php echo $wd_type . '/' . $wd_app; ?>/styles/<?php echo $css; ?>" rel="stylesheet" />
        <style>
			.hljs-line-numbers {
				text-align: right;
				border-right: 1px solid #ccc;
				color: #999;
				-webkit-touch-callout: none;
				-webkit-user-select: none;
				-khtml-user-select: none;
				-moz-user-select: none;
				-ms-user-select: none;
				user-select: none;
			}
		</style>
    </head>
    <body>
		<a href="desktop.html?type=Apps&app=Terminal&sec=start.php<?php if($OldDir != ""){echo '&dir=' . rtrim($OldDir, '/');} ?>"><button class="btn btn-primary">Back</button></a>
		<br><br>
		<form method="post" action="<?php wd_urlSub($wd_type, $wd_app, 'view.php', '&dir=' . $OldDir . '&file=' . $file); ?>">
			<select name="css">
				<?php
				if ($handle = opendir($wd_type . '/' . $wd_app . '/styles/')) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
				?>
				<option value="<?php echo $entry; ?>" <?php if($css == $entry){ echo 'selected="selected"';} ?>><?php echo $entry; ?></option>
				<?php
			}}}
				?>
			</select>
			<input type="submit" value="Show">
		</form>
    <h1>Terminal View: <?php echo $dir; ?></h1>
    <pre><code class="html">
<?php
if(file_exists($dir)){
    echo htmlspecialchars(file_get_contents($dir));}
?>
    </code></pre>
    <script src="<?php echo $wd_type . '/' . $wd_app; ?>/highlight.pack.js"></script>
    <script src="<?php echo $wd_type . '/' . $wd_app; ?>/highlightjs-line-numbers.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
    <script>hljs.initLineNumbersOnLoad();</script>
    </body>
</html>
