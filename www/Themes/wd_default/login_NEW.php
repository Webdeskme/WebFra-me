<!DOCTYPE html>

<!-- Copyright <?php echo date("Y"); ?> Webfra.me -->

<html lang="en">
<head>
    
    <title>Login | <?php echo $wd_Title; ?></title>
    
    <meta http-equiv="content-language" content="ll-cc">
    <meta name="language" content="English">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="keywords" content="Webframe, Web app, webtop, web desktop">
    <meta name="author" content="Adam Telford">
    <meta name="author" content="Andrew McCallister">
    <meta name="description" content="<?php echo $wd_Title; ?> is a private installation. Access to this system is strictly regulated.">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" width="device-width">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <meta name="copyright" content="&copy; <?php echo date("Y"); ?> <?php echo $wd_Title; ?>">

    <link rel="apple-touch-icon" href="favicon.ico">
    <link rel="apple-touch-startup-image" href="favicon.ico">

	<!--<link rel="stylesheet" href="Plugins/bootstrap-3.3.7-dist/css/bootstrap.min.css">-->
	<link rel="stylesheet" href="Plugins/wd-bootstrap/css/webdesk_bootstrap.min.css">
	<link rel="stylesheet" href="Plugins/fontawesome-free-5.2/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="www/Themes/wd_default/login.css" />

</head>

<body>

  

  <!--<nav class="webdesk_navbar webdesk_bg-black webdesk_navbar-dark" id="nav">-->
  <!--  <div class="webdesk_container-fluid">-->
  <!--    <a class="webdesk_navbar-brand" href="index.php" title="Homepage"><?php echo $wd_Title; ?></a>-->
  <!--  </div>-->
  <!--</nav>-->
  
  <div class="webdesk_container webdesk_my-5">
    <div class="webdesk_row">
      <div class="webdesk_col-md-6 webdesk_offset-md-3">
        <div class="webdesk_my-5 py-5 webdesk_text-center">
          <a class="webdesk_navbar-brand webdesk_text-white" href="index.php" title="Homepage"><?php echo $wd_Title; ?></a>
        </div>
        <form method="POST" action="login.php" class="webdesk_py-5">
          <div class="webdesk_form-group webdesk_row webdesk_pt-5">
            <label for="username" class="webdesk_col-sm-3 webdesk_col-form-label">Username</label>
            <div class="webdesk_col-sm-9">
              <input type="text" name="user" id="username" class="webdesk_form-control webdesk_bg-secondary webdesk_border-0 webdesk_inset-shadow" />
            </div>
          </div>
          <div class="webdesk_form-group webdesk_row">
            <label for="password" class="webdesk_col-sm-3 webdesk_col-form-label">Password</label>
            <div class="webdesk_col-sm-9">
              <input type="password" name="pass" id="password" class="webdesk_form-control webdesk_bg-secondary webdesk_border-0 webdesk_inset-shadow" />
            </div>
          </div>
          <div class="webdesk_text-center webdesk_py-5">
            <button type="submit" value="Desktop" name="type" class="webdesk_btn webdesk_btn-link webdesk_text-white"><i class="fa fa-fw fa-desktop"></i> Login Desktop</button> &nbsp; 
            <button type="submit" value="Desktop" name="type" class="webdesk_btn webdesk_btn-link webdesk_text-white"><i class="fa fa-fw fa-mobile-alt"></i> Login Mobile</button> 
          </div>
          <div class="webdesk_form-group webdesk_text-center">
            <span class="webdesk_form-text webdesk_text-muted">By clicking on either the Desktop or Mobile button, you are agreeing to Webfra.me&apos;s <a href="//<?php echo $_SERVER["HTTP_HOST"] ?>/index.php?page=Terms.php" target="_blank">Terms of Use</a> and <a href="/www/Pages/Privacy.html" target="_blank">Privacy Policy</a>.</span>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  <!--	<div id="page-wrap">-->
  <!--        <div class="webdesk_container">-->
  <!--    		<div align="center">-->
  <!--              <form method="POST" action="login.php">-->
  <!--    		   <div class="webdesk_form-group">-->
  <!--                <label for="user" title="Please add your Username here."><h3>Username: </h3></label>-->
  <!--                <input type="text" id="user"  class="webdesk_form-control" name="user" required placeholder="Please add your Username here." title="Please add your Username here.">-->
  <!--               </div>-->
  <!--               <div class="webdesk_form-group">-->
  <!--                <label for="pass" title="Please add your Password here."><h3>Password: </h3></label>-->
  <!--                <input type="password" id="pass"  class="webdesk_form-control" name="pass" required placeholder="Please add your Password here." autofocus><br><br>-->
  <!--               </div>-->
  <!--               <div class="webdesk_form-group">-->
  <!--    			-->
  <!--                <input type="submit" name="type" value="Desktop" class="webdesk_btn webdesk_btn-primary" title="Sign In"> <b>or</b> <input type="submit" name="type" value="Mobile" class="webdesk_btn webdesk_btn-primary" title="Sign In">-->
  <!--               </div>-->
  
  <!--            </div>-->
  <!--    	  <div style="text-align: center;"><h1 id="dt"></h1></div>-->
  <!--          <div style="text-align: center;"><h1 id="ct"></h1></div>-->
  <!--        </div>-->
  <!--	</div>-->
  <!--<script>-->
  <!--var a=document.getElementsByTagName("a");-->
  <!--for(var i=0;i<a.length;i++) {-->
  <!--    if(!a[i].onclick && a[i].getAttribute("target") != "_blank") {-->
  <!--        a[i].onclick=function() {-->
  <!--                window.location=this.getAttribute("href");-->
  <!--                return false;-->
  <!--        }-->
  <!--    }-->
  <!--}-->
  <!--</script>-->
  <!--<script type="text/javascript">-->
  
  <!--        function display_c() {-->
  <!--            var refresh=1000;-->
  <!--            mytime=setTimeout('display_ct()', refresh)-->
  <!--        }-->
  <!--        function display_ct() {-->
  <!--            var strcount;-->
  <!--            var xf5 = new Date();-->
  <!--            document.getElementById('ct').innerHTML = xf5.toTimeString();-->
  <!--            document.getElementById('dt').innerHTML = xf5.toDateString();-->
  <!--            tt=display_c();-->
  <!--        }-->
  
  <!--</script>-->

    <!--<script src="Plugins/jquery-3.2.0.min.js" type="text/javascript"></script>-->
    <script src="www/Themes/wd_default/jquery-1.3.2.min.js" type="text/javascript"></script>
    <script src="www/Themes/wd_default/jquery.backgroundPosition.js" type="text/javascript"></script>
    <!--<script src="Plugins/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>-->
    <script src="Plugins/wd-bootstrap/js/webdesk_bootstrap.js"></script>
    
    <script type="text/javascript">
    // for(x=0;x<1000;x++){
      
    //   var randx = Math.random()*screen.width;
    //   var randy = Math.random()*screen.height;
      
    //   var randx2 = Math.random()*screen.width;
    //   var randy2 = Math.random()*screen.height;
      
    //   var m = (randy2-randy) / (randx2-randx);
      
      
    //   var size = Math.round(Math.random()*3);
    //   console.log(size);
      
    //   $("<div class='star star-" + size + "'></div>").css("left",randx).css("top",randy).appendTo("body").animate({
    //     top: randy2,
    //     left: randx2
    //   },20000);
    // }
    </script>

</body>
</html>