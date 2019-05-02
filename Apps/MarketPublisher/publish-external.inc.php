<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; } 
include_once("Apps/MarketPublisher/config.inc.php");

if(!empty($wd_app) && ($wd_app == "MarketPublisher")){
	?>
	<p>
		This page is accessed from external applications, not from the Marketplace Publisher app
	</p>
	<?php
}
else if(empty($req["editType"]) || empty($req["editApp"])){
	?>
	<p>
		A <code>editType</code> and <code>editApp</code> must be supplied to this page.
	</p>
	<?php
}
else if($wd_marketpublisher->get_user_token()){
	
	$app_info = array();
	if(file_exists($req["editType"]."/".$req["editApp"]."/app.json")){
		$app_info = json_decode(file_get_contents($req["editType"]."/".$req["editApp"]."/app.json"),true);
	}
	
	$user_published_apps = $wd_marketpublisher->get_published_apps();
	
	?>
	<div id="pendingPublish" class="container">
		
		<form name="publishApp" method="post" action="Apps/MarketPublisher/wd_marketpublisher.ajax.json.php">
			
			<div class="text-center formMessage d-none">
				<div class="alert alert-warning" role="alert">
				  A simple warning alert—check it out!
				</div>
			</div>
			
			<p class="mt-2 mb-2 text-muted">
				This form will allow you to push your app to the Webframe marketplace for others to download.
			</p>
			<hr />
			<input type="hidden" name="f" value="publishApp" />
			<input type="hidden" name="type" value="<?php echo $req["editType"] ?>" />
		
			<div class="row mt-4">
				<div class="col-sm-2 text-right">
					<div class="custom-control custom-radio">
						<input type="radio" name="publishApp" id="publishApp-existing" value="existing" class="custom-control-input" onchange="$('#publishNewAppCollapse').collapse('hide');" <?php echo (count($user_published_apps) > 0) ? "checked" : ""; ?> />
						 <label class="custom-control-label" for="publishApp-existing"></label>
					</div>
				</div>
				<div class="col">
					<div class="form-group">
				    <label for="publishApp-existing" class=""><b>Publish to existing app</b></label>
						<select name="existingapp" id="existingapp" class="custom-select">
							<option value="0">-- Select app --</option>
							<?php
							foreach($user_published_apps as $key => $thisapp){
								?>
								<option value="<?php echo $thisapp["app_id"] ?>" <?php echo (!empty($app_info["app_id"]) && ($thisapp["app_id"] == $app_info["app_id"])) ? "selected" : ""; ?>><?php echo $thisapp["app_name"] ?></option>
								<?php
							}
							?>
						</select>
				  </div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-2 text-right">
					<div class="custom-control custom-radio">
						<input type="radio" name="publishApp" id="publishApp-new" value="new" class="custom-control-input" onchange="$('#publishNewAppCollapse').collapse('show');" <?php echo (count($user_published_apps) == 0) ? "checked" : ""; ?> />
						<label class="custom-control-label" for="publishApp-new"></label>
					</div>
				</div>
				<div class="col">
					
				  <label for="publishApp-new" class=""><b>Create a new app</b></label>
				  
				  <div class="collapse <?php echo (count($user_published_apps) > 0) ? "hide" : "show"; ?>" id="publishNewAppCollapse">
						<input type="hidden" name="app" value="<?php echo $req["editApp"] ?>" />
						<input type="hidden" name="appId" value="<?php echo (!empty($app_info["app_id"])) ? $app_info["app_id"] : "new" ?>" />
						<input type="hidden" name="appHost" value="<?php echo $_SERVER["HTTP_HOST"] ?>" />
						<div class="form-group">
							<label for="app_name">App Name</label>
							<input type="text" name="app_name" class="form-control" value="<?php echo (!empty($app_info["name"])) ? $app_info["name"] : $wd_app ?>" id="app_name" />
							<small class="text-muted">Required</small>
							<div class="invalid-feedback"></div>
						</div>
						<div class="form-group">
							<label for="app_description">Description</label>
							<textarea rows="3" name="app_description" class="form-control" id="app_description"><?php echo (!empty($app_info["description"])) ? $app_info["description"] : "" ?></textarea>
							<small class="text-muted">Required</small>
							<div class="invalid-feedback"></div>
						</div>
						<div class="form-group">
							<label for="app_ver">Version</label>
							<input type="text" name="app_ver" class="form-control" value="<?php echo (!empty($app_info["version"])) ? $app_info["version"] : $wd_app ?>" id="app_ver" />
							<small class="text-muted">Required</small>
							<div class="invalid-feedback"></div>
						</div>
						<div class="form-group">
							<label for="app_category">Category</label>
							<select name="app_category" id="app_category" class="custom-select">
								<?php
								if(file_exists("Apps/Marketplace/wd_marketplace.json")){
								  $market2 = json_decode(@file_get_contents("Apps/Marketplace/wd_marketplace.json"),true);
								  if(is_array($market2)){
								    
								    $market2_categories = array();
								    foreach($market2 as $market_app){
								      $cat = $market_app["cat"];
								      if(!in_array($cat, $market2_categories))
								        $market2_categories[] = $cat;
								    }
								    sort($market2_categories);
								    foreach($market2_categories as $category){
								    	?>
								    	<option><?php echo $category ?></option>
								    	<?php
								    }
								  }
								}
			    		?>
							</select>
							<div class="invalid-feedback"></div>
						</div>
						<div class="form-group">
							<label for="app_rate">Rating</label>
							<select name="app_rate" id="app_rate" class="custom-select">
								<option>Everyone</option>
								<option>Teen</option>
								<option>Mature</option>
							</select>
							<div class="invalid-feedback"></div>
						</div>
						
					</div><!-- //.collapse -->
				
				  
				</div>
			</div>
			
			<div class="mt-4 text-center">
				<button type="submit" class="btn btn-primary">Publish App</button>
			</div>
			
		</form>
		
	</div>
	<div class="container d-none" id="publishSuccessful">
		<h1>Hooray!</h1>
		<p class="lead">
			Your app has been successfully published to the Webframe Marketplace.
		</p>
		<button type="button" class="btn btn-primary mt-4" data-dismiss="modal">Close</button>
	</div>
	
	<?php
	
}
else{
	?>
	<div class="container text-center my-5">
		
		<button class="btn btn-primary shadow-sm border" onclick="window.open('<?php echo $wd_marketpublisher->publisher_oauth_url ?>','_blank','width=800,height=600,scrollbars=yes,resizeable=yes');"><img src="Apps/MarketPublisher/assets/Logo.png" alt="" class="img" style="max-width: 24px;" /> Connect to Webdesk Publisher</button>
		<br />
		<div class="mt-2">
			<small>You must have a Webdesk Publisher&apos;s account before you publish.</small>
		</div>
	</div>
	<?php
}
?>
<script type="text/javascript">
$( document ).ajaxError(function( event, request, settings ) {
  console.error(request.responseText);
});

  
$("#publishAppModal form[name='publishApp']").submit(function(){
	
	var formVars = $(":input",this).serialize();
	
	$.post("Apps/MarketPublisher/wd_marketpublisher.ajax.json.php",formVars,function(data,textStatus){
		
		console.log(data);
		
		if(data.result != "success"){
			
			console.error(data.msg,data.error);
			
			if(data.highlightField != null){
				
				for(var x in data.highlightField){
					
					console.error("Highlight field " + data.highlightField[x],data.highlightMsg[x]);
					
					$(":input[name='" + data.highlightField[x] + "']").addClass("is-invalid").parent(".form-group").children(".invalid-feedback").html(data.highlightMsg[x]).show();
					$(":input[name='" + data.highlightField[x] + "']").keydown(function(){
						$(":input[name='" + data.highlightField[x] + "']").removeClass("is-invalid").parent(".form-group").children(".invalid-feedback").hide();
					});
					
				}
				
			}
			if(data.msg != null){
				
				$("#publishAppModal form[name='publishApp'] .formMessage .alert").html(data.msg);
				$("#publishAppModal form[name='publishApp'] .formMessage").removeClass("d-none");
				
			}
			
		}
		else{
			
			$("#publishSuccessful").removeClass("d-none");
			$("#pendingPublish").addClass("d-none");
			
		}
		
	});
	
	return false;
	
});
</script>