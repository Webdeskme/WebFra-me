<!-- wd_clock -->
  <div class="webdesk_modal" id="wd_clock" role="dialog">
    <div class="webdesk_modal-dialog webdesk_modal-lg">
      <div class="webdesk_modal-content">
        <div class="webdesk_modal-header">
          
          <h4 class="webdesk_modal-title">Time</h4>
          <button type="button" class="webdesk_close" data-dismiss="webdesk_modal">&times;</button>
        </div>
        <div class="webdesk_modal-body">

          <canvas id="canvas" width="400" height="400"style="background-color:#333">
</canvas>

<script>
var canvas = document.getElementById("canvas");
var ctx = canvas.getContext("2d");
var radius = canvas.height / 2;
ctx.translate(radius, radius);
radius = radius * 0.90
setInterval(drawClock, 1000);

function drawClock() {
  drawFace(ctx, radius);
  drawNumbers(ctx, radius);
  drawTime(ctx, radius);
}

function drawFace(ctx, radius) {
  var grad;
  ctx.beginPath();
  ctx.arc(0, 0, radius, 0, 2*Math.PI);
  ctx.fillStyle = 'white';
  ctx.fill();
  grad = ctx.createRadialGradient(0,0,radius*0.95, 0,0,radius*1.05);
  grad.addColorStop(0, '#333');
  grad.addColorStop(0.5, 'white');
  grad.addColorStop(1, '#333');
  ctx.strokeStyle = grad;
  ctx.lineWidth = radius*0.1;
  ctx.stroke();
  ctx.beginPath();
  ctx.arc(0, 0, radius*0.1, 0, 2*Math.PI);
  ctx.fillStyle = '#333';
  ctx.fill();
}

function drawNumbers(ctx, radius) {
  var ang;
  var num;
  ctx.font = radius*0.15 + "px arial";
  ctx.textBaseline="middle";
  ctx.textAlign="center";
  for(num = 1; num < 13; num++){
    ang = num * Math.PI / 6;
    ctx.rotate(ang);
    ctx.translate(0, -radius*0.85);
    ctx.rotate(-ang);
    ctx.fillText(num.toString(), 0, 0);
    ctx.rotate(ang);
    ctx.translate(0, radius*0.85);
    ctx.rotate(-ang);
  }
}

function drawTime(ctx, radius){
    var now = new Date();
    var hour = now.getHours();
    var minute = now.getMinutes();
    var second = now.getSeconds();
    //hour
    hour=hour%12;
    hour=(hour*Math.PI/6)+
    (minute*Math.PI/(6*60))+
    (second*Math.PI/(360*60));
    drawHand(ctx, hour, radius*0.5, radius*0.07);
    //minute
    minute=(minute*Math.PI/30)+(second*Math.PI/(30*60));
    drawHand(ctx, minute, radius*0.8, radius*0.07);
    // second
    second=(second*Math.PI/30);
    drawHand(ctx, second, radius*0.9, radius*0.02);
}

function drawHand(ctx, pos, length, width) {
    ctx.beginPath();
    ctx.lineWidth = width;
    ctx.lineCap = "round";
    ctx.moveTo(0,0);
    ctx.rotate(pos);
    ctx.lineTo(0, -length);
    ctx.stroke();
    ctx.rotate(-pos);
}
</script>



        </div>
        <div class="webdesk_modal-footer">
          <button type="button" class="webdesk_btn webdesk_btn-primary" data-dismiss="webdesk_modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<!-- End wd_clock -->

<!-- wd_cal -->
  <div class="webdesk_modal" id="wd_cal" role="dialog">
    <div class="webdesk_modal-dialog webdesk_modal-lg">
      <div class="webdesk_modal-content">
        <div class="webdesk_modal-header">
          
          <h4 class="webdesk_modal-title">Date: <?php echo date("F j, Y"); ?></h4>
          <button type="button" class="webdesk_close" data-dismiss="webdesk_modal">&times;</button>
        </div>
        <div class="webdesk_modal-body">
			<script>

	$(document).ready(function() {

		$('#calendar').fullCalendar({
			defaultDate: '<?php echo date("Y-m-d"); ?>',
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: [
				<?php
if(isset($_GET['title'])){
  if($app = "Calendar"){
    $title = test_input($_GET['title']);
    echo file_get_contents($wd_file . $title);
  }
}
?>
			]
		});

	});

</script>

