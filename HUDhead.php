<meta charset="utf-8">
<title>Desktop</title>
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
<link rel="stylesheet" type="text/css" href="Theme/default.php">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script src="Plugins/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="Plugins/React/react.min.js"></script>
<script src="Plugins/React/react-dom.min.js"></script>
<script src="Plugins/literallycanvas-0.4.14/js/literallycanvas.js"></script>
<script src="Plugins/fullcalendar-3.3.0/lib/moment.min.js"></script>
<script src="Plugins/fullcalendar-3.3.0/fullcalendar.min.js"></script>
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
$( "#tabs" ).tabs({

collapsible: true
//active: false
});
$( ".tab" ).resizable();
<?php if(!isset($_SESSION["wd_fullscreen"]) || $_SESSION["wd_fullscreen"] != 'on'){  ?> 
$( ".tab" ).draggable();
<?php } ?>
});
</script>