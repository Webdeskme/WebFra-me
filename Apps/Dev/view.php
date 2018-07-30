<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
$MyApp = test_input($_GET['MyApp']);
$MyPage = test_input($_GET['MyPage']);
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
        <title>Dev View</title>
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
		<form method="post" action="<?php wd_urlSub($wd_type, $wd_app, 'view.php', '&MyApp=' . $MyApp . '&MyPage=' . $MyPage); ?>">
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
    <h1>Dev View: <?php echo "MyApps/" . $MyApp . "/" . $MyPage; ?></h1>
    <pre><code class="html">
<?php
if(file_exists("MyApps/" . $MyApp . "/" . $MyPage)){
    echo htmlspecialchars(file_get_contents("MyApps/" . $MyApp . "/" . $MyPage));}
?>
    </code></pre>
    <script src="<?php echo $wd_type . '/' . $wd_app; ?>/highlight.pack.js"></script>
    <script src="<?php echo $wd_type . '/' . $wd_app; ?>/highlightjs-line-numbers.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
    <script>hljs.initLineNumbersOnLoad();</script>
    </body>
</html>
