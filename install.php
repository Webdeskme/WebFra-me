<?php
$wd_path ="";
    if(file_exists("path.php")){
        $wd_path = file_get_contents("path.php");
    }
    if($wd_path != ""){
		header('Location: index.php');
	}
	else{
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
		<label>Website Title:</label><br>
            <input type="text" name="title" placeholder="Website Title">
            <br><hr><br>
			<label>Username:</label><br>
            <input type="text" name="Username" placeholder="Username">
            <br><hr><br>
            <label>New Password</label><br>
            <input type="password" name="password" placeholder="New Password">
            <br><br>
            <label>Confirm</label><br>
            <input type="password" name="confirm" placeholder="Confirm Password">
            <br><hr><br>
            <label>Offline File Path</label><br>
            <input type="text" name="path" placeholder="File Path" value="/home/bob/webdesk">
            <br><br>
            <p>By clicking install you are agreeing to the terms of use and the privacey policey for WebDesk.</p>
            <input type="submit" value="install">
        </form>
    </body>
</html>
<?php
     }
?>
