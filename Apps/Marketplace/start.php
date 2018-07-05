<?php
$www = 'desktop.php?type=Apps&app=Market&sec=start.php';
include("pageHeader.php");
$can_open_market = false;
if(file_exists("wd_market.json")){
  $market2 = json_decode(@file_get_contents("wd_market.json"),true);
  if(is_array($market2)){
    
    $market2_categories = array();
    foreach($market2 as $market_app){
      $cat = $market_app["cat"];
      if(!in_array($cat, $market2_categories))
        $market2_categories[] = $cat;
    }
    sort($market2_categories);
    
    ?>
    <div class="webdesk_containerr webdesk_mb-5 webdesk_mt-3 webdesk_p-3">
      <div class="webdesk_row">
        <div class="webdesk_col-md-3">
          <div class="webdesk_sticky-top category-menu">
            <div class="webdesk_list-group">
              <div class="webdesk_list-group-item"><b>Categories</b></div>
              <a href="#" id="cat-button-all" class="webdesk_list-group-item webdesk_list-group-item-action webdesk_active" onclick="load_market();">All</a>
              <?php
              foreach($market2_categories as $market_category){
                ?>
                <a href="#" id="cat-button-<?php echo  $market_category ?>" class="webdesk_list-group-item webdesk_list-group-item-action" onclick="load_market('<?php echo $market_category ?>');"><?php echo $market_category ?></a>
                <?php
              }
              ?>
              
            </div>
            <div class="webdesk_list-group webdesk_mt-3">
              <a href="#" id="cat-button-my_apps" class="webdesk_list-group-item webdesk_list-group-item-action" onclick="load_market('my_apps');"><i class="fa fa-th-large fa-fw"></i> My Apps</a>
            </div>
          </div>
        </div>
        <div class="webdesk_col">
          <div id="load" class="webdesk_text-center webdesk_position-absolute">
            <i class="fa fa-spinner fa-pulse fa-2x"></i>
            <span class="sr-only">Loading...</span>
          </div>
          <?php
          if(filemtime("wd_market.json") < time() - (60 * 60)){
            ?>
            <div class="webdesk_alert webdesk_alert-info webdesk_alert-dismissable">
              There was an error in updating your local version of the market. 
              <a href="<?php wd_urlSub($wd_type, $wd_app, 'UpList.php', ''); ?>" class="webdesk_btn webdesk_btn-outline-secondary webdesk_btn-sm">Update manually</a>
            </div>
            <?php
          }
          ?>
          
          <div class="webdesk_row marketApp-container">
            <div class="noapps hide webdesk_text-muted webdesk_p-3">
              No apps within search parameters
            </div>
            <div class="webdesk_col-md-4 webdesk_mb-3 marketApp template hide">
              
              <div class="webdesk_card">
                <div class="webdesk_card-body">
                  <div class="webdesk_row">
                    <div class="webdesk_col-sm-3">
                    
                      <img src="Apps/Terminal/ic.png" alt="" class="webdesk_img-fluid webdesk_mb-3 app-img" style="" />
                    
                    </div>
                    <div class="webdesk_col">
                      <h5 class="webdesk_card-title app-title">
                        Awesome App
                      </h5>
                      
                      <p class="app-description">
                        <small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </small>
                      </p>
                      <p class="app-developer">
                        Developer: John Doe
                      </p>
                      
                    </div>
                  </div>
                </div>
                <div class="webdesk_card-footer">
                  <div class="app-price webdesk_float-right">
                    FREE
                  </div>
                  <button type="button" class="app-install-button webdesk_btn webdesk_btn-bloc webdesk_btn-primary webdesk_text-white"><i class="fa fa-download fa-fw"></i> Install</button>
                    <button type="button" class="app-moreinfo-button webdesk_btn webdesk_btn-bloc webdesk_btn-outline-secondary">More Info</button>
                </div>
              </div>
              
            </div>
          </div>
          
        </div>
      </div>
    </div>
    
    <div class="webdesk_modal webdesk_fade" id="viewAppMoreModal" tabindex="-1" role="dialog" aria-labelledby="viewAppMoreModalLabel" aria-hidden="true">
      <div class="webdesk_modal-dialog  webdesk_shadow-lg webdesk_modal-lg" role="document">
        <div class="webdesk_modal-content">
          <div class="webdesk_modal-header">
            <h5 class="webdesk_modal-title" id="viewAppMoreModalLabel">App Info</h5>
            <button type="button" class="webdesk_close" data-dismiss="webdesk_modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="webdesk_modal-body">
            <div class="webdesk_row">
              <div class="webdesk_col-sm-3">
                <img src="Apps/Market/ic.png" class="webdesk_img-fluid app-img" alt="" />
                <p class="app-price webdesk_text-center webdesk_mt-2 webdesk_lead">FREE</p>
              </div>
              <div class="webdesk_col">
                <h1 class="app-title"></h1>
                <p><a href="#" class="app-category"></a></p>
                <p class="app-description"></p>
                
                <p class=""><b>Author:</b> <span class="app-author"></span></p>
                <p class=""><b>Version:</b> <span class="app-version"></span></p>
                <p class=""><b>Rating:</b> <span class="app-rating"></span></p>
                
              </div>
            </div>
          </div>
          <div class="webdesk_modal-footer">
            <span class="install-process"></span>
            <button type="button" class="webdesk_btn webdesk_btn-primary app-install-button" onclick="install_app();"><i class="fa fa-download fa-fw"></i> Install</button>
            <button type="button" class="webdesk_btn webdesk_btn-secondary" data-dismiss="webdesk_modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    
    <?php
    $can_open_market = true;
  }
}
if(!$can_open_market)
  echo "There was an error opening the market";

