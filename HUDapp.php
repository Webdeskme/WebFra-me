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
<nav class="webdesk_mb-3 webdesk_navbar webdesk_navbar-expand-sm webdesk_navbar-light webdesk_bg-light">
  <a class="webdesk_navbar-brand" href="#">Apps</a>
  <button class="webdesk_navbar-toggler" type="button" data-toggle="webdesk_collapse" data-target="#defaultHUD_appsMoreDiv" aria-controls="defaultHUD_appsMoreDiv" aria-expanded="false" aria-label="Toggle navigation">
    <span class="webdesk_navbar-toggler-icon"></span>
  </button>

  <div class="webdesk_collapse navbar-collapse" id="defaultHUD_appsMoreDiv">
    
  </div>
</nav>
<div class="webdesk_container-fluid">
    <?php
    $wd_tierobj = [];
    if(file_exists($wd_admin . test_input($wd_tier) . '.json')){
        
        $wd_tierobj = json_decode(file_get_contents($wd_admin . test_input($wd_tier) . '.json'));
        
    }
    
    for($x = 0; $x < 2; $x ++){
        $app_type = ($x == 0) ? "Apps" : "MyApps";
        ?>
        <?php echo ($x == 1) ? "<h5 class='webdesk_mx-3 webdesk_mt-3'>My Apps</h5>" : "" ?>
        <div class="webdesk_row webdesk_mx-3 webdesk_defaultHUD_app-container <?php echo ($x == 0) ? "webdesk_border-bottom" : "" ?>">
            <?php
            foreach (scandir($app_type . '/') as $entry){
                if ($entry != "." && $entry != "..") {
                    $app_name = $entry;
                    $app_description = null;
                    if(file_exists($app_type . "/" . $entry . "/app.json")){
                        $app_info = json_decode(file_get_contents($app_type . "/" . $entry . "/app.json"),true);
                        if(is_array($app_info) && !empty($app_info["name"]))
                            $app_name = $app_info["name"];
                        if(is_array($app_info) && !empty($app_info["description"]))
                            $app_description = $app_info["description"];
                    }
                    ?>
                    <div class="webdesk_defaultHUD_app-selector webdesk_col-xl-1 webdesk_col-lg-2 webdesk_col-md-3 webdesk_p-4 webdesk_col-sm-4 webdesk_col-xs-6 webdesk_mb-1 webdesk_text-center">
                        <a href="<?php wd_url($app_type, $entry, 'start.php', ''); ?>" class="" data-toggle="<?php echo (!is_null($app_description)) ? "webdesk_tooltip" : ""; ?>" title="<?php echo $app_description ?>" data-placement="webdesk_top" data-delay="1000">
                            <img src="<?php echo (file_exists($app_type . "/" . $entry . "/ic.png")) ? $app_type . "/" . $entry : "Apps/DevTools"; ?>/ic.png" class="webdesk_img-fluid" />
                            <div style="font-size: .8rem;" class="webdesk_mt-2"><?php echo $app_name; ?></div>
                        </a>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <?php
    }
    ?>
    
</div>