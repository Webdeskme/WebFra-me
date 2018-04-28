<?php
$www = 'desktop.php?type=Apps&app=Market&sec=start.php';
?>
<div class="alert alert-info alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    Last updated: <?php echo date("F d Y H:i:s.",filemtime("wd_market.json")); ?> - <a href="<?php wd_urlSub($wd_type, $wd_app, 'UpList.php', ''); ?>"><u><strong>Update List</strong></u></a>
</div>
<div class="container">
  <h1>Creator's Market</h1>
  <div class="btn-group">
    <a href="<?php echo $www; ?>"><button type="button" class="btn btn-primary">All</button></a>
    <a href="<?php echo $www; ?>&cat=Accessories"><button type="button" class="btn btn-primary">Accessories</button></a>
    <a href="<?php echo $www; ?>&cat=Education"><button type="button" class="btn btn-primary">Education</button></a>
    <a href="<?php echo $www; ?>&cat=Graphics"><button type="button" class="btn btn-primary">Graphics</button></a>
    <a href="<?php echo $www; ?>&cat=Internet"><button type="button" class="btn btn-primary">Internet</button></a>
    <a href="<?php echo $www; ?>&cat=Office"><button type="button" class="btn btn-primary">Office</button></a>
    <a href="<?php echo $www; ?>&cat=Other"><button type="button" class="btn btn-primary">Other</button></a>
    <a href="<?php echo $www; ?>&cat=Programming"><button type="button" class="btn btn-primary">Programming</button></a>
    <a href="<?php echo $www; ?>&cat=Sound Video"><button type="button" class="btn btn-primary">Sound Video</button></a>
    <a href="<?php echo $www; ?>&cat=Administration"><button type="button" class="btn btn-primary">Administration</button></a>
  </div>
  <div id="market"><span id="load"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
<span class="sr-only">Loading...</span></span></div>
</div>
<script>
$(document).ready(function(){
  var $_GET = {};

document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
    function decode(s) {
        return decodeURIComponent(s.split("+").join(" "));
    }

    $_GET[decode(arguments[1])] = decode(arguments[2]);
});
    $.getJSON("wd_market.json", function(result){
        $.each(result, function(i, x){
          if(!$_GET['cat'] || $_GET['cat'] == x['cat']){
            $("#market").append('<a href="desktop.php?type=Apps&app=Market&sec=single.php&unit=' + x['app'] + '&www=' + x['host'] + '"><figure style="float: left; padding: 10px; background-color: rgb(128,128,128, 0.2)">' + '<img src="' + x['host'] + '/Pub/' + x['app'] + '/ic.png" style="height: 50px; width: 50px;"><figcaption style="text-align: center;">' + x['app'] + '<br>' + x['cat'] + '</figcaption></figure></a>');
        }
        });
    });
  $("#load").hide();
});
</script>
