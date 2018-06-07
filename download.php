<?php
$file=$GET["file"];
$mimet = mime_content_type($file);
header("Content-disposition: attachment; filename=" . $file);
header("Content-type: " . $mimet);
readfile($file);
?>