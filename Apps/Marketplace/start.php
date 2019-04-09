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
include("appHeader.php");

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
    <div class="mb-5 mt-3 p-3">
      <div class="row">
        <div class="col-md-2">
          <div class="sticky-top category-menu">
            <div class="list-group">
              <div class="list-group-item"><b>Categories</b></div>
              <a href="#" id="cat-button-all" class="list-group-item list-group-item-action active" onclick="marketplace.load_market();">All</a>
              <?php
              foreach($market2_categories as $market_category){
                ?>
                <a href="#" id="cat-button-<?php echo  $market_category ?>" class="list-group-item list-group-item-action" onclick="marketplace.load_market('<?php echo $market_category ?>');"><?php echo $market_category ?></a>
                <?php
              }
              ?>
              
            </div>
            <div class="list-group mt-3">
              <a href="#" id="cat-button-my_apps" class="list-group-item list-group-item-action" onclick="marketplace.load_market('my_apps');"><i class="fa fa-th-large fa-fw"></i> My Apps</a>
            </div>
          </div>
        </div>
        <div class="col pl-5">
          <div id="load" class="text-center position-absolute">
            <i class="fa fa-spinner fa-pulse fa-2x"></i>
            <span class="sr-only">Loading...</span>
          </div>
          <div id="updateFileWarning" class="alert alert-info alert-dismissable hide">
            There was an error in updating your local version of the market. 
            <a onclick="marketplace.updateMarketplaceFile();" class="btn btn-outline-secondary btn-sm">Update manually</a>
          </div>
          
          <div class="row marketApp-container">
            <div class="noapps hide text-muted p-3">
              No apps within search parameters
            </div>
            <div class="col-md-4 mb-3 marketApp template hide">
              
              
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                    
                      <img src="Apps/Terminal/ic.png" alt="" class="img-fluid mb-3 app-img" style="" />
                    
                    </div>
                    <div class="col">
                      <h5 class="card-title app-title">
                        Awesome App
                      </h5>
                      
                      <p class="">
                        <small class="app-description text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </small>
                      </p>
                      <p class="app-developer">
                        Developer: John Doe
                      </p>
                      
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="app-price float-right">
                    FREE
                  </div>
                  <button type="button" class="app-install-button btn btn-bloc btn-secondary text-white"><i class="fa fa-download fa-fw"></i> Install</button>
                    <button type="button" class="app-moreinfo-button btn btn-bloc btn-outline-secondary">More Info</button>
                </div>
              </div>
              
            </div>
          </div>
          
        </div>
      </div>
    </div>
    
    <div class="modal fade" id="viewAppMoreModal" tabindex="-1" role="dialog" aria-labelledby="viewAppMoreModalLabel" aria-hidden="true">
      <div class="modal-dialog  shadow-lg modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="viewAppMoreModalLabel">App Info</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-sm-3">
                <img src="Apps/Marketplace/ic.png" class="img-fluid app-img" alt="" />
                <p class="app-price text-center mt-2 lead">FREE</p>
              </div>
              <div class="col">
                <h1 class="app-title"></h1>
                <p><a href="#" class="app-category"></a></p>
                <p class="app-description text-mute"></p>
                
                <p class=""><b>Author:</b> <span class="app-author"></span></p>
                <p class=""><b>Version:</b> <span class="app-version"></span></p>
                <p class=""><b>Rating:</b> <span class="app-rating"></span></p>
                
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <span class="install-process"></span>
            <button type="button" class="btn btn-secondary app-install-button" onclick="marketplace.install_app();"><i class="fa fa-download fa-fw"></i> Install</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
  <div class="container py-5">
    <p class="lead">
      <i class="fa fa-spinner fa-pulse"></i> Your marketplace file is being prepared for the first time. Please hang tight.
    </p>
    <button id="marketplace_continue" class="hide btn btn-outline-secondary">Continue</button>
  </div>
  <?php
}
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
    $('#viewAppMoreModal .app-version').text(marketplace.wd_market[tapp].vr);
    $('#viewAppMoreModal .app-category').text(marketplace.wd_market[tapp].cat);
    $('#viewAppMoreModal .app-rating').text(marketplace.wd_market[tapp].rate);
    
    $('#viewAppMoreModal .app-img').attr("src",marketplace.wd_market[tapp].host + "/Pub/" + marketplace.wd_market[tapp].app + "/ic.png");
    
    if(marketplace.wd_market[tapp].is_installed){
      
      if(marketplace.wd_market[tapp].needs_update){
        $("#viewAppMoreModal .app-install-button").removeClass("btn-secondary").addClass("btn-success").html('<i class="fa fa-sync fa-fw"></i> Update').click({app_id:marketplace.wd_market[tapp].app_id},function(e){
      
          marketplace.install_app(e.data.app_id);
          
        });
      }
      else{
      
        $("#viewAppMoreModal .app-install-button").prop("disabled",true).removeClass("btn-primary").addClass("btn-secondary").html('<i class="fa fa-check fa-fw"></i> Installed');
        
      }
    }
    else{
      $("#viewAppMoreModal .app-install-button").prop("disabled",false).addClass("btn-primary").removeClass("btn-secondary").html('<i class="fa fa-download fa-fw"></i> Install');
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
      
    $(".category-menu a").removeClass("active");
    $("#cat-button-" + marketplace.category).addClass("active").append('<div class="float-right loading-spinner"><i class="fa fa-spinner fa-pulse"></i></div>');
    
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
                $(".app-install-button",this).removeClass("btn-secondary").addClass("btn-success").html('<i class="fa fa-sync fa-fw"></i> Update').click({app_id:data.app_id},function(e){
              
                  marketplace.install_app(e.data.app_id);
                  
                });
              }
              else{
                $(".app-install-button",this).prop("disabled",true).removeClass("btn-secondary").addClass("btn-secondary").html('<i class="fa fa-check fa-fw"></i> Installed');
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
        $("#viewAppMoreModal .app-install-button,#app-" + $("body").prop("app_id") + " .app-install-button").removeClass("btn-primary").addClass("btn-success").html('<i class="fa fa-check fa-fw"></i> Installed').prop("disabled",true);
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
              $(".app-install-button",this).removeClass("btn-secondary").addClass("btn-success").html('<i class="fa fa-sync fa-fw"></i> Update').click({app_id:data.app_id},function(e){
                
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