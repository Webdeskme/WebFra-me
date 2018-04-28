<?php
$nameA = test_input($_POST["nameA"]);
file_put_contents("MyApplets/" . $nameA . ".json", '{"tooltip":"Logout","icon":"glyphicon glyphicon-off","code":"Hello World!"}');
header('Location: desktop.html?type=Apps&app=Dev&sec=MyPageApl.php&MyApp=' . $nameA . '.json');
?>