<div id='calendar'></div>

        </div>
        <div class="webdesk_modal-footer">
          <button type="button" class="webdesk_btn webdesk_btn-primary" data-dismiss="webdesk_modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<!-- End wd_cal -->
<!-- wd_app_help-->
  <div class="webdesk_modal" id="wd_app_help" role="dialog">
    <div class="webdesk_modal-dialog webdesk_shadow-lg">


      <div class="webdesk_modal-content">
        <div class="webdesk_modal-header">
          
          <h4 class="webdesk_modal-title"><?php if(isset($wd_app)){ echo $wd_app; }; ?> Help</h4>
          <button type="button" class="webdesk_close" data-dismiss="webdesk_modal">&times;</button>
        </div>
        <div class="webdesk_modal-body">
          <?php
if(isset($sec) && isset($wd_app)){
              if(file_exists($wd_type . '/' . $wd_app . '/help_' . $sec)){
                  $wd_help = file_get_contents($wd_type . '/' . $wd_app . '/help_' . $sec);
                  echo $wd_help;
              }
              elseif(file_exists($wd_type . '/' . $wd_app . '/help.php')){
                  $wd_help = file_get_contents($wd_type . '/' . $wd_app . '/help.php');
                  echo $wd_help;
              }
              else{
                  echo 'We are sorry but there is no help documentation available for this app.';
              }
}
else{
    $wd_help = file_get_contents('help.php');
    echo $wd_help;
}
          ?>
        </div>
        <div class="webdesk_modal-footer">
          <button type="button" class="webdesk_btn webdesk_btn-primary" data-dismiss="webdesk_modal">Close</button>
        </div>
      </div>

    </div>
  </div>
<!-- End wd_app_help -->
<!-- wd_info -->
<div id="wd_info" class="webdesk_modal" role="dialog">
  <div class="webdesk_modal-dialog webdesk_shadow-lg">

    <!-- Modal content-->
    <div class="webdesk_modal-content">
      <div class="webdesk_modal-header">
        
        <h4 class="webdesk_modal-title">WebDesk Information</h4>
        <button type="button" class="webdesk_close" data-dismiss="webdesk_modal">&times;</button>
      </div>
      <div class="webdesk_modal-body">
		  <p><b>Version: </b>2.0</p>
        <a href="">License</a><br>
        <a href="">Terms of Use</a><br>
        <a href="">Pricay Policy</a>
      </div>
      <div class="webdesk_modal-footer">
        <button type="button" class="webdesk_btn webdesk_btn-primary" data-dismiss="webdesk_modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- End wd_info -->
