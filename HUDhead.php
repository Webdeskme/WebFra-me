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
  <link rel="stylesheet" href="Plugins/wd-bootstrap/css/webdesk_bootstrap.min.css">
  <link rel="stylesheet" href="Plugins/jquery-ui-custom/jquery-ui.min.css">
  <link rel="stylesheet" href="Plugins/fontawesome-free-5.2/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="Plugins/context.standalone.css">
  <link href="Plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet"/>
  <link href="Plugins/fullcalendar/fullcalendar.print.min.css" rel="stylesheet" media="print"/>
  <link rel="stylesheet" type="text/css" href="Theme/default.php">
  
  <script>if (typeof module === 'object') {window.module = module; module = undefined;}</script>
  <script src="Plugins/jquery.min.js"></script>
  <script src="Plugins/wd-bootstrap/js/webdesk_bootstrap.js"></script>
  <script src="Plugins/jquery-ui-custom/jquery-ui.min.js"></script>
  <script src="Plugins/tinymce/js/tinymce/tinymce.min.js"></script>
  <script src="Plugins/fullcalendar/lib/moment.min.js"></script>
  <script src="Plugins/fullcalendar/fullcalendar.min.js"></script>
  <!--<script defer src="Plugins/fontawesome-free-5.2/js/all.min.js"></script>-->

  <style>
    html,body{
      font-size: 12pt;
    }
    .webdesk_defaultHUD_app-container .webdesk_defaultHUD_app-selector a:hover img{
      box-shadow: 0 2px 2px rgba(0,0,0,0.25);
    }
    .webdesk_defaultHUD_app-container .webdesk_defaultHUD_app-selector a:hover{
      text-decoration: none;
    }
    .ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active, a.ui-button:active, .ui-button:active, .ui-button.ui-state-active:hover{
      background: #1161D9;
    }
    .no-hover:hover{
      text-decoration: none;
    }
  </style>

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
