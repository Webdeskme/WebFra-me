<?php
  //include "testInput.php";
  include "www/functions.php";
?>
<!DOCTYPE html>
<!--<Webdesk.me Making web aplications easy.>
    Copyright (C) 2017  Adam W. Telford

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.


    While using this site, you agree to have read and accepted our terms
    of use, cookie and privacy policy. Copyright 2017 Adam W. Telford.
    All Rights Reserved.

    A link to the terms of use, cookie and privacy policy, and licences
    can be found at the bottom right corner of the menu bar by clicking
    the exlmation point once loged in, and in the menu of the login page.-->
<html>
<head>
    <meta charset="utf-8">
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="copyright" content="&copy; 2014 WebDesk.me">
    <!--<link rel="icon" type="image/png" href="image/CA.ico">
    <link rel="apple-touch-icon" href="/custom_icon.png">
    <link rel="apple-touch-startup-image" href="/custom_icon.png">-->
    <link rel="apple-touch-icon" href="favicon.ico">
    <link rel="apple-touch-startup-image" href="favicon.ico">
<link href="Plugins/literallycanvas-0.4.14/css/literallycanvas.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="Plugins/context.standalone.css">
<link href="Plugins/fullcalendar-3.3.0/fullcalendar.min.css" rel="stylesheet"/>
<link href="Plugins/fullcalendar-3.3.0/fullcalendar.print.min.css" rel="stylesheet" media="print" />
<link rel="stylesheet" href="Plugins/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="www/Themes/wd_default/style.css">
<?php
if(file_exists("www/Pages/style.css")){
	echo '<link rel="stylesheet" type="text/css" href="www/Pages/style.css">';
}
if(file_exists("www/Pages/header.php")){
	include "www/Pages/header.php";
}
if(isset($_GET['page']) && file_exists("www/Pages/header_" . $page)){
	include "www/Pages/header_" . $page;
}
?>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script src="Plugins/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="Plugins/React/react.min.js"></script>
<script src="Plugins/React/react-dom.min.js"></script>
<script src="Plugins/literallycanvas-0.4.14/js/literallycanvas.js"></script>
<script src="Plugins/fullcalendar-3.3.0/lib/moment.min.js"></script>
<script src="Plugins/fullcalendar-3.3.0/fullcalendar.min.js"></script>
</head>
<body>
  <?php
  if(file_exists("www/Pages/banner_" . $page) && $page != ""){
	include "www/Pages/banner_" . $page;
  }
  elseif(file_exists("www/Pages/banner.php")){
	include "www/Pages/banner.php";
  }
  ?>
  <div class="container">
<?php
if(isset($_GET['page']) && file_exists("www/Pages/" . $page)){
	include "www/Pages/" . $page;
}
    ?>
  </div>
    <?php
if(file_exists("www/Pages/footer_" . $page) && $page != ""){
	echo file_get_contents("www/Pages/footer_" . $page);
}
elseif(file_exists("www/Pages/footer.php")){
	include "www/Pages/footer.php";
}
?>
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
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
  <script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
});
</script>
<script src="Plugins/context.js"></script>
</body>
</html>
