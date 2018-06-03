<?php
$wd_path ="";
    if(file_exists("path.php")){
        $wd_path = file_get_contents("path.php");
    }
    if($wd_path != ""){
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

<!-- Copyright 2015 WebDesk.me -->

<html>
    <head>
        <title>Install</title>
    </head>
    <body>
        <h1>WebDesk Install</h1>
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
	    <label for="web">Web Directory</label><br>
            <input type="text" name="web" id="web" placeholder="Web Directory" value="default">
	    <br><br>
            <label for="path">Offline File Path</label><br>
            <input type="text" name="path" id="path" placeholder="File Path" value="<?php echo __DIR__ . '/' . $string; ?>">
            <br><hr><br>
		<h3>Email is optional but highly adviced.</h3>
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
