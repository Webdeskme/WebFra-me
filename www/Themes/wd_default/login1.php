<!doctype html>

<!-- Copyright 2015 WebDesk.me -->














































































<html lang="en">
<head>
    <title>WebDesk</title>
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

    <style>
        html{
            width: 100%;
            height: 100%;
            padding: 0px;
            margin: 0px;
            background: -webkit-radial-gradient(#0099FF, #FFFFFF, #0099FF); /* Safari 5.1 to 6.0 */
            background: -o-radial-gradient(#0099FF, #FFFFFF, #0099FF); /* For Opera 11.6 to 12.0 */
            background: -moz-radial-gradient(#0099FF, #FFFFFF, #0099FF); /* For Firefox 3.6 to 15 */
            background: radial-gradient(#0099FF, #FFFFFF, #0099FF); /* Standard syntax */
        }
        body{
            width: 100%;
            height: 100%;
            margin: 0px;
            padding: 0px;
            font-family: cursive;
            color: #000099;
            font-size: 1.5em;
        }
        .bar{
            margin: 0px;
            padding: 0px;
            background-color: #000099;
            /*height: 5%;*/
            width: 100%;
            /*font-size: 1.5em;*/
            color: white;
        }
        .space{
            margin: 0px;
            padding: 0px;
            height: 5%;
            width: 100%;
        }
        .cont{
            margin: 0px;
            padding: 0px;
            height: 70%;
            width: 100%;
        }
        .input{
            
        }
        .webdesk{
            display:none;
            /*height: 50%;*/
            background-color: #000099;
            color: white;
        }
        iframe{
	 width: 80%;
	}
    </style>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
     <script>
      $(document).ready(function(){
       $("#webdeskT").click(function(){
        $("#accountP").slideUp("slow");
        $("#helpP").slideUp("slow");
        $("#termsP").slideUp("slow");
        $("#privacyP").slideUp("slow");
        $("#webdeskP").slideToggle("slow");
       });
       $("#accountT").click(function(){
        $("#webdeskP").slideUp("slow");
        $("#helpP").slideUp("slow");
        $("#termsP").slideUp("slow");
        $("#privacyP").slideUp("slow");
        $("#accountP").slideToggle("slow");
       });
       $("#helpT").click(function(){
        $("#webdeskP").slideUp("slow");
        $("#accountP").slideUp("slow");
        $("#termsP").slideUp("slow");
        $("#privacyP").slideUp("slow");
        $("#helpP").slideToggle("slow");
       });
       $("#termsT").click(function(){
        $("#webdeskP").slideUp("slow");
        $("#accountP").slideUp("slow");
        $("#helpP").slideUp("slow");
        $("#privacyP").slideUp("slow");
        $("#termsP").slideToggle("slow");
       });
       $("#privacyT").click(function(){
        $("#webdeskP").slideUp("slow");
        $("#accountP").slideUp("slow");
        $("#helpP").slideUp("slow");
        $("#termsP").slideUp("slow");
        $("#privacyP").slideToggle("slow");
       });
       if(window.location.href.indexOf("ver") > -1) {
         var ver = prompt("Please enter your Verification Code.");
    if (ver != null) {
        document.getElementById("ver").value = ver;
        document.forms["verify"].submit();
        }
       }
      });
    </script>
</head>
<body onload="display_ct();" oncontextmenu="return false" ondragstart="return false" onselectstart="return false">
    <div class="bar" style="text-align: center;"><span><b><span id="webdeskT">WebDesk.me</span> --- <!--<span id="accountT">Create an Account</span> ----><span id="helpT">Help</span> --- <span id="termsT">Terms Of Use</span> --- <span id="privacyT">Privacy Policy</span></b></span></div>
    <div id="webdeskP" class="webdesk">
     <br><br>Welcome to WebDesk.me: <br><br>
     Our goal is to allow easy and inecpensive acsses to a vertual desktop of programs and storage to use fromany computer. Webdesk allows anyone to be a developer. Please give it a try and let us know what you think. <br><br>
     Thank you!<br><br>
    </div>
    <!--<div id="accountP" class="webdesk">
        <br><br><label for="email">Create an Account: </label><br><div id="emailling" style="color: red;"></div><br>
        <form method="post" action="caSubEmail.php">
          <label for="email">Email: </label><input type="email" name="email" id="email" required placeholder="example@something.com" title="example@something.com"> <input type="submit" onclick="emailling();" value="submit">
        </form>
    <br><br>
    </div>-->
    <div id="helpP" class="webdesk">
        <br><br>Help: <br><br>
        <details>
            <summary>Forgot Password</summary>
            <form>
            <br><br><label for="email">Email: </label><input type="email" name="email" id="email" placeholder="example@something.com" title="example@something.com"> <input type="submit" onclick="emailling();" value="submit">
            </form>
        </details>
        <br><br>Knoledge base
        <br><br>Forum
        <br><br><details>
        <summary>Contact Us</summary>
            <form>
                
            </form>
        </details><br><br>
    </div>
    <div id="termsP" class="webdesk">
        <br><br>Terms of Use: <br><br>
        <iframe src="termsofuse.html"></iframe>
        <br><br>
    </div>
    <div id="privacyP" class="webdesk">
        <br><br>Privacy Policy: <br><br>
        <iframe src="privacypolicy.html"></iframe>
        <br><br>
    </div>
    <div class="space"></div>
    <div class="cont">
    <div style="text-align: center;"><h1 id="dt"></h1></div>
    <div style="text-align: center;"><h1 id="ct"></h1></div>
    <div style="text-align: center;">
        <form method="POST" action="login.php">
            <label for="user"><h3>Username: </h3></label>
            <input type="text" id="user" class="input" name="user" required placeholder="Put your Username here." title="Put your Username here.">
            <label for="pass"><h3>Password: </h3></label>
            <input type="password" id="pass" class="input" name="pass" required placeholder="Put your Password here." title="Put your Password here." autofocus><br><br>
            <input type="submit" name="type" value="Desktop"> <input type="submit" name="type" value="Mobile">
        </form>
        <br>
    </div>
    </div>
    <form method="post" action="ca.php" name="verify">
       <input type="hidden" name="ver" id="ver" value="">
    </form>
    <script>
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
        function emailling() {
            document.getElementById("emailling").innerHTML = "emailling...";
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
</body>
</html>