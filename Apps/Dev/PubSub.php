<?php
//session_start();
//ini_set("display_errors", 1);
//include("testInput.php");
$MyApp = test_input($_GET["MyApp"]);
//$MyApp = 'Text';
//exec("tar -czf Pub/" . $MyApp . ".tar.gz " MyApps/" . $MyApp);
if(!file_exists('Pub/' . $MyApp)){
mkdir('Pub/' . $MyApp);
}
if(file_exists('MyApps/' . $MyApp . '/ic.png')){
copy('MyApps/' . $MyApp . '/ic.png', 'Pub/' . $MyApp . '/ic.png');
}
if(file_exists('MyApps/' . $MyApp . '/des.txt')){
copy('MyApps/' . $MyApp . '/des.txt', 'Pub/' . $MyApp . '/des.txt');
}
/*$zip = new ZipArchive();
$zip->open('Pub/' . $MyApp . '/wd_app.zip', ZipArchive::CREATE);
	$zip->addEmptyDir($MyApp);
 if ($handle = opendir('MyApps/' . $MyApp . '/')) {
	while (false !== ($entry = readdir($handle))) {
		if ($entry != "." && $entry != "..") {
			$zip->addFile('MyApps/' . $MyApp . '/' . $entry, $MyApp . '/' . $entry);
		}
    }
    closedir($handle);
 }
$zip->close();*/
wd_zip('MyApps/' . $MyApp, 'Pub/' . $MyApp . '/master.zip');
//header('Location: desktop.html?type=Apps&app=Dev&sec=MyApp.php&MyApp=' . $MyApp);
wd_head($wd_type, $wd_app, 'MyApp.php', '&MyApp=' . $MyApp);
?>
