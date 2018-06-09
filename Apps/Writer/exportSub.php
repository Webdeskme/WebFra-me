<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
//$title = test_input($_GET['title']);
$title = $_GET['title'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
    </head>
    <body>
        <?php if(isset($_GET["title"])){ $f = fopen($wd_file . $title . '.wd_writer', "r");
	while(!feof($f)) {
	    echo htmlspecialchars_decode(fgets($f));
	}
	fclose($f);} ?>
    </body>
</html>
