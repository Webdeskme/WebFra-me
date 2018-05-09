<?php
//session_start();
//include("testInput.php");
$nameA = test_input($_POST["nameA"]);
$dir = test_input($_POST["dir"]);
$type = test_input($_POST["type"]);
if(isset($_POST["type"]) and $type == "File"){
file_put_contents($_SESSION['root'] . $dir . $nameA, 'Your empty file.');
header('Location: desktop.php?type=Apps&app=Terminal&sec=MyPage.php&dir=' . $dir . '&file=' . $nameA);
}
else{
mkdir($_SESSION['root'] . $dir . $nameA);
header('Location: desktop.php?type=Apps&app=Terminal&sec=start.php&dir=' . $dir);
}
?>
