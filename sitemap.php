<?php
header('Content-Type: application/xml; charset=utf-8');
include "testInput.php";
<?xml version="1.0" encoding="UTF-8"?>
<urlset
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	  xmlns:xhtml="http://www.w3.org/1999/xhtml"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
if(file_exists($wd_www . 'nav.json')){
  $json = file_get_contents($wd_www . 'nav.json');
  $json = json_decode($json, true);
  foreach($json as $key => $vlue){
    ?>
    <url>
       <loc><?php echo $_SERVER['HTTP_HOST']; ?>?page=<?php echo $json[$key]['page']; ?></loc>
       <lastmod><?php echo date("c", filemtime($wd_www . $json[$key]['page'])); ?></lastmod>
       <lastmod>2018-06-12T10:01:56+00:00</lastmod>
       <changefreq>monthly</changefreq>
    </url>
    <?php
  }
}
 ?>
 </urlset>
