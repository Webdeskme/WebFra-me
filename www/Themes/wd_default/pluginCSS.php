<?php
header("Content-type: text/css; charset: UTF-8");
//$a = array("../../../Plugins/bootstrap-3.3.7-dist/css/bootstrap.min.css", "../../../Theme/default.php", "style.css");
$a = array("../../../Plugins/wd-bootstrap/css/webdesk_bootstrap.min.css", "../../../Theme/default.php", "style.css");
$seconds_to_cache = 86400 * 30;
$ts = gmdate("D, d M Y H:i:s", time() + $seconds_to_cache) . " GMT";
header("Expires: $ts");
header("Pragma: cache");
header("Cache-Control: public, max-age=$seconds_to_cache");
$last_modified_time = "";
foreach ($a as $value) {
  $last_modified_time = $last_modified_time . filemtime($value);
}
$etag = md5_file("pluginCSS.php" . $last_modified_time);
//header("Last-Modified: ".gmdate("D, d M Y H:i:s", $last_modified_time)." GMT");
header("Etag: $etag");
foreach ($a as $value) {
  echo file_get_contents($value);
}
?>
