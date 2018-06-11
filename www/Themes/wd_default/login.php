<!DOCTYPE html>

<!-- Copyright 2014 WebDesk.me -->
<html lang="en">
<head>
    <title><?php echo $wd_Title; ?></title>
    <meta http-equiv="content-language" content="ll-cc">
    <meta name="language" content="English">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="keywords" content="WebDesk, Web app, webtop, web desktop">
    <meta name="author" content="WebDesk">
    <meta name="description" content="Welcome to WebDesk.">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" width="device-width">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <meta name="copyright" content="&copy; 2014 WebDesk.me">
    <!--<link rel="icon" type="image/png" href="image/CA.ico">
    <link rel="apple-touch-icon" href="/custom_icon.png">
    <link rel="apple-touch-startup-image" href="/custom_icon.png">-->
    <link rel="apple-touch-icon" href="favicon.ico">
    <link rel="apple-touch-startup-image" href="favicon.ico">

	<link rel="stylesheet" href="Plugins/bootstrap-3.3.7-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="www/Themes/wd_default/login.css" />

	<!--<script src="Plugins/jquery-3.2.0.min.js" type="text/javascript"></script>-->
	<script src="www/Themes/wd_default/jquery-1.3.2.min.js" type="text/javascript"></script>
	<script src="www/Themes/wd_default/jquery.backgroundPosition.js" type="text/javascript"></script>
	<script src="Plugins/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		/*$(function(){

		  $('#midground').css({backgroundPosition: '0px 0px'});
		  $('#foreground').css({backgroundPosition: '0px 0px'});
		  $('#background').css({backgroundPosition: '0px 0px'});

			$('#midground').animate({
				backgroundPosition:"(-10000px -2000px)"
			}, 240000, 'linear');

			$('#foreground').animate({
				backgroundPosition:"(-10000px -2000px)"
			}, 120000, 'linear');

			$('#background').animate({
				backgroundPosition:"(-10000px -2000px)"
			}, 480000, 'linear');

		});*/
$(document).ready(function() {
    function midloop() {
        $('#midground').css({backgroundPosition: '0px 0px'});
        $('#midground').animate ({
            backgroundPosition:"(-10000px -2000px)"
        }, 240000, 'linear', function() {
            midloop();
        });
    }
    midloop();

function forloop() {
        $('#foreground').css({backgroundPosition: '0px 0px'});
        $('#foreground').animate ({
            backgroundPosition:"(-10000px -2000px)"
        }, 120000, 'linear', function() {
            forloop();
        });
    }
    forloop();

function bacloop() {
        $('#background').css({backgroundPosition: '0px 0px'});
        $('#background').animate ({
            backgroundPosition:"(-10000px -2000px)"
        }, 480000, 'linear', function() {
            bacloop();
        });
    }
    bacloop();
});
	</script>

</head>

<body onload="display_ct();" oncontextmenu="return false" ondragstart="return false" onselectstart="return false">

    <div id="background"></div>
	<div id="midground"></div>
	<div id="foreground"></div>

 <nav class="navbar navbar-inverse" id="nav">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php" title="Homepage"><?php echo $wd_Title; ?></a>
    </div>
  </div>
</nav>

	<div id="page-wrap">

		<div align="center">
          <form method="POST" action="login.php">
		   <div class="form-group">
            <label for="user" title="Please add your Username here."><h3>Username: </h3></label>
            <input type="text" id="user"  class="form-control" name="user" required placeholder="Please add your Username here." title="Please add your Username here.">
           </div>
           <div class="form-group">
            <label for="pass" title="Please add your Password here."><h3>Password: </h3></label>
            <input type="password" id="pass"  class="form-control" name="pass" required placeholder="Please add your Password here." title="Please add your Password here." autofocus><br><br>
           </div>
           <div class="form-group">
			<p>By clicking on either the Desktop or Mobile button, you are agreeing to Webdesk.me's <a href="/www/Pages/Terms.html" target="_blank">Terms of Use</a> and <a href="/www/Pages/Privacy.html" target="_blank">Privacy Policy</a>.</p>
            <input type="submit" name="type" value="Desktop" class="btn btn-primary" title="Sign In"> <b>or</b> <input type="submit" name="type" value="Mobile" class="btn btn-primary" title="Sign In">
           </div>
          </form>
        </div>
	  <div style="text-align: center;"><h1 id="dt"></h1></div>
      <div style="text-align: center;"><h1 id="ct"></h1></div>
	</div>
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
<script type="text/javascript">

        function display_c() {
            var refresh=1000;
            mytime=setTimeout('display_ct()', refresh)
        }
        function display_ct() {
            var strcount;
            var xf5 = new Date();
            document.getElementById('ct').innerHTML = xf5.toTimeString();
            document.getElementById('dt').innerHTML = xf5.toDateString();
            tt=display_c();
        }

</script>
</body>

</html>
