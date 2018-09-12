<?php
/*
////////////////////////////////////////////////////////////
//
// MARKETPLACE
// AUTHOR: ADAM TELFORD, ANDREW MCCALLISTER
//
// DESCRIPTION: THE PAGE THAT LISTS AND DISPLAYS
// MARKETPLACE APPS AVAILABLE FOR DOWNLOAD.
//
////////////////////////////////////////////////////////////
*/
if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
include("config.inc.php");
include("pageHeader.php");

$can_open_market = false;
if(file_exists($wd_type."/".$wd_app."/wd_marketplace.json")){
  $market2 = json_decode(@file_get_contents($wd_type."/".$wd_app."/wd_marketplace.json"),true);
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
              <a href="#" id="cat-button-all" class="webdesk_list-group-item webdesk_list-group-item-action webdesk_active" onclick="marketplace.load_market();">All</a>
              <?php
              foreach($market2_categories as $market_category){
                ?>
                <a href="#" id="cat-button-<?php echo  $market_category ?>" class="webdesk_list-group-item webdesk_list-group-item-action" onclick="marketplace.load_market('<?php echo $market_category ?>');"><?php echo $market_category ?></a>
                <?php
              }
              ?>
              
            </div>
            <div class="webdesk_list-group webdesk_mt-3">
              <a href="#" id="cat-button-my_apps" class="webdesk_list-group-item webdesk_list-group-item-action" onclick="marketplace.load_market('my_apps');"><i class="fa fa-th-large fa-fw"></i> My Apps</a>
            </div>
          </div>
        </div>
        <div class="webdesk_col">
          <div id="load" class="webdesk_text-center webdesk_position-absolute">
            <i class="fa fa-spinner fa-pulse fa-2x"></i>
            <span class="sr-only">Loading...</span>
          </div>
          <div id="updateFileWarning" class="webdesk_alert webdesk_alert-info webdesk_alert-dismissable hide">
            There was an error in updating your local version of the market. 
            <a onclick="marketplace.updateMarketplaceFile();" class="webdesk_btn webdesk_btn-outline-secondary webdesk_btn-sm">Update manually</a>
          </div>
          
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
                      
                      <p class="">
                        <small class="app-description webdesk_text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </small>
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
                  <button type="button" class="app-install-button webdesk_btn webdesk_btn-bloc webdesk_btn-secondary webdesk_text-white"><i class="fa fa-download fa-fw"></i> Install</button>
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
                <img src="Apps/Marketplace/ic.png" class="webdesk_img-fluid app-img" alt="" />
                <p class="app-price webdesk_text-center webdesk_mt-2 webdesk_lead">FREE</p>
              </div>
              <div class="webdesk_col">
                <h1 class="app-title"></h1>
                <p><a href="#" class="app-category"></a></p>
                <p class="app-description webdesk_text-mute"></p>
                
                <p class=""><b>Author:</b> <span class="app-author"></span></p>
                <p class=""><b>Version:</b> <span class="app-version"></span></p>
                <p class=""><b>Rating:</b> <span class="app-rating"></span></p>
                
              </div>
            </div>
          </div>
          <div class="webdesk_modal-footer">
            <span class="install-process"></span>
            <button type="button" class="webdesk_btn webdesk_btn-secondary app-install-button" onclick="marketplace.install_app();"><i class="fa fa-download fa-fw"></i> Install</button>
            <button type="button" class="webdesk_btn webdesk_btn-secondary" data-dismiss="webdesk_modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    
    <?php
    $can_open_market = true;
  }
}
if(!$can_open_market){
  ?>
  <div class="webdesk_container webdesk_py-5">
    <p class="webdesk_lead">
      <i class="fa fa-spinner fa-pulse"></i> Your marketplace file is being prepared for the first time. Please hang tight.
    </p>
    <button id="marketplace_continue" class="hide webdesk_btn webdesk_btn-outline-secondary">Continue</button>
  </div>
  <?php
}
/*
if($apps = opendir("Apps")){
  $files = array();
  $files_versions = array();
  while (($file = readdir($apps)) !== false) {
    
    if(!preg_match("/^.{1,2}$/",$file)){
    
      $files[$file] = array();
      if(file_exists("Apps/" . $file . "/app.json")){
        
        $app_json = file_get_contents("Apps/" . $file . "/app.json");
        $app_json = json_decode($app_json,true);
        $files[$file] = $app_json;
        
      }
      
    }
    
  }
  
  ?>
  <script>
  var installed_apps = [<?php echo json_encode($files); ?>];
  </script>
  <?php
}
*/
?>
<script>
$( document ).ajaxError(function( event, request, settings ) {
  console.error(request.responseText);
});
$(document).ready(function(){
  
  var $_GET = {};

  document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
    function decode(s) {
      return decodeURIComponent(s.split("+").join(" "));
    }

    $_GET[decode(arguments[1])] = decode(arguments[2]);
  });
  
  marketplace.updateMarketplaceFile();
  //marketplace.load_market();
  
  $("#searchForm").submit(function(){
    
    marketplace.load_market(marketplace.category,$(":input[name='search']",this).val());
    
    return false;
    
  });
  
  $("#load").hide();
});

