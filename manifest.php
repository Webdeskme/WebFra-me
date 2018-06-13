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
  "theme_color": "#317EFB",
  "description": "App made on WebDesk!",
  "prefer_related_applications": false,
  "icons": [{
    "src": "favicon.ico",
    "sizes": "128x128",
    "type": "image/x-icon"
  }, {
    "src": "splash.png",
    "sizes": "512×512",
    "type": "image/png"
  }]
}
