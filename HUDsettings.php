<div style="background-color: <?php
if(file_exists($wd_root . '/User/' . $_SESSION["user"] . '/Admin/Pcolor.txt')){
    $pcolor = file_get_contents($wd_root . '/User/' . $_SESSION["user"] . '/Admin/Pcolor.txt');
    echo $pcolor;
}
else{
    echo '#FFFFFF';
}
?>; overflow: scroll; height: 90%;">
    <h1><span class="glyphicon glyphicon-cog"></span> <?php echo f_dec($_SESSION["user"]); ?>'s Settings</h1>
    <a href="logout.php"><button class="btn btn-danger"><span class="glyphicon glyphicon-off"></span> Logout</button></a>
<br><br>
    <form method="post" action="Home.php?id=<?php $val = test_input(file_get_contents($wd_adminFile . 'val.txt')); echo $_SESSION["user"] . '&val=' . $val; ?>&type=<?php echo $_SESSION["HUD"]; ?>">
        <input type="submit" name="lastPage" class="btn btn-primary" Value="AutoLogin">
    </form>
    <details>
    <summary><b style="font-size: 1.5em;">URL for your WebDesk</b></summary><br><br>
    <form method="post" action="url.php">
        <input type="text" name="url" placeholder="http://www.somthing.com" title="http://www.somthing.com" required><br><br>
        <input type="submit" value="Submit">
    </form>
    </details><br><br>
    <details>
    <summary><b style="font-size: 1.5em;">Set Wallpaper</b></summary><br><br>
    <form method="post" action="back.php">
        <input type="text" name="back" value="<?php echo $back; ?>" placeholder="http://www.somthing.com/picture.jpg" title="http://www.somthing.com/picture.jpg" required><br><br>
        <input type="submit" value="Submit">
    </form>
    </details><br><br>
    <details>
    <summary><b style="font-size: 1.5em;">Background color</b></summary><br><br>
    <form method="post" action="color.php">
        <input type="color" name="color" value="<?php echo $color; ?>"><br><br>
        <input type="submit" value="Submit">
    </form>
    </details><br><br>
    <details>
    <summary><b style="font-size: 1.5em;">Page color</b></summary><br><br>
    <form method="post" action="Pcolor.php">
        <input type="color" name="color" value="<?php echo $pcolor; ?>"><br><br>
        <input type="submit" value="Submit">
    </form>
    </details><br><br>
    <details>
    <summary><b style="font-size: 1.5em;">Reset Password</b></summary><br><br>
    <form method="post" action="">
        <label for="opass">Old Password: </label><br>
        <input type="password" name="opass" id="opass" placeholder="Old Password" title="Old Password" required><br><br>
        <label for="npass">New Password: </label><br>
        <input type="password" name="npass" id="npass" placeholder="New Password" title="New Password" required><br><br>
        <label for="vpass">Verify Password: </label><br>
        <input type="password" name="vpass" id="vpass" placeholder="Verify Password" title="Verify Password" required><br><br>
        <input type="submit" value="Submit"><br><br>
    </form>
    </details><br><br>
    <details>
    <summary><b style="font-size: 1.5em;">Default Programs</b></summary>
    <form method="post" action="ext.php">
        <input type="text" name="ext" placeholder="ext example(doc, wd_writer, pdf)">
        <select name="prog">
<?php
if ($handle = opendir('Apps/')) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
?>
            <option value="Apps/<?php echo $entry; ?>"><?php echo $entry; ?></option>
<?php
}}}
if ($handle = opendir('MyApps/')) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
?>
            <option value="MyApps/<?php echo $entry; ?>"><?php echo $entry; ?></option>
<?php
}}}
?>
        </select>
        <input type="submit" value="Save">
    </form> 
    </details><br><br>
    <details>
    <summary><b style="font-size: 1.5em;">Delete Account</b></summary><br><br>
    </details><br><br>
    </div>