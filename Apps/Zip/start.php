<?php include_once "../../wd_protect.php"; ?>
<a href="<?php wd_url('Apps', 'Files', 'start.php', '&prog=' . $wd_app . '&ptype=' . $wd_type . '&psec=start.php&pb=Zip This Folder'); ?>">Zip Folder</a><br>
<?php
if(isset($_GET['title']) && isset($_GET['dir'])){
$title = test_input($_GET['title']);
$dir = test_input($_GET['dir']);
$ext = pathinfo($wd_file . $title, PATHINFO_EXTENSION);
$ext = strtolower($ext);
if($ext == 'zip'){
?>
<a href="<?php wd_urlSub($wd_type, $wd_app, 'startSub.php', '&title=' . $title . '&dir=' . $dir); ?>">Unzip</a>
<?php
}
}
elseif(isset($_GET['pb'])){
$pb = test_input($_GET['pb']);

//////////////////////////////////////////////

echo '<br>start zipping....<br>';
function Zip($source, $destination)
{
    if (!extension_loaded('zip') || !file_exists($source)) {
        echo 'Problem with file.<br>';
        return false;
    }
//$destination = str_replace('\\', '/', realpath($destination));
    $zip = new ZipArchive();
    if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
        echo 'Problem with destination.<br>';
        return false;
    }
    else{
		$zip->open($destination, ZIPARCHIVE::CREATE);
	}

    //$source = str_replace('\\', '/', realpath($source));

    echo 'Source: ' . $source . '<br>Destination: ' . $destination . '<br>';
echo 'running ....<br>';
    if (is_dir($source) === true)
    {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($files as $file)
        {
            $file = str_replace('\\', '/', $file);

            // Ignore "." and ".." folders
            if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
                continue;

           // $file = realpath($file);
echo $file . '<br>';
            if (is_dir($file) === true)
            {
				$x = str_replace($source . '/', '', $file . '/');
				echo 'Dir: ' . $x . '<br>';
                //$zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                $zip->addEmptyDir($x);
            }
            else if (is_file($file) === true)
            {
				$x = str_replace($source . '/', '', $file);
				echo 'file: ' . $x . '<br>';
                //$zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
            }
        }
    }
    else if (is_file($source) === true)
    {
        $zip->addFromString(basename($source), file_get_contents($source));
    }

    return $zip->close();
}

$source = $wd_file . $pb;
$destination = $wd_file . $pb . 'NewZip.zip';

Zip($source, $destination);

echo 'Zipped!<br>';

////////////////////////////////////////////



echo 'Done<br>';
}

?>
