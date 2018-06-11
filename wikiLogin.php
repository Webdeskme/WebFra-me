<?php if(is_file("wd_protect.php")){ include_once "wd_protect.php"; } ?>
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
  <title>Wiki-<?php echo $wd_page; ?></title>
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
  <link rel="stylesheet" href="Plugins/bootstrap-3.3.7-dist/css/bootstrap.min.css">
  <script src="Plugins/jquery.min.js"></script>
  <script src="Plugins/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
</head>
<body>
  <?php
  if(file_exists($wd_root . '/Wiki/wiki-banner.php')){
    echo file_get_contents($wd_root . '/Wiki/wiki-banner.php');
  }
  ?>
  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Home</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
      </ul>
      <form method="get" action="wiki.php" class="navbar-form navbar-left">
      <div class="form-group">
        <input type="text" name="page" class="form-control" placeholder="Search">
      </div>
      <button type="submit" class="btn btn-default">Seach</button>
    </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="wiki.php?page=<?php echo $wd_page; ?>&type=edit"><span class="glyphicon glyphicon-pencil">Edit</span></a></li>
      </ul>
    </div>
  </div>
</nav>
  <div class="container">
<h1>404: Page not found</h1>
    <hr>
<h2>Login to creat it.</h2>
<h3><a href="index.php?page=login.php"><button type="button" class="btn btn-default">Login</button></a></h3>
<h3>If you do not have a login or forgot it. Please contact an administrator of this website.</h3>
    <hr>
    <?php
  if(file_exists($wd_root . '/Wiki/wiki-footer.php')){
    echo file_get_contents($wd_root . '/Wiki/wiki-footer.php');
  }
  ?>
  </div>
</body>
</html>