var marketplace = {
  
  wd_market: {},
  category: "all",
  load_viewmore_modal: function (tapp){
    
    $('#viewAppMoreModal').attr("data-appid",tapp);
    $('#viewAppMoreModal .app-title').text(marketplace.wd_market[tapp].app);
    
    $('#viewAppMoreModal .app-description').text("");
    if(marketplace.wd_market[tapp].description != null)
      $('#viewAppMoreModal .app-description').text(marketplace.wd_market[tapp].description);
    
    $('#viewAppMoreModal .app-author').text(marketplace.wd_market[tapp].email);
    $('#viewAppMoreModal .app-version').text(marketplace.wd_market[tapp].version);
    $('#viewAppMoreModal .app-category').text(marketplace.wd_market[tapp].cat);
    $('#viewAppMoreModal .app-rating').text(marketplace.wd_market[tapp].rate);
    
    $('#viewAppMoreModal .app-img').attr("src",marketplace.wd_market[tapp].host + "/Pub/" + marketplace.wd_market[tapp].app + "/ic.png");
    
    if(marketplace.wd_market[tapp].is_installed){
      
      if(marketplace.wd_market[tapp].needs_update){
        $("#viewAppMoreModal .app-install-button").removeClass("webdesk_btn-secondary").addClass("webdesk_btn-success").html('<i class="fa fa-sync fa-fw"></i> Update').click({app_id:marketplace.wd_market[tapp].app_id},function(e){
      
          marketplace.install_app(e.data.app_id);
          
        });
      }
      else{
      
        $("#viewAppMoreModal .app-install-button").prop("disabled",true).removeClass("webdesk_btn-primary").addClass("webdesk_btn-secondary").html('<i class="fa fa-check fa-fw"></i> Installed');
        
      }
    }
    else{
      $("#viewAppMoreModal .app-install-button").prop("disabled",false).addClass("webdesk_btn-primary").removeClass("webdesk_btn-secondary").html('<i class="fa fa-download fa-fw"></i> Install');
    }
    
    $('#viewAppMoreModal').modal('show');
    
  },//load_viewmore_modal
  load_market: function (cat, search){
  
    if(cat == null)
      marketplace.category = "all";
    else
      marketplace.category = cat;
      
    if(search == null){
      search = "";
      $("#searchForm :input[name='search']").val("").css("width","1%");
    }
      
    $(".category-menu a").removeClass("webdesk_active");
    $("#cat-button-" + marketplace.category).addClass("webdesk_active").append('<div class="webdesk_float-right loading-spinner"><i class="fa fa-spinner fa-pulse"></i></div>');
    
    $.getJSON("<?php echo $wd_type."/".$wd_app ?>/marketplace.ajax.json.php", 'f=openMarketJson', function(result){
      
      if( (result != null) ){
        
        marketplace.wd_market = result.data.marketplace;
        console.log(result.data.marketplace);
        $(".noapps").addClass("hide");
        
        $.each(result.data.marketplace, function(i, data){
          
          var app_id = data.app_id;
          
          if($("#app-" + app_id).length == 0)
            $(".marketApp-container .marketApp.template").clone().appendTo(".marketApp-container").removeClass("template hide").addClass("clone").attr("id","app-" + app_id).attr("data-appid",app_id);
          
          $("#app-" + app_id).each(function(j){
            
            $(this).addClass("hide");
            if( (marketplace.category == data.cat) ||  (marketplace.category == "all") )
              $(this).removeClass("hide");
            else if( (marketplace.category == "my_apps") && (installed_apps.indexOf(data.app) > -1) )
              $(this).removeClass("hide");
              
            if( (search != "") && (data.app.toLowerCase().indexOf(search.toLowerCase()) < 0) )
              $(this).addClass("hide");
            
            $(".app-title",this).text(data.app);
            $(".app-developer",this).text(data.email);
            $(".app-description",this).text("");
            $(".app-img",this).attr("src",data.icon);
            
            if(data.description != null)
              $(".app-description",this).text(data.description);
            
            if(data.is_installed){
              
              if(data.needs_update){
                console.log(data.app + " needs update");
                $(".app-install-button",this).removeClass("webdesk_btn-secondary").addClass("webdesk_btn-success").html('<i class="fa fa-sync fa-fw"></i> Update').click({app_id:data.app_id},function(e){
              
                  marketplace.install_app(e.data.app_id);
                  
                });
              }
              else{
                $(".app-install-button",this).prop("disabled",true).removeClass("webdesk_btn-secondary").addClass("webdesk_btn-secondary").html('<i class="fa fa-check fa-fw"></i> Installed');
              }
            }
            else{
              $(".app-install-button",this).click({tapp:data.app_id},function(e){
              
                marketplace.install_app(e.data.tapp);
                
              });
            }
            $(".app-moreinfo-button",this).click(function(){
              
              marketplace.load_viewmore_modal(data.app_id);
              
            });
            
            // marketplace.checkImage(data.host + "/Pub/" + data.app + "/ic.png", function(src, obj){ 
              
            //   $(".app-img",obj).attr("src",src);
              
            // }, function(obj){ 
              
            //   //$(".app-img",obj).attr("src","Apps/Market/ic.png");
              
            // }, this);
            
          });
          
        });
        if($(".marketApp-container .marketApp.clone:visible").length == 0){
          $(".noapps").removeClass("hide");
        }
        
      }
      
      $(".category-menu a .loading-spinner").remove();
      
      marketplace.checkWFVersion();
      
    });
    
  },//load_market
  install_app: function (app_id){
  
    if(app_id == null)
      app_id = $("#viewAppMoreModal").attr("data-appid");
      
    $("body").prop("app_id",app_id);
    
    $("#viewAppMoreModal .app-install-button,#app-" + app_id + " .app-install-button").html('<i class="fa fa-spinner fa-pulse fa-fw"></i> Hang on').prop("disabled",true);
    $("#viewAppMoreModal .install-process").text("Beginning installation");
    
    $.get("<?php echo $wd_type."/".$wd_app ?>/marketplace.ajax.json.php", {f: "installApp", appId: app_id},function(data){
      console.log(data);
      if(data.result != "success"){
        console.error(data.msg);
      }
      else{
        $("#viewAppMoreModal .install-process").text("Complete"); 
        $("#viewAppMoreModal .app-install-button,#app-" + $("body").prop("app_id") + " .app-install-button").removeClass("webdesk_btn-primary").addClass("webdesk_btn-success").html('<i class="fa fa-check fa-fw"></i> Installed').prop("disabled",true);
      }
    });
    
  },//install_app
  checkImage: function (imageSrc, good, bad, context) {
    var img = new Image();
    img.onload = good(imageSrc, context); 
    img.onerror = bad(context);
    img.src = imageSrc;
  },
  updateMarketplaceFile: function(){
    
    console.log("Updating Marketplace file");
    $("#updateFileWarning a").html('<i class="fa fa-spinner fa-pulse"></i>');
    $.get("<?php echo $wd_type."/".$wd_app ?>/marketplace.ajax.json.php",{f: "updateMarketJson"},function(data,textStatus){
      
      if(data.result != "success"){
        console.error(data.msg);
        $("#updateFileWarning").show();
        
      }
      else{
        
        console.info("Local marketplace file updated successfully");
        $("#updateFileWarning").hide();
        marketplace.load_market();
        $("#marketplace_continue").show();
        if($("#marketplace_continue").length > 0)
          setTimeout("window.history.go();",3000);
          
        
      }
      
      $("#updateFileWarning a").html("Update manually");
      
    });
    
  },//updateMarketplaceFile
  checkWFVersion: function(){
    
    console.log("Checking Webdesk version");
    $.get("<?php echo $wd_type."/".$wd_app ?>/marketplace.ajax.json.php",{f: "checkWFVersion"},function(data,textStatus){
      
      if(data.result != "success"){
        console.error(data.msg);
      }
      else{
        
        if(data.data.update_required){
          
          if($("#app-webdesk").length == 0){
            $(".marketApp-container .marketApp.template").clone().prependTo(".marketApp-container").removeClass("template hide").addClass("clone").attr("id","app-webdesk").attr("data-appid","webdesk");
            $("#app-webdesk").each(function(j){
              
              $(".app-title",this).text("Webframe");
              $(".app-developer",this).text("info@webfra.me");
              $(".app-description",this).html("A new version of Webframe is available&mdash;" + data.data.version);
              $(".app-img",this).attr("src","<?php echo $wd_type."/".$wd_app ?>/assets/Webframe_Logo.png");
              $(".app-install-button",this).removeClass("webdesk_btn-secondary").addClass("webdesk_btn-success").html('<i class="fa fa-sync fa-fw"></i> Update').click({app_id:data.app_id},function(e){
                
                //marketplace.install_app(e.data.app_id);
                document.location = "//" + document.location.host + "/updater.php";
                
              });
              
            });
          }
          
        }
        
      }
      
    });
    
  }//checkWDVersion
  
};

</script>