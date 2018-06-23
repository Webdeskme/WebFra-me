<?php
include("testInput.php");
    if(file_exists("path.php") && $wd_roots[$_SERVER['HTTP_HOST']] != "NA"){
		header('Location: index.php');
	}
	else{
    $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
    $string = '';
 $max = strlen($characters) - 1;
 for ($i = 0; $i < 16; $i++) {
      $string .= $characters[mt_rand(0, $max)];
 }
?>
<!doctype html>

<!-- Copyright <?php echo date("Y"); ?> WebDesk.me -->

<html>
    <head>
        <title>Install</title>
    </head>
    <body>
        <h1>WebDesk Install</h1>
        <h2>Version Check</h2>
        <table class="table mb-5" border='0' cellspacing='0' style="width: 50vw;margin: 2rem 0 4rem;" cellpadding="10">
            <tbody>
                <tr>
                    <th width="33%">
                        PHP Version
                    </th>
                    <td width="33%">
                        <?php echo phpversion(); ?>
                    </td>
                    <td width="33%" style="background-color: <?php echo (phpversion() >= 5.1) ? "green" : "red"; ?>;text-align: center;color:white;">
                        <?php echo (phpversion() >= 5.1) ? "&#10003;" : 'X'; ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr />
        <form method="POST" action="installSub.php">
		<label for="title">Website Title:</label><br>
            <input type="text" name="title" id="title" placeholder="Website Title" required>
            <br><hr><br>
			<label for="Username">Username:</label><br>
            <input type="text" name="Username" id="Username" placeholder="Username" required>
            <br><hr><br>
            <label for="password">New Password</label><br>
            <input type="password" name="password" id="password" placeholder="New Password" required>
            <br><br>
            <label for="confirm">Confirm</label><br>
            <input type="password" name="confirm" id="confirm" placeholder="Confirm Password" required>
            <br><hr><br>
<?php
if(file_exists('path.php')){
 ?>
            <label for="path">Offline File Path</label><br>
            <input type="text" name="path" id="path" placeholder="File Path" value="<?php echo __DIR__ . '/' . $string; ?>">
            <br><hr><br>
            <?php
}
else{
  ?>
<input type="hidden" name="pre" value="yes">
  <?php
}
             ?>
		<h3>Email is optional but highly advised.</h3>
		<label for="SMTP">SMTP Server</label><br>
		<input type="text" name="SMTP" id="SMTP" placeholder="SMTP Server">
		<br><br>
		<label for="port">SMTP Port</label><br>
		<input type="text" name="port" id="port" placeholder="SMTP Port">
		<br><br>
		<label for="email">Email</label><br>
		<input type="text" name="email" id="email" placeholder="Email">
		<br><br>
		<label for="epass">Email Password</label><br>
		<input type="text" name="epass" id="epass" placeholder="Email Password">
		<br><br>
            <p>By clicking install you are agreeing <a href="License.html" target="_blank">WebDesk's Licence</a>. This install also comes with a generic pricey policy and terms of use for your install. You will be held accountable to that terns of use and privacy policy until the time you edit it.</p>
            <input type="submit" value="install">
        </form>
    </body>
</html>
<?php
     }
?>
