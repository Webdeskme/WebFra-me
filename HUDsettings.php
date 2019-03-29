<?php

$wf_user = new user;
?>
<div style="background-color: <?php echo $wf_user->getProfileColor() ?>; overflow: scroll; height: 90%;">

  <nav class="mb-3 navbar navbar-expand-sm navbar-light bg-light">
    <a class="navbar-brand" href="#"><span class="fa fa-cogs"></span> <?php echo $wf_user->getUsername() ?>&apos;s Settings</a>
  </nav>
  <div class="container">
    
    <nav id="wf-profilesettings-scroll-nav" class="navbar navbar-light bg-white my-5 sticky-top">
      <ul class="nav nav-pills nav-fill ">
        <li class="nav-item">
          <a class="nav-link active" href="#wf-collapse-Profile">Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#wf-collapse-Password">Security</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#wf-collapse-Screen">Look &amp; Feel</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#wf-collapse-Defaults">Defaults</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#wf-collapse-Account">Account</a>
        </li>
      </ul>
    </nav>
  
    <div class="my-5" data-spy="scroll" data-target="#wf-profilesettings-scroll-nav" data-offset="0">
      
      <div class="my-5" id="wf-collapse-Profile">
        
        <h3 class="mb-3 bg-light p-3 rounded">Edit Profile</h3>
        
        <div class="row">
          <div class="col-md-8 offset-md-2 py-4">
            
            
            <div class="form-group row">
              <label for="username" class="col-sm-3 col-form-label">Username</label>
              <div class="col-sm-9">
                <input type="text" readonly class="form-control-plaintext" id="username" name="username" value="<?php echo $wf_user->getUsername(); ?>" />
              </div>
            </div>
            <div class="form-group row">
              <label for="fn" class="col-sm-3 col-form-label">First Name</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="fn" name="fn" value="<?php echo $wf_user->getFirstName(); ?>" />
              </div>
            </div>
            <div class="form-group row">
              <label for="ln" class="col-sm-3 col-form-label">Last Name</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="ln" name="ln" value="<?php echo $wf_user->getLastName(); ?>" />
              </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-sm-3 col-form-label">Email</label>
              <div class="col-sm-9">
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $wf_user->getEmail(); ?>" />
              </div>
            </div>
            <div class="form-group row">
              <label for="contact" class="col-sm-3 col-form-label">Contact</label>
              <div class="col-sm-9">
                <textarea class="form-control" id="contact" name="contact" rows="2"><?php echo $wf_user->getContactInfo(); ?></textarea>
              </div>
            </div>
            
          </div>
        </div>
        
      </div>
      <div class="my-5" id="wf-collapse-Password">
        
        <h3 class="mb-3 bg-light p-3 rounded">Change Password</h3>
        
        <div class="row">
          <div class="col-md-8 offset-md-2 py-4">
            
            <form method="post" action="">
            
              <div class="form-group row">
                <label for="opass" class="col-sm-3 col-form-label">Current Password</label>
                <div class="col-sm-9">
                  <input type="password" class="form-control" id="opass" name="opass" />
                </div>
              </div>
              <div class="form-group row">
                <label for="npass" class="col-sm-3 col-form-label">New Password</label>
                <div class="col-sm-9">
                  <input type="password" class="form-control" id="npass" name="npass" />
                </div>
              </div>
              <div class="form-group row">
                <label for="vpass" class="col-sm-3 col-form-label">Confirm Password</label>
                <div class="col-sm-9">
                  <input type="password" class="form-control" id="vpass" name="vpass" />
                </div>
              </div>
              <div class="form-group text-center pt-3">
                <button type="submit" class="btn btn-primary">Save Password</button>
              </div>
              
            </form>
            
          </div>
        </div>
        
      </div>
      <div class="" id="wf-collapse-Defaults">
        
        <h3 class="mb-3 bg-light p-3 rounded">Set Defaults</h3>
        
        <div class="row">
          <div class="col-md-8 offset-md-2 py-4">
            
            
            
            
          </div>
        </div>
        
      </div>
    </div>
    
  </div>

    <!--<div class="float-right">-->
    <!--    <form method="post" action="Home.php?id=<?php $val = test_input(file_get_contents($wd_adminFile . 'val.txt')); echo $_SESSION["user"] . '&val=' . $val; ?>&type=<?php echo $_SESSION["HUD"]; ?>">-->
    <!--    <div class="btn-group">-->
    <!--        <a href="logout.php" class="btn btn-danger text-white"><i class="fa fa-power-off"></i> Logout</a>-->
    <!--        <input type="hidden" name="lastPage" value="true" />-->
    <!--        <button type="submit" name="lastPage" class="no-ajax btn btn-secondary"><i class="fa fa-sign-in"></i> AutoLogin</button>-->
    <!--    </div>-->
    <!--    </form>-->
    <!--</div>-->
    
    
    <!--<details>-->
    <!--<summary><b style="font-size: 1.5em;">URL for your WebDesk</b></summary><br><br>-->
    <!--<form method="post" action="url.php">-->
    <!--    <input type="text" name="url" placeholder="http://www.something.com" title="http://www.something.com" required><br><br>-->
    <!--    <input type="submit" value="Submit" class="btn btn-primary">-->
    <!--</form>-->
    <!--</details><br><br>-->
    <!--<details>-->
    <!--<summary><b style="font-size: 1.5em;">Set Wallpaper</b></summary><br><br>-->
    <!--<form method="post" action="back.php">-->
    <!--    <input type="text" name="back" value="<?php echo $back; ?>" placeholder="http://www.somthing.com/picture.jpg" title="http://www.somthing.com/picture.jpg" required><br><br>-->
    <!--    <input type="submit" value="Submit">-->
    <!--</form>-->
    <!--</details><br><br>-->
    <!--<details>-->
    <!--<summary><b style="font-size: 1.5em;">Background color</b></summary><br><br>-->
    <!--<form method="post" action="color.php">-->
    <!--    <input type="color" name="color" value="<?php echo $color; ?>"><br><br>-->
    <!--    <input type="submit" value="Submit">-->
    <!--</form>-->
    <!--</details><br><br>-->
    <!--<details>-->
    <!--<summary><b style="font-size: 1.5em;">Page color</b></summary><br><br>-->
    <!--<form method="post" action="Pcolor.php">-->
    <!--    <input type="color" name="color" value="<?php echo $pcolor; ?>"><br><br>-->
    <!--    <input type="submit" value="Submit">-->
    <!--</form>-->
    <!--</details><br><br>-->
    <!--<details>-->
    <!--<summary><b style="font-size: 1.5em;">Reset Password</b></summary><br><br>-->
    <!--<form method="post" action="">-->
    <!--    <label for="opass">Old Password: </label><br>-->
    <!--    <input type="password" name="opass" id="opass" placeholder="Old Password" title="Old Password" required><br><br>-->
    <!--    <label for="npass">New Password: </label><br>-->
    <!--    <input type="password" name="npass" id="npass" placeholder="New Password" title="New Password" required><br><br>-->
    <!--    <label for="vpass">Verify Password: </label><br>-->
    <!--    <input type="password" name="vpass" id="vpass" placeholder="Verify Password" title="Verify Password" required><br><br>-->
    <!--    <input type="submit" value="Submit"><br><br>-->
    <!--</form>-->
    <!--</details><br><br>-->
    <!--<details>-->
    <!--<summary><b style="font-size: 1.5em;">Default Programs</b></summary>-->
    <!--<form method="post" action="ext.php">-->
    <!--    <input type="text" name="ext" placeholder="ext example(doc, wd_writer, pdf)">-->
    <!--    <select name="prog">-->
    <!--<?php-->
    <!--if ($handle = opendir('Apps/')) {-->
    <!--            while (false !== ($entry = readdir($handle))) {-->
    <!--                if ($entry != "." && $entry != "..") {-->
    <!--?>-->
    <!--        <option value="Apps/<?php echo $entry; ?>"><?php echo $entry; ?></option>-->
    <!--<?php-->
    <!--}}}-->
    <!--if ($handle = opendir('MyApps/')) {-->
    <!--            while (false !== ($entry = readdir($handle))) {-->
    <!--                if ($entry != "." && $entry != "..") {-->
    <!--?>-->
    <!--        <option value="MyApps/<?php echo $entry; ?>"><?php echo $entry; ?></option>-->
    <!--<?php-->
    <!--}}}-->
    <!--?>-->
    <!--    </select>-->
    <!--    <input type="submit" value="Save">-->
    <!--</form>-->
    <!--</details><br><br>-->
    <!--<details>-->
    <!--<summary><b style="font-size: 1.5em;">Delete Account</b></summary><br><br>-->
    <!--</details><br><br>-->
</div>
