<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
require "Plugins/php-html-css-js-minifier.php";
function get_and_write($url, $cache_file) {
$string = file_get_contents($url);
$string = fn_minify_html($string);
$f = fopen($cache_file, 'w');
fwrite ($f, $string, strlen($string));
fclose($f);
}
$wwwCopy = scandir($wd_root . '/www/Pages/');
$theme = test_input(file_get_contents($wd_root . "/Admin/dtheme.txt"));
foreach($wwwCopy as $key => $value){
  if($value != '.' && $value != '..' && $value != 'blog.php' && $value != 'banner.php' && $value != 'header.php' && $value != 'footer.php' && $value != 'feed.json' && $value != 'nav.json' && $value != 'contactSub.php'){
  $cache_file = $path . '/Cache/' . $value;
  $url = 'http://' . $_SERVER['HTTP_HOST'] . '/cache.php?page=' . $value . '&wd_no-cache=' . $theme;
  get_and_write($url, $cache_file);
}
}
wd_head($wd_type, $wd_app, 'start.php', '');
?>