<!-- lock -->
<style>
  #clouds{
	padding: 100px 0;
	background: #c9dbe9;
	background: -webkit-linear-gradient(top, #c9dbe9 0%, #fff 100%);
	background: -linear-gradient(top, #c9dbe9 0%, #fff 100%);
	background: -moz-linear-gradient(top, #c9dbe9 0%, #fff 100%);
    position: absolute;
    left: 0px;
    top: 0px;
    z-index: 999;
    width: 100%;
    height: 100%;
    text-align: center;
    display: none;
}

/*Time to finalise the cloud shape*/
.cloud {
	width: 200px; height: 60px;
	background: #fff;

	border-radius: 200px;
	-moz-border-radius: 200px;
	-webkit-border-radius: 200px;

	position: relative;
}

.cloud:before, .cloud:after {
	content: '';
	position: absolute;
	background: #fff;
	width: 100px; height: 80px;
	position: absolute; top: -15px; left: 10px;

	border-radius: 100px;
	-moz-border-radius: 100px;
	-webkit-border-radius: 100px;

	-webkit-transform: rotate(30deg);
	transform: rotate(30deg);
	-moz-transform: rotate(30deg);
}

.cloud:after {
	width: 120px; height: 120px;
	top: -55px; left: auto; right: 15px;
}

/*Time to animate*/
.x1 {
	-webkit-animation: moveclouds 15s linear infinite;
	-moz-animation: moveclouds 15s linear infinite;
	-o-animation: moveclouds 15s linear infinite;
}

/*variable speed, opacity, and position of clouds for realistic effect*/
.x2 {
	left: 200px;

	-webkit-transform: scale(0.6);
	-moz-transform: scale(0.6);
	transform: scale(0.6);
	opacity: 0.6; /*opacity proportional to the size*/

	/*Speed will also be proportional to the size and opacity*/
	/*More the speed. Less the time in 's' = seconds*/
	-webkit-animation: moveclouds 25s linear infinite;
	-moz-animation: moveclouds 25s linear infinite;
	-o-animation: moveclouds 25s linear infinite;
}

.x3 {
	left: -250px; top: -200px;

	-webkit-transform: scale(0.8);
	-moz-transform: scale(0.8);
	transform: scale(0.8);
	opacity: 0.8; /*opacity proportional to the size*/

	-webkit-animation: moveclouds 20s linear infinite;
	-moz-animation: moveclouds 20s linear infinite;
	-o-animation: moveclouds 20s linear infinite;
}

.x4 {
	left: 470px; top: -250px;

	-webkit-transform: scale(0.75);
	-moz-transform: scale(0.75);
	transform: scale(0.75);
	opacity: 0.75; /*opacity proportional to the size*/

	-webkit-animation: moveclouds 18s linear infinite;
	-moz-animation: moveclouds 18s linear infinite;
	-o-animation: moveclouds 18s linear infinite;
}

.x5 {
	left: -150px; top: -150px;

	-webkit-transform: scale(0.8);
	-moz-transform: scale(0.8);
	transform: scale(0.8);
	opacity: 0.8; /*opacity proportional to the size*/

	-webkit-animation: moveclouds 20s linear infinite;
	-moz-animation: moveclouds 20s linear infinite;
	-o-animation: moveclouds 20s linear infinite;
}

@-webkit-keyframes moveclouds {
	0% {margin-left: 1000px;}
	100% {margin-left: -1000px;}
}
@-moz-keyframes moveclouds {
	0% {margin-left: 1000px;}
	100% {margin-left: -1000px;}
}
@-o-keyframes moveclouds {
	0% {margin-left: 1000px;}
	100% {margin-left: -1000px;}
}
</style>
<div id="clouds">
	<div class="cloud x1"></div>
	<div class="cloud x2"></div>
	<div class="cloud x3"></div>
	<div class="cloud x4"></div>
	<div class="cloud x5"></div>
  <!--<div class="form-group" class="center">
<label for="wd_lockC">--><h1><?php echo $_SERVER['HTTP_HOST']; ?></h1><!--</label>
  <input type="text" id="wd_lockC" placeholder="password"><button class="btn btn-success" id="wd_lockP">Lock</button>
  </div>-->
</div>
<script>
  $("#clouds").click(function(){
    $("#clouds").hide();
  });
</script>
  <!-- End Lock -->
<?php
//// CREATE APPLET MODALS
if ($handle = opendir('Applets/')) {
  while (false !== ($entry = readdir($handle))) {
    if ($entry != "." && $entry != "..") {
      $aplname = explode(".", $entry);
      $aplxml=json_decode(file_get_contents("Applets/" . $entry));
      ?>
      <div class="webdesk_modal" id="<?php echo $aplname[0]; ?>" role="dialog">
        <div class="webdesk_modal-dialog webdesk_modal-lg">
          <div class="webdesk_modal-content">
            <div class="webdesk_modal-header">
          
              <h4 class="webdesk_modal-title"><?php echo $aplname[0]; ?></h4>
              <button type="button" class="webdesk_close" data-dismiss="webdesk_modal">&times;</button>
            </div>
            <div class="webdesk_modal-body">
              <?php echo htmlspecialchars_decode($aplxml->code, ENT_QUOTES); ?>
            </div>
            <div class="webdesk_modal-footer">
              <button type="button" class="webdesk_btn webdesk_btn-primary" data-dismiss="webdesk_modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <?php
    }
  }
}
if ($handle = opendir('MyApplets/')) {
  while (false !== ($entry = readdir($handle))) {
    if ($entry != "." && $entry != "..") {
      $aplname = explode(".", $entry);
      $aplxml=json_decode(file_get_contents("MyApplets/" . $entry));
      ?>
      <div class="webdesk_modal" id="M<?php echo $aplname[0]; ?>" role="dialog">
        <div class="webdesk_modal-dialog webdesk_modal-lg">
          <div class="webdesk_modal-content">
            <div class="webdesk_modal-header">
          
              <h4 class="webdesk_modal-title"><?php echo $aplname[0]; ?></h4>
              <button type="button" class="webdesk_close" data-dismiss="webdesk_modal">&times;</button>
            </div>
            <div class="webdesk_modal-body">
              <?php echo htmlspecialchars_decode($aplxml->code, ENT_QUOTES); ?>
            </div>
            <div class="webdesk_modal-footer">
              <button type="button" class="webdesk_btn webdesk_btnbtn-primary" data-dismiss="webdesk_modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <?php
    }
  }
}
?>
<script>
  $(function() {
    $( "#tabers" ).tabs({
      beforeLoad: function( event, ui ) {
        ui.jqXHR.fail(function() {
          ui.panel.html(
            "Couldn't load this tab. We'll try to fix this as soon as possible.");
        });
      }
    });
  });
  </script>
<script>
    function display_c() {
            var refresh=1000;
            mytime=setTimeout('display_ct()', refresh)
        }


    function display_ct() {
            var strcount;
            var xf5 = new Date();
            var date = xf5;
            var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'pm' : 'am';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'
  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = hours + ':' + minutes + ' ' + ampm;

            document.getElementById('ct').innerHTML = strTime;
            document.getElementById('dt').innerHTML = xf5.toDateString();
            tt=display_c();
        }
</script>
<script>
var a=document.getElementsByTagName("a");
for(var i=0;i<a.length;i++) {
    if(!a[i].onclick && a[i].getAttribute("target") != "_blank") {
        a[i].onclick=function() {
                window.location=this.getAttribute("href");
                return false;
        }
    }
}
    </script>
<script>
$(document).ready(function(){
    $('[data-toggle="webdesk_tooltip"]').tooltip();
    $(".wd_confirm").click(function(){
        if (!confirm("Please Confirm:")){ return false; }
    });
});
</script>
<script>
$(document).ready(function(){
    $('[data-toggle="webdesk_popitover"]').popover();
});
</script>
  <?php
  if(isset($_GET['sec'])){
  if(file_exists($wd_type . '/' . $wd_app . '/ext.txt')){
  $wd = 1;
  if(file_exists($wd_extFile . "ext.json")){
    $obj = file_get_contents($wd_extFile . "ext.json");
    $obj = json_decode($obj);
    $wd_prog = $wd_type . '/' . $wd_app;
    foreach($obj as $key => $value){
      if($wd_prog == $value){
        $wd = 0;
      }
    }
  }
  else{
    $wd = 1;
  }
  if($wd === 1){
  ?>
  <script type="text/javascript">
  $(document).ready(function() {
    $('#wd_ext').modal({
      show: true,
    })
  });
</script>
  <div id="wd_ext" class="webdesk_modal" role="dialog">
  <div class="webdesk_modal-dialog">

    <!-- Modal content-->
    <div class="webdesk_modal-content">
      <div class="webdesk_modal-header">
        
        <h4 class="webdesk_modal-title">Set as Default</h4>
        <button type="button" class="webdesk_close" data-dismiss="webdesk_modal">&times;</button>
      </div>
      <div class="webdesk_modal-body">
        <form method="post" action="dext.php?type=<?php echo $wd_type; ?>&app=<?php echo $wd_app; ?>">
        <p>Would you like to set this app as the primary app to use the following ext:</p>
        <b><i><?php
    $wd = file_get_contents($wd_type . '/' . $wd_app . '/ext.txt');
    $wd = explode(',', $wd);
    foreach($wd as $entry){
      echo $entry;
      ?>
          <select name="<?php echo $entry; ?>">
            <option value="<?php echo $wd_type . '/' . $wd_app; ?>">Yes</option>
            <option value="no">No</option>
          </select>
          <?php
    } ?></i></b>
        <p>You can change you ext default app setting on your settings tab.</p>
        <input type="submit" value="Save" class="webdesk_btn webdesk_btn-success">
        <button type="button" class="webdesk_btn webdesk_btn-secondary" data-dismiss="modal">Cancel</button>
        </form>
      </div>
      <div class="webdesk_modal-footer">
        <button type="button" class="webdesk_btn webdesk_btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
  <?php
  }
  }
  }
    ?>

  <div id="wd_chatting" class="chat webdesk_card"><div class="webdesk_card-body"><div class="webdesk_container"><h3><button id="wd_hChat" class="webdesk_btn webdesk_btn-info"><span class="fa fa-caret-down fa-fw"></span></button> <button id="wd_fChat" class="webdesk_btn webdesk_btn-info"><span class="fa fa-expand"></span></button> <button id="wd_mChat" class="webdesk_btn webdesk_btn-info"><span class="fa fa-expand"></span></button> Chat</h3><div class="webdesk_col-xs-4"><input type="text" id="wd_tChat" class="webdesk_form-control" placeholder="Type you message here..."></div><button id="wd_bChat" class="webdesk_btn webdesk_btn-success">Send</button><br><div class="scroll"><div id="wd_chat"></div><div id="wd_sto_chat"></div></div></div></div></div>

<script>
  var oldD = "";
if(typeof(EventSource) !== "undefined") {
    var source = new EventSource("chat.php");
    source.onmessage = function(event) {
      if(oldD != event.data){
        if(typeof(Storage) !== "undefined") {
        var wd_sto_c = document.getElementById("wd_chat").innerHTML;
        wd_sto_c = wd_sto_c + sessionStorage.wd_chat;
        }
        document.getElementById("wd_chat").innerHTML = event.data + "<br>" + document.getElementById("wd_chat").innerHTML;
        oldD = event.data;
        if(typeof(Storage) !== "undefined") {
        sessionStorage.setItem("wd_chat", wd_sto_c);
        }
      }
    };
} else {
    document.getElementById("wd_chat").innerHTML = "Sorry, your browser does not support server-sent events...";
}
</script>
<script>
$(document).ready(function(){
  $(".chat").hide();
    $("#chat").click(function(){
        $(".chat").toggle();
    });
    $( "#wd_chatting" ).draggable();
    $( "#wd_chatting" ).resizable();
  $("#wd_hChat").click(function(){
    $(".chat").hide();
  });
    $("#wd_bChat").click(function(){
      var wd_ctext = $('#wd_tChat').val();
        $.post("chatSub.php",
        {
          chat: wd_ctext
        });
      $('#wd_tChat').val('');
    });
  $('#wd_tChat').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
       var wd_ctext = $('#wd_tChat').val();
        $.post("chatSub.php",
        {
          chat: wd_ctext
        });
      $('#wd_tChat').val('');
    }
});
  if(typeof(Storage) !== "undefined") {
    if(sessionStorage.wd_chat != "undefined") {
  document.getElementById("wd_sto_chat").innerHTML = sessionStorage.wd_chat;
    }
  }
  $("#wd_t1Title").animate({fontSize: '3em', opacity: '0.4'}, "slow").animate({fontSize: '1em', opacity: '1'}, "slow").css("color", "white");
  $("#wd_mChat").hide();
$("#wd_fChat").click(function(){
  $("#wd_chatting").animate({bottom: '0px', width: '100%', height: '100%'}, "slow")
  $("#wd_fChat").hide();
  $("#wd_mChat").show();
});
$("#wd_mChat").click(function(){
  $("#wd_chatting").animate({bottom: '50px', width: '50%', height: '50%'}, "slow")
  $("#wd_mChat").hide();
  $("#wd_fChat").show();
});
});
</script>
<script>
    $( function() {
    var tabs = $( "#tabs" ).tabs();
    tabs.find( ".ui-tabs-nav" ).sortable({
      axis: "x",
      stop: function() {
        tabs.tabs( "refresh" );
      }
    });
  } );
  </script>
