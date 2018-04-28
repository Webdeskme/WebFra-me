<?php
$nameA = test_input($_POST["nameA"]);
$tooltip = test_input($_POST["tooltip"]);
$icon = test_input($_POST["icon"]);
$con = htmlspecialchars($_POST["con"]); 
$myObj->tooltip = $tooltip;
$myObj->icon = $icon;
$myObj->code = $con;
$myJSON = json_encode($myObj);
file_put_contents('MyApplets/' . $nameA, $myJSON);
header('Location: desktop.html?type=Apps&app=Dev&sec=MyPageApl.php&MyApp=' . $nameA);
?>