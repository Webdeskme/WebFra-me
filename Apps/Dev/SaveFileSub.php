<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
$nameA = test_input($_POST["nameA"]);
$nameP = test_input($_POST["nameP"]);
$type = test_input($_POST["type"]);
$con = htmlspecialchars_decode($wd_POST["content"], ENT_QUOTES);

if(!is_dir($type . "/" . $nameA . "/.wf_history")){
	mkdir($type . "/" . $nameA . "/.wf_history",0755);
}
$old_con = file_get_contents($type . "/" . $nameA . "/" . $nameP);
if($old_con != $con)
	file_put_contents($type . "/" . $nameA . "/.wf_history/" . $nameP . "_" . microtime(true), $old_con);

if(!file_put_contents($type . "/" . $nameA . "/" . $nameP, $con))
	echo "Could not save file `" . $type . "/" . $nameA . "/" . $nameP . "`. Do you have the right permissions?";
else
	wd_head($wd_type, $wd_app, 'editfile.php', '&editType=' . $type . '&editApp=' . $nameA . '&file=' . $nameP);
?>
