<?php
header('Content-type: application/manifest+json');
include 'testInput.php';
?>
{
  "dir": "rtl",
  "lang": "en-US",
  "orientation": "portrait-primary",
  "name": "<?php echo $wd_Title; ?>",
  "short_name": "<?php echo substr($wd_Title, 0, 10); ?>",
  "display": "standalone",
  "background_color": "#fff",
  "description": "App made on WebDesk!",
  "prefer_related_applications": false,
  "icons": [{
    "src": "favicon.ico",
    "sizes": "48x48",
    "type": "image/x-icon"
  }, {
    "src": "favicon.ico",
    "sizes": "72x72",
    "type": "image/x-icon"
  }, {
    "src": "favicon.ico",
    "sizes": "96x96",
    "type": "image/x-icon"
  }, {
    "src": "favicon.ico",
    "sizes": "144x144",
    "type": "image/x-icon"
  }, {
    "src": "favicon.ico",
    "sizes": "168x168",
    "type": "image/x-icon"
  }, {
    "src": "favicon.ico",
    "sizes": "192x192",
    "type": "image/x-icon"
  }]
}
