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
<html lang="en-US">
<head>
  <meta charset="utf-8">
  <link rel="manifest" href="manifest.php">
     <meta http-equiv="content-language" content="ll-cc">
      <meta name="language" content="English">
      <meta name="mobile-web-app-capable" content="yes">
      <meta name="apple-mobile-web-app-capable" content="yes">
      <meta name="author" content="<?php echo $wd_Title; ?>">
      <meta name="description" content="Welcome to <?php echo $wd_Title; ?>.">
      <meta http-equiv="content-type" content="text/html; charset=UTF-8">
      <meta charset="UTF-8">
      <meta name="theme-color" content="#000000"/>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="copyright" content="&copy; <?php echo date("Y") . ' ' . $wd_Title; ?>">
      <link rel="apple-touch-icon" href="favicon.ico">
      <link rel="apple-touch-startup-image" href="favicon.ico">
      <!--<link rel="stylesheet" href="Plugins/bootstrap-3.3.7-dist/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="Theme/default.php">
<link rel="stylesheet" type="text/css" href="www/Themes/wd_default/style.css">-->
<link rel="stylesheet" type="text/css" href="www/Themes/wd_default/pluginCSS.php">
<?php
if(file_exists($wd_www . "header.php")){
	include $wd_www . "header.php";
}
if(isset($_GET['page']) && file_exists($wd_www . "header_" . $page)){
	include $wd_www . "header_" . $page;
}
?>
</head>
<body>
  <?php
  if(file_exists($wd_www . "banner_" . $page) && $page != ""){
	include $wd_www . "banner_" . $page;
  }
  elseif(file_exists($wd_www . "banner.php")){
	include $wd_www . "banner.php";
  }
  ?>
  <div class="container">
    <!--<script src="Plugins/jquery.min.js"></script>
    <script src="Plugins/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <script defer src="Plugins/fontawesome-free/svg-with-js/js/fontawesome-all.min.js"></script>-->
    <script type="text/javascript" src="www/Themes/wd_default/plugins.php?page=<?php echo $page;?>" defer></script>
<?php
if(isset($_GET['page']) && file_exists($wd_www . $page)){
	include $wd_www . $page;
}
    ?>
  </div>
    <?php
if(file_exists($wd_www . "footer_" . $page) && $page != ""){
	echo file_get_contents($wd_www . "footer_" . $page);
}
elseif(file_exists($wd_www . "footer.php")){
	include $wd_www . "footer.php";
}
?>
<script defer>
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
<!--<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
  <script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
});
</script>-->
	<!--<script type="text/javascript" src="fstat-js.php?page=<?php echo $page;?>" defer></script>-->
  <?php
if(isset($_GET['wd_dev'])){
  ?>
<script src="Plugins/tota11y-master/build/tota11y.min.js" defer></script>
  <?php
}
   ?>
<!--<script>
if('serviceWorker' in navigator) {
  navigator.serviceWorker
           .register('/www/Themes/wd_default/sw.js')
           .then(function() { console.log("Service Worker Registered"); });
}
</script>-->
</body>
</html>
