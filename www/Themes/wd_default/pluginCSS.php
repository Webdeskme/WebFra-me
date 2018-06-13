<?php
header("Content-type: text/css; charset: UTF-8");
//string session_cache_limiter ('public');
$seconds_to_cache = 86400;
$ts = gmdate("D, d M Y H:i:s", time() + $seconds_to_cache) . " GMT";
header("Expires: $ts");
header("Pragma: cache");
header("Cache-Control: public, max-age=$seconds_to_cache");
echo file_get_contents("style.css");
//echo file_get_contents("../../../Theme/default.php");
//echo file_get_contents("style.css");
?>
