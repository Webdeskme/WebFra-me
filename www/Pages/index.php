<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
if(file_exists("feed.php")){
$xml=("feed.php");
$xmlDoc = new DOMDocument();
$xmlDoc->load($xml);
$x=$xmlDoc->getElementsByTagName('item');
for ($i=0; $i<=2; $i++) {
  if(is_object($x->item($i))){
  $item_title=$x->item($i)->getElementsByTagName('title')
  ->item(0)->childNodes->item(0)->nodeValue;
  $item_link=$x->item($i)->getElementsByTagName('link')
  ->item(0)->childNodes->item(0)->nodeValue;
  $item_desc=$x->item($i)->getElementsByTagName('description')
  ->item(0)->childNodes->item(0)->nodeValue;
//$item_date=$x->item($i)->getElementsByTagName('pubDate')
//  ->item(0)->childNodes->item(0)->nodeValue;
  echo '<div><h2><a href="' . $item_link
  . '">' . $item_title . "</a></h2>";
  echo "<div>" . $item_desc . "</div></div>";
}}
}
?>