if($apps = opendir("Apps")){
  $files = array();
  while (($file = readdir($apps)) !== false) {
    
    if(!preg_match("/^.{1,2}$/",$file))
      $files[] = '"'.$file.'"';
    
  }
  ?>
  <script>
  var installed_apps = [<?php echo implode(",", $files); ?>];
  </script>
  <?php
}
?>
<script>
$(document).ready(function(){
  
  var $_GET = {};

  document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
    function decode(s) {
      return decodeURIComponent(s.split("+").join(" "));
    }

    $_GET[decode(arguments[1])] = decode(arguments[2]);
  });
  
  load_market();
  
  $("#searchForm").submit(function(){
    
    
    
    load_market(category,$(":input[name='search']",this).val());
    
    return false;
    
  });
  
  $("#load").hide();
});
function load_viewmore_modal(tapp){
  
  $('#viewAppMoreModal').attr("data-appid",tapp);
  $('#viewAppMoreModal .app-title').text(wd_market[tapp].app);
  
  $('#viewAppMoreModal .app-description').text("");
  if(wd_market[tapp].description != null)
    $('#viewAppMoreModal .app-description').text(wd_market[tapp].description);
  
  $('#viewAppMoreModal .app-author').text(wd_market[tapp].email);
  $('#viewAppMoreModal .app-version').text(wd_market[tapp].version);
  $('#viewAppMoreModal .app-category').text(wd_market[tapp].cat);
  $('#viewAppMoreModal .app-rating').text(wd_market[tapp].rate);
  
  $('#viewAppMoreModal .app-img').attr("src",wd_market[tapp].host + "/Pub/" + wd_market[tapp].app + "/ic.png");
  
  if(installed_apps.indexOf(tapp) > -1){
    $("#viewAppMoreModal .app-install-button").prop("disabled",true).removeClass("webdesk_btn-primary").addClass("webdesk_btn-secondary").html('<i class="fa fa-check fa-fw"></i> Installed');
  }
  else{
    $("#viewAppMoreModal .app-install-button").prop("disabled",false).addClass("webdesk_btn-primary").removeClass("webdesk_btn-secondary").html('<i class="fa fa-download fa-fw"></i> Install');
  }
  
  $('#viewAppMoreModal').modal('show');
  
}//load_viewmore_modal
var wd_market = {};
var category = "all";
function load_market(cat, search){
  
  if(cat == null)
    category = "all";
  else
    category = cat;
    
  if(search == null){
    search = "";
    $("#searchForm :input[name='search']").val("").css("width","1%");
  }
    
  $(".category-menu a").removeClass("webdesk_active");
  $("#cat-button-" + category).addClass("webdesk_active").append('<div class="webdesk_float-right loading-spinner"><i class="fa fa-spinner fa-pulse"></i></div>');
    
  $.getJSON("wd_market.json", function(result){
    
    if( (result != null) ){
      
      wd_market = result;
      
      $(".noapps").addClass("hide");
      
      $.each(result, function(i, data){
        
        var app_id = data.app.replace(" ", "_");
        
        if($("#app-" + app_id).length == 0)
          $(".marketApp-container .marketApp.template").clone().appendTo(".marketApp-container").removeClass("template hide").addClass("clone").attr("id","app-" + app_id).attr("data-appid",app_id);
        
        $("#app-" + app_id).each(function(j){
          
          $(this).addClass("hide");
          if( (category == data.cat) ||  (category == "all") )
            $(this).removeClass("hide");
          else if( (category == "my_apps") && (installed_apps.indexOf(data.app) > -1) )
            $(this).removeClass("hide");
            
          if( (search != "") && (data.app.toLowerCase().indexOf(search.toLowerCase()) < 0) )
            $(this).addClass("hide");
          
          $(".app-title",this).text(data.app);
          $(".app-developer",this).text(data.email);
          $(".app-description",this).text("");
          //$(".app-img",this).attr("src",data.host + "/Pub/" + data.app + "/ic.png");
          //$(".app-moreinfo-button",this).attr("href",'desktop.php?type=Apps&app=Market&sec=single.php&unit=' + data.app + '&www=' + data.host);
          
          if(data.description != null)
            $(".app-description",this).text(data.description);
            
          if(installed_apps.indexOf(data.app) > -1){
            $(".app-install-button",this).prop("disabled",true).removeClass("webdesk_btn-primary").addClass("webdesk_btn-secondary").html('<i class="fa fa-check fa-fw"></i> Installed');
          }
          $(".app-moreinfo-button",this).click(function(){
            
            load_viewmore_modal(data.app);
            
          });
          $(".app-install-button",this).click({tapp:data.app},function(e){
            
            install_app(e.data.tapp);
            
          });
          
          checkImage(data.host + "/Pub/" + data.app + "/ic.png", function(src, obj){ 
            
            $(".app-img",obj).attr("src",src);
            
          }, function(obj){ 
            
            //$(".app-img",obj).attr("src","Apps/Market/ic.png");
            
          }, this);
          
        });
        
      });
      if($(".marketApp-container .marketApp.clone:visible").length == 0){
        $(".noapps").removeClass("hide");
      }
      
    }
    
    $(".category-menu a .loading-spinner").remove();
    
  });
  
}//load_market
function install_app(tapp){
  
  if(tapp == null)
    tapp = $("#viewAppMoreModal").attr("data-appid");
    
  $("body").prop("tapp",tapp);
  
  $("#viewAppMoreModal .app-install-button,#app-" + tapp + " .app-install-button").html('<i class="fa fa-spinner fa-pulse fa-fw"></i> Hang on').prop("disabled",true);
  $("#viewAppMoreModal .install-process").text("Beginning installation");
  
  $.get("desktopSub.php", {type:"Apps",app:"Market", sec:"installSub.php",napp:tapp,www:wd_market[tapp].host},function(data){
    
    $("#viewAppMoreModal .install-process").text("Complete"); 
    $("#viewAppMoreModal .app-install-button,#app-" + $("body").prop("tapp") + " .app-install-button").removeClass("webdesk_btn-primary").addClass("webdesk_btn-success").html('<i class="fa fa-check fa-fw"></i> Installed').prop("disabled",true);
  });
  
}//install_app
</script>