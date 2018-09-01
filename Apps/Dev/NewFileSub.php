<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
$nameA = test_input($_POST["nameA"]);
$nameP = test_input($_POST["nameP"]);
$type = test_input($_POST["type"]);
if(!file_put_contents($type . "/" . $nameA . "/" . $nameP, '<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; } ?>'))
	echo "Could not create file `" . $type . "/" . $nameA . "/" . $nameP . "`. Do you have permission?";
else
	wd_head($wd_type, $wd_app, 'editfile.php', '&editType=' . $type . '&editApp=' . $nameA . '&file=' . $nameP);
?>
