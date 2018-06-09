<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
$nameA = test_input($_POST["nameA"]);
$tooltip = test_input($_POST["tooltip"]);
$icon = test_input($_POST["icon"]);
$con = htmlspecialchars($_POST["con"]);
$myObj->tooltip = $tooltip;
$myObj->icon = $icon;
$myObj->code = $con;
$myJSON = json_encode($myObj);
file_put_contents('MyApplets/' . $nameA, $myJSON);
wd_head($wd_type, $wd_app, 'MyPageApl.php', '&MyApp=' . $nameA);
?>
