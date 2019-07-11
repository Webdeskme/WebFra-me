<!-- 
////////////////////////////////////////////
//
// APPS TAB
//
// AUTHOR: ADAM TELFORD
// 
// THIS FILE DISPLAYS THE CONTENTS OF THE
// APPS TAB.
//
/////////////////////////////////////////////
// -->
<nav class="mb-3 navbar navbar-expand-sm navbar-light bg-light">
  <a class="navbar-brand" href="#">Apps</a>
</nav>
<div class="container-fluid">
    <?php
    $wd_tierobj = array();
    if(file_exists($wd_admin . test_input($wd_tier) . '.json')){
        
        $wd_tierobj = json_decode(file_get_contents($wd_admin . test_input($wd_tier) . '.json'),true);
        
        
    }
    
    for($x = 0; $x < 2; $x ++){
        $app_type = ($x == 0) ? "Apps" : "MyApps";
        ?>
        <?php echo ($x == 1) ? "<h5 class='mx-3 mt-3'>My Apps</h5>" : "" ?>
        <div class="row mx-3 defaultHUD_app-container <?php echo ($x == 0) ? "border-bottom" : "" ?>">
            <?php
            $category_count = 0;
            foreach (scandir($app_type . '/') as $entry){
                
                $app_type_d = (($x == 0) ? "" : "myApp_") . $entry;
                
                if ( ($entry != ".") && ($entry != "..") && ( ($wd_tier == "tA") || ( isset($wd_tierobj[$app_type_d]) && ($wd_tierobj[$app_type_d] == "Yes")) )  ){
                    
                    
                    
                    $app_name = $entry;
                    $app_description = null;
                    if(file_exists($app_type . "/" . $entry . "/app.json")){
                        $app_info = json_decode(file_get_contents($app_type . "/" . $entry . "/app.json"),true);
                        if(is_array($app_info) && !empty($app_info["name"]))
                            $app_name = $app_info["name"];
                        if(is_array($app_info) && !empty($app_info["description"]))
                            $app_description = $app_info["description"];
                            
                        if(!empty($app_info["require"]["AppEngine"]))
                            $default_icon = "MyApps/AppEngine/template_files/AppEngine_DefaultAppIcon.png";
                        else
                            $default_icon = "Apps/Dev/ic.png";
                    }
                    ?>
                    <div class="defaultHUD_app-selector col-xl-1 col-lg-2 col-md-4 p-4 col-sm-3 col-4 mb-1 text-center">
                        <a href="<?php wd_url($app_type, $entry, 'start.php', ''); ?>" class="" data-toggle="<?php echo (!is_null($app_description)) ? "tooltip" : ""; ?>" title="<?php echo $app_description ?>" data-placement="top" data-delay="1000">
                            <img src="<?php echo (file_exists($app_type . "/" . $entry . "/ic.png")) ? $app_type . "/" . $entry . "/ic.png" : $default_icon; ?>" class="img-fluid" />
                            <div style="font-size: .8rem;" class="mt-2"><?php echo $app_name; ?></div>
                        </a>
                    </div>
                    <?php
                    
                    $category_count ++;
                }
            }
            if( ($category_count == 0) && ($x == 1) ){
              ?>
              <div class="text-muted my-4">You have no apps</div>
              <?php
            }
            ?>
        </div>
        <?php
    }
    ?>
    
</div>