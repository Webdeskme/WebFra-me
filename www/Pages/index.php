<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
/* if(file_exists("feed.php")){
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
} */
?>
<div id="content-div"></div>
<script>
$.get("/feeds/newsfeed.php", function(data) {
    var $XML = $(data);
    $XML.find("item").each(function() {
        var $this = $(this),
            item = {
                title:       $this.find("title").text(),
                link:        $this.find("link").text(),
                description: $this.find("description").text(),
                pubDate:     $this.find("pubDate").text(),
                author:      $this.find("author").text()
            };
        $('#content-div').append($('<h2/>').text(item.title));
        $('#content-div').append($('<h2/>').text(item.title));
        //etc...
    });
});
?>
