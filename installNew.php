<?php
include_once("testInput.php");
if(file_exists("path.php") && file_exists($wd_roots[$_SERVER['HTTP_HOST']])){
	?>
	Your installation of Webdesk has been completed. Please delete this installation file.
	<?php
}

$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
$string = '';
$max = strlen($characters) - 1;
for ($i = 0; $i < 16; $i++) {
  $string .= $characters[mt_rand(0, $max)];
}
?>
<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="//<?php echo $_SERVER["HTTP_HOST"] ?>/Plugins/fontawesome-free/web-fonts-with-css/css/fontawesome.min.css">
    <link rel="stylesheet" href="//<?php echo $_SERVER["HTTP_HOST"] ?>/Plugins/wd-bootstrap/css/webdesk_bootstrap.min.css">

    <title>Webdesk Installation</title>
    
  </head>
  <body>
    
    <div class="webdesk_container">
    	<h1 class="webdesk_display-1 webdesk_my-5">Webdesk installation</h1>
    	<p>
    		This script will guide you through the installation process.
    	</p>
    	<h2>Dependency Check</h2>
      <table class="webdesk_table webdesk_mb-5">
        <tbody>
          <tr>
            <th width="33%">
                PHP Version
            </th>
            <td width="33%">
                <?php echo phpversion(); ?>
            </td>
            <td width="33%" class="webdesk_text-center">
                <i class="fa fa-check-circle fa-fw webdesk_text-<?php echo (phpversion() >= 5.1) ? "success" : "danger"; ?>"></i>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="//<?php echo $_SERVER["HTTP_HOST"] ?>/Plugins/jquery.min.js"></script>
    <script src="//<?php echo $_SERVER["HTTP_HOST"] ?>/Plugins/wd-bootstrap/js/webdesk_bootstrap.js"></script>
  </body>
</html>