<script>
$(function() {
  $("[data-target='webdesk_modal'],.webdesk_modal").modal({
    backdrop: false,
    show: false
  });
  $( "#tabs" ).tabs({
    collapsible: true
    //active: false
  });
  $( ".webdesk_tab" ).resizable();

  <?php if(!isset($_SESSION["wd_fullscreen"]) || $_SESSION["wd_fullscreen"] != 'on'){  
    ?>
    $( ".webdesk_tab" ).draggable();
    <?php 
    
  } 
  ?>
  //$('.webdesk_dropdown-toggle').dropdown();
  
  $("form").not(".noloadingicon,.no-loader").submit(function(){
    
    $(":input[type='submit']",this).html('<i class="fas fa-spinner fa-pulse"></i> Loading').prop("disabled",true);
    
  });
});
</script>
<!--<script src="Plugins/context.js"></script>-->
<?php
if(isset($_GET["app"])){
  if(file_exists($type . "/" . $app . "/script.js")){
    ?>
    <script src="<?php echo $type . "/" . $app . "/script.js"; ?>"></script>
    <?php
	}
  if(isset($sec) && file_exists($type . "/" . $app . "/script_" . $sec)){
    ?>
    <script src="<?php echo $type . "/" . $app . "/script_" . $sec; ?>"></script>
    <?php
	}
}
?>
<script>if (window.module) module = window.module;</script>
