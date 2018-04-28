<?php
  $www = test_input($_GET['www']);
  $unit = test_input($_GET['unit']);
?>
<div class="container" style="width: 100%; height: 100%;">
  <div class="row">
  <div class="col-sm-4">
    <figure style="width: 100%; float: left;"><img src="<?php echo $www . '/Pub/' . $unit . '/ic.png'; ?>" style="width: 100%;"><figcaption style="text-align: center;"><a href="<?php wd_urlSub($wd_type, $wd_app, 'installSub.php', '&napp=' . $unit . '&www=' . $www); ?>"><button class="btn btn-success">Install</button></a></figcaption></figure>
  </div>
  <div class="col-sm-8">
  <span id="market">
    <span id="load">
      <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
      <span class="sr-only">Loading...</span>
    </span>
  </span>
  <span>
    <h2><b>Description: </b></h2>
    <p id="des1"></p>
  </span>
  </div>
  </div>
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
            $("#market").append('<h1><b>' + $_GET['unit'] + '</b></h1><dl><dt>Category: </dt><dd><a href="' + result[$_GET['unit']]['host'] + '" target="_blank">- ' + result[$_GET['unit']]['host'] + '</a></dd><dt>Email: </dt><dd>- ' + result[$_GET['unit']]['email'] + '</dd><dt>Version: </dt><dd>- ' + result[$_GET['unit']]['vr'] + '</dd><dt>Ratting: </dt><dd>- ' + result[$_GET['unit']]['rate'] + '</dd></dl>');
    });
  $("#load").hide();
  $("#des1").load($_GET['www'] + '/Pub/' + $_GET['unit'] + '/des.txt');
});
</script>
