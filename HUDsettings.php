<?php

$wf_user = new user;
?>
<!--<div style="background-color: <?php echo $wf_user->getProfileColor() ?>; overflow: scroll; height: 90%;">-->
<div style="overflow: scroll; height: 90%;">

  <nav class="mb-3 navbar navbar-expand-sm navbar-light bg-light">
    
    <a class="navbar-brand" href="#"><span class="fa fa-cogs"></span> <?php echo $wf_user->getUsername() ?>&apos;s Settings</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <form method="post" class="ml-auto" action="Home.php?id=<?php $val = test_input(file_get_contents($wd_adminFile . 'val.txt')); echo $_SESSION["user"] . '&val=' . $val; ?>&type=<?php echo $_SESSION["HUD"]; ?>">
        <input type="hidden" name="lastPage" value="true" />
        <div class="btn-group">
          <button type="submit" name="lastPage" class="no-ajax btn btn-secondary"><i class="fa fa-magic"></i> Auto Login</button>
          <a href="logout.php" class="btn btn-danger text-white"><i class="fa fa-power-off"></i> Sign Out</a>
        </div>
      </form>
    </div>
    
  </nav>
  
  <div class="container ">
    
    <nav id="wf-profilesettings-scroll-nav" class="wf-scrollspy navbar navbar-light bg-white my-5 sticky-top">
      <ul class="nav nav-pills nav-fill">
        <li class="nav-item">
          <a class="nav-link" href="#wf-collapse-Profile">Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#wf-collapse-Password">Password</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#wf-collapse-Screen">Look &amp; Feel</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#wf-collapse-Defaults">App Defaults</a>
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
            
            <form method="post" action="includes/HUD/settingsSub.ajax.php" wf-form-type="ajax">
              
              <input type="hidden" name="from" value="//<?php echo $_SERVER["HTTP_HOST"] ?>/desktop.php#tabs-4" />
              <input type="hidden" name="f" value="saveProfile" />
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
              <div class="form-group text-center pt-3">
                <button type="submit" class="btn btn-primary">Save Profile</button>
              </div>
              
            </form>
            
          </div>
        </div>
        
      </div>
      <div class="my-5" id="wf-collapse-Password">
        
        <h3 class="mb-3 bg-light p-3 rounded">Password</h3>
        
        <div class="row">
          <div class="col-md-8 offset-md-2 py-4">
            
            <form method="post" action="includes/HUD/settingsSub.ajax.php" wf-form-type="ajax">
              
              <input type="hidden" name="f" value="changePassword" />
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
      <div class="" id="wf-collapse-Screen">
        
        <h3 class="mb-3 bg-light p-3 rounded">Look &amp; Feel</h3>
        
        <div class="row">
          <div class="col-md-8 offset-md-2 py-4">
            
            <form name="changeDisplaySettings" method="post" action="includes/HUD/settingsSub.ajax.php" wf-form-type="ajax">
              <script src="Plugins/jscolor/jscolor.js"></script>
              <script>
                function updatePColor(picker){
                  //alert(picker.jscolor);
                  $(".tab.bgcolor").css("backgroundColor", "#" + picker.jscolor);
                }
              </script>

              <input type="hidden" name="f" value="changeDisplaySettings" />
              <div class="form-group row">
                <label for="back" class="col-sm-3 col-form-label">Background Image</label>
                <div class="col-sm-9">
                  <input type="text" name="back" id="back" value="<?php echo $back; ?>" class="form-control" placeholder="http://www.somthing.com/picture.jpg" title="http://www.somthing.com/picture.jpg" required />
                </div>
              </div>
              <div class="form-group row">
                <label for="opass" class="col-sm-3 col-form-label">Background Color</label>
                <div class="col-sm-9">
                  <input name="color" id="color" class="form-control jscolor{hash:true}" value="<?php echo $color; ?>" />
                  <small id="colorHelpInline" class="text-muted">
                    Why do we have this? Because we can, that's why...
                  </small>
                </div>
              </div>
              <div class="form-group row">
                <label for="pcolor" class="col-sm-3 col-form-label">Page Color</label>
                <div class="col-sm-9">
                  <input name="pcolor" id="pcolor" class="form-control jscolor {hash:true}" onChange="updatePColor(this);" value="<?php echo $wf_user->getProfileColor() ?>">
                  <small id="pcolorHelpInline" class="text-muted">
                    What&apos;s the difference between background and page color? Your guess is as good as mine.
                  </small>
                </div>
              </div>
              
              <div class="form-group text-center pt-3">
                <button type="submit" class="btn btn-primary">Save Settings</button>
              </div>
              
            </form>
            
          </div>
        </div>
        
      </div>
      <div class="" id="wf-collapse-Defaults">
        
        <h3 class="mb-3 bg-light p-3 rounded">App Defaults</h3>
        
        <div class="row">
          <div class="col-md-8 offset-md-2 py-4">
            
            <table class="table">
              <tbody>
              <?php
              if(file_exists($wd_extFile . "ext.json")){
                $obj = file_get_contents($wd_extFile . "ext.json");
    	          $obj = json_decode($obj,true); 
    	          foreach($obj as $key => $value){
    	            ?>
    	            <tr>
    	              <td>
    	                <?php echo $key ?>
    	              </td>
    	              <td>
    	                <?php echo $value ?>
    	              </td>
    	              <td class="text-right">
    	                <a href="//<?php echo $_SERVER["HTTP_HOST"] ?>/ext.php?f=remove&ext=<?php echo $key ?>" class="btn btn-link text-dark" ><i class="fa fa-trash-alt fa-fw"></i></button>
    	              </td>
    	            </tr>
    	            <?php
    	          }
              }
              else{
                ?>
                <tr>
                  <td colspan="10" class="text-muted text-center">
                    You have no set defaults
                  </td>
                </tr>
                <?php
              }
              ?>
              </tbody>
            </table>
            
          </div>
        </div>
        
      </div>
      <div class="" id="wf-collapse-Account">
        
        <h3 class="mb-3 bg-light p-3 rounded">Account</h3>
        
        <div class="row">
          <div class="col-md-8 offset-md-2 py-4">
            
            <form method="post" action="url.php">
            
              <div class="form-group row">
                <label for="username" class="col-sm-3 col-form-label">WebDesk URL</label>
                <div class="col-sm-9">
                  <input type="text" name="url" class="form-control" placeholder="http://www.something.com" value="<?php echo $wf_user->getWebdeskURL(); ?>" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="username" class="col-sm-3 col-form-label">Remove Account</label>
                <div class="col-sm-9">
                  <a href="#" class="btn btn-link text-primary">Delete My Account</a>
                </div>
              </div>
              
              <div class="form-group text-center pt-3">
                <button type="submit" class="btn btn-primary">Save Settings</button>
              </div>
              
            </form>
            
          </div>
        </div>
        
      </div>
    </div>
    
  </div>


    
    



    <!--<details>-->
    <!--<summary><b style="font-size: 1.5em;">Delete Account</b></summary><br><br>-->
    <!--</details><br><br>-->
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('body').css("position","relative").scrollspy({ target: '.wf-scrollspy' });
    $('body').on('activate.bs.scrollspy', function () {
      console.log('yes');
    })
  });
  $("form[wf-form-type='ajax']").submit(function(){
    
    var postUrl = $(this).attr("action");
    var postVars = $(":input",this).serialize();
    var useMethod = $(this).attr("method");
    
    if($(".status-icon",this).length == 0)
      $(":input[type='submit']",this).after('<span class="status-icon ml-2"><i class="fas fa-spinner fa-spin fa-lg"></i></span>');
    else
      $(".status-icon",this).html('<i class="fas fa-spinner fa-spin fa-lg"></i>');
    
    $.ajax({
      context: $(this),
      data: postVars,
      method: useMethod,
      url: postUrl,
      complete: function(jqXHR, textStatus){
        console.log("AJax call finished");
      },
      error: function(jqXHR, textStatus, errorThrown){
        console.error("Error with AJax call: " + errorThrown);
      },
      success: function(data, textStatus, jqXHR){
        
        console.log(data);
        if(data.response == 300)
          $(".status-icon",this).html('<i class="fa fa-check-circle fa-fw fa-lg text-success"></i>');
        else
          $(".status-icon",this).html('<span class="text-danger"><i class="fa fa-times-circle fa-lg"></i> ' + data.error + '<span>');
        
      }
    });
    
    return false;
    
  });
</script>