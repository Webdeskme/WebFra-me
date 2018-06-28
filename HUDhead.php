<meta charset="utf-8">
<title><?php echo $wd_Title; ?></title>
   <meta http-equiv="content-language" content="ll-cc">
    <meta name="language" content="English">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="<?php echo $wd_Title; ?>">
    <meta name="description" content="Welcome to <?php echo $wd_Title; ?>.">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="copyright" content="&copy; <?php echo date("Y") . ' ' . $wd_Title; ?>">
    <meta name="theme-color" content="#000000"/>
    <link rel="apple-touch-icon" href="favicon.ico">
    <link rel="apple-touch-startup-image" href="favicon.ico">
<link rel="manifest" href="manifest.php">
<link rel="stylesheet" href="Plugins/wd-bootstrap/css/webdesk_bootstrap.min.css" async>
<link rel="stylesheet" href="Plugins/jquery-ui/jquery-ui.min.css"  async>
<link rel="stylesheet" type="text/css" href="Plugins/context.standalone.css"  async>
<link href="Plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet"  async/>
<link href="Plugins/fullcalendar/fullcalendar.print.min.css" rel="stylesheet" media="print" async/>
<link rel="stylesheet" type="text/css" href="Theme/default.php" async>
<script src="Plugins/jquery.min.js" defer></script>
<script src="Plugins/wd-bootstrap/js/webdesk_bootstrap.js" defer></script>
<script src="Plugins/jquery-ui/jquery-ui.min.js" defer></script>
<script src="Plugins/tinymce/js/tinymce/tinymce.min.js" defer></script>
<script src="Plugins/fullcalendar/lib/moment.min.js" defer></script>
<script src="Plugins/fullcalendar/fullcalendar.min.js" defer></script>
<script defer src="Plugins/fontawesome-free/svg-with-js/js/fontawesome-all.min.js" defer></script>
<?php
include 'wd_ch.php';
if(isset($_GET["app"])){
        if(file_exists($type . "/" . $app . "/header.php")){
            include($type . "/" . $app . "/header.php");
		}
        if(isset($sec) && file_exists($type . "/" . $app . "/header_" . $sec)){
            include($type . "/" . $app . "/header_" . $sec);
		}
        if(file_exists($type . "/" . $app . "/style.css")){
          ?>
            <link rel="stylesheet" type="text/css" href="<?php echo $type . "/" . $app . "/style.css"; ?>">
                                                                                          <?php
		}
        if(isset($sec) && file_exists($type . "/" . $app . "/style_" . $sec)){
            ?>
            <link rel="stylesheet" type="text/css" href="<?php echo $type . "/" . $app . "/style_" . $sec; ?>">
  <?php
		}
    }
?>
