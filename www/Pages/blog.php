<?php
$xml=("feed.xml");
$xmlDoc = new DOMDocument();
$xmlDoc->load($xml);

//get elements from "<channel>"
$channel=$xmlDoc->getElementsByTagName('channel')->item(0);
$channel_title = $channel->getElementsByTagName('title')
->item(0)->childNodes->item(0)->nodeValue;
$channel_link = $channel->getElementsByTagName('link')
->item(0)->childNodes->item(0)->nodeValue;
$channel_desc = $channel->getElementsByTagName('description')
->item(0)->childNodes->item(0)->nodeValue;

//output elements from "<channel>"
echo "<h2>" . $channel_desc . "</h2>";

//get and output "<item>" elements
$x=$xmlDoc->getElementsByTagName('item');
foreach ($x as $item) {
  $item_title=$item->getElementsByTagName('title')
  ->item(0)->childNodes->item(0)->nodeValue;
  $item_link=$item->getElementsByTagName('link')
  ->item(0)->childNodes->item(0)->nodeValue;
  $item_desc=$item->getElementsByTagName('description')
  ->item(0)->childNodes->item(0)->nodeValue;
//$item_date=$x->item($i)->getElementsByTagName('pubDate')
//  ->item(0)->childNodes->item(0)->nodeValue;
  echo ("<div><h2><a href='" . $item_link
  . "'>" . $item_title . "</a></h2>");
  //echo ("<p><b>" . $item_date . "</b></p>");
  echo ("<div>" . $item_desc . "</div></div>");
}
?>