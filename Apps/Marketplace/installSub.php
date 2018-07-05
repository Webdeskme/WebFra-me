<?php
$napp = test_input($_GET['napp']);
$www = test_input($_GET['www']);
$file = $www . '/Pub/' . $napp . '/master.zip';
$folder = 'Apps/' . $napp . '/';
mkdir($folder);
file_put_contents($folder . 'Tmpfile.zip', fopen($file, 'r'));
$zip = new ZipArchive;
$zip->open($folder . 'Tmpfile.zip');
$zip->extractTo($folder);
$zip->close();
unlink($folder . 'Tmpfile.zip');
wd_head($wd_type, $wd_app, 'single.php', '&unit=' . $napp . '&www=' . $www);
?>
