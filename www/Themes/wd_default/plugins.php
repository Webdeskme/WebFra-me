<?php
//header("Content-type: application/x-javascript");
$seconds_to_cache = 86400;
$ts = gmdate("D, d M Y H:i:s", time() + $seconds_to_cache) . " GMT";
header("Expires: $ts");
header("Pragma: cache");
header("Cache-Control: Public, max-age=$seconds_to_cache");
echo file_get_contents("../../../Plugins/jquery.min.js");
echo file_get_contents("../../../Plugins/bootstrap-3.3.7-dist/js/bootstrap.min.js");
echo file_get_contents("../../../Plugins/fontawesome-free/svg-with-js/js/fontawesome-all.min.js");
?>
