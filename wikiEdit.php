<?php
header("X-Robots-Tag: noIndex, nofollow", true);
if(isset($_SESSION["Login"])){
if ($_SESSION["Login"] != "YES") {
  session_destroy();
  header('Location: index.php?page=login.php&wiki=yes');
}
}
else{
  header('Location: index.php?page=login.php&wiki=yes');
}
if(isset($_GET['page'])){
  $wd_page = test_input($_GET['page']);
}
else{
  header('Location: wiki.php?page=Index');
}
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
<html lang="en-US">
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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="Plugins/tinymce/js/tinymce/tinymce.min.js"></script>
  <script>
tinymce.init({
    selector: '#banner',
    theme: 'modern',
    plugins: [
      'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'save table contextmenu directionality emoticons template paste textcolor toc autoresize hr insertdatetime pagebreak autosave save searchreplace'
    ],
    content_css: 'css/content.css',
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons | fullscreen | toc | insertdatetime | pagebreak | restoredraft | save | template | searchreplace'
  });
tinymce.init({
    selector: '#con',
    theme: 'modern',
    plugins: [
      'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'save table contextmenu directionality emoticons template paste textcolor toc autoresize hr insertdatetime pagebreak autosave save searchreplace'
    ],
    content_css: 'css/content.css',
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons | fullscreen | toc | insertdatetime | pagebreak | restoredraft | save | template | searchreplace'
  });
  tinymce.init({
    selector: '#footer',
    theme: 'modern',
    plugins: [
      'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'save table contextmenu directionality emoticons template paste textcolor toc autoresize hr insertdatetime pagebreak autosave save searchreplace'
    ],
    content_css: 'css/content.css',
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons | fullscreen | toc | insertdatetime | pagebreak | restoredraft | save | template | searchreplace'
  });
</script>
</head>
<body>
  <form method="post" action="wikiSub.php?page=wiki-banner&go=<?php echo $wd_page; ?>">
      <div class="form-group">
        <label for="banner">Banner:</label>
        <textarea class="form-control" id="banner" name="con"><?php
          if(file_exists($wd_root . 'Wiki/wiki-banner.php')){
            echo htmlspecialchars(file_get_contents($wd_root . 'Wiki/wiki-banner.php'));
          }
          ?></textarea>
      </div>
      <button type="submit" class="btn btn-default">Save Banner</button>
  </form>
  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php" title="Website"><span class="glyphicon glyphicon-globe"></span></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="wiki.php?page=Index" title="Wiki Home"><span class="glyphicon glyphicon-home"></span></a></li>
        <li><a href="wiki.php?page=<?php echo $wd_page; ?>" title="View"><span class="glyphicon glyphicon-eye-open"></span></a></li>
        <li class="active"><a href="#" titel="Edit"><span class="glyphicon glyphicon-pencil"></span></a></li>
        <li><a href="wiki.php?page=wiki-help" title="Help"><span class="glyphicon glyphicon-education"></span></a></li>
        <li><a href="wiki.php?page=wiki-chat" title="Chat"><span class="glyphicon glyphicon-comment"></span></a></li>
        <li><a href="wikiLog.php" title="Log" target="_blank"><span class="glyphicon glyphicon-list-alt"></span></a></li>
      </ul>
      <form method="get" action="wiki.php" class="navbar-form navbar-left">
      <div class="form-group">
        <input type="text" name="page" class="form-control" placeholder="Search">
      </div>
      <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
    </form>
      <ul class="nav navbar-nav navbar-right">
        <a href="wikiDelete.php?page=<?php echo $wd_page; ?>"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>Delete Page</button></a>
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo f_dec($_SESSION['user']); ?></a></li>
      </ul>
    </div>
  </div>
</nav>
  <div class="container">
    <h1><?php echo $wd_page; ?>:</h1>
    <hr>
    <form method="post" action="wikiSub.php?page=<?php echo $wd_page; ?>">
      <div class="form-group">
        <label for="con">Content:</label>
        <textarea class="form-control" id="con" name="con" autofocus><?php
          if(file_exists($wd_root . 'Wiki/' . $wd_page . '.php')){
            echo htmlspecialchars(file_get_contents($wd_root . 'Wiki/' . $wd_page . '.php'));
          }
          ?></textarea>
      </div>
      <button type="submit" class="btn btn-default">Save Content</button>
    </form>
    <hr>
    <form method="post" action="wikiSub.php?page=wiki-footer&go=<?php echo $wd_page; ?>">
      <div class="form-group">
        <label for="footer">Footer:</label>
        <textarea class="form-control" id="footer" name="con"><?php
          if(file_exists($wd_root . 'Wiki/wiki-footer.php')){
            echo htmlspecialchars(file_get_contents($wd_root . 'Wiki/wiki-footer.php'));
          }
          ?></textarea>
      </div>
      <button type="submit" class="btn btn-default">Save Footer</button>
    </form>
    <br>
  </div>
  <br>
</body>
</html>
