<?php
session_start();
$x = trim($_POST['ver']);
$y = trim($_SESSION['ran']);
if ($x != $y){
header('Location: index.php');    
}
else{
   $_SESSION["caver"] = "yes";
?>
<!doctype html>

<!-- Copyright 2015 WebDesk.me -->





















































<html>
   <head>
      <title>Create an Account</title>
      <style>
        html{
            width: 100%;
            height: 100%;
            padding: 0px;
            margin: 0px;
            background: -webkit-radial-gradient(#0099FF, #FFFFFF, #0099FF); /* Safari 5.1 to 6.0 */
            background: -o-radial-gradient(#0099FF, #FFFFFF, #0099FF); /* For Opera 11.6 to 12.0 */
            background: -moz-radial-gradient(#0099FF, #FFFFFF, #0099FF); /* For Firefox 3.6 to 15 */
            background: radial-gradient(#0099FF, #FFFFFF, #0099FF); /* Standard syntax */
        }
        body{
            width: 100%;
            height: 100%;
            margin: 0px;
            padding: 0px;
            font-family: cursive;
            color: #000099;
            font-size: 1.5em;
            text-align: center;
        }
	iframe{
	 width: 80%;
	}
      </style>
      <script src='https://www.google.com/recaptcha/api.js'></script>
   </head>
   <body>
      <form method="post" action="caSub.php" onsubmit="return valform()">
      <h1>Create an Account</h1>
      <div style="color: red;">Please read the information on this page carefully before filling out the form.</div>
      <h2>Terms of Use: </h2>
      <iframe src="termsofuse.html"></iframe>
      <h2>Privacy Policy</h2>
      <iframe src="privacypolicy.html"></iframe>
      <h2>Registered Email: <span style="color: black;"><?php echo $_SESSION['email'];?></span></h2>
      <fieldset>
	 <legend>Registration Form</legend>
	 <div style="color: red;">* means Required</div><br>
	 I have agreed to and have read WebDesk.me's Terms of Use and Privacy Policy.<span style="color: red;">*</span> <input type="checkbox" name="agree" required autofocus="autofocus"><br><br>
	 <label for="age">You must be 13 years or older to have an acaount on or use this website. <br>
	 How old are you? <span style="color: red;">*</span></label><br>
	 <input type="number" id="age" name="age" required maxlength="3" placeholder="Your age in years." title="Your age in years."><br><br>
	 <label for="user" title="Add username here.">Username:<span style="color: red;">*</span> </label><br>
	 <input type="text" name="user" id="user" required placeholder="Add username here." title="Add username here."><br><br>
	 <label for="pass" title="Add password here.">Password:<span style="color: red;">*</span> </label><br>
	 <input type="password" name="pass" id="pass" required placeholder="Add password here." title="Add password here."><br><br>
	 <label for="verify" title="Verify password here.">Verify Password:<span style="color: red;">*</span> </label><br>
	 <input type="password" name="verify" id="verify" required placeholder="Verify password here." title="Verify password here."><br><br>
	 <div align="center" class="g-recaptcha" data-sitekey="6LfI7gATAAAAAMwLAKRqFMORx1wJWTXuBNP4rwDQ"></div>
	 <input type="submit" value="Create Account">
      </fieldset><br><br>
      </form>
      <script>
	 function valform() {
	    if (!document.getElementById("agree").checked) {
	       alert("You need to check that you have read and understand the Terms of Use and Privacy Policy, before submitting.");
	       return false;
	    }
	 }
      </script>
   </body>
</html>
<?php   
}
?>
