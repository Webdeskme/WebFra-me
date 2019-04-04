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
	
	?>
	<div class="container">
		
		<form name="publishAppForm" class="mt-3">
			<input type="hidden" name="f" value="publishApp" />
			<input type="hidden" name="type" value="<?php echo $req["editType"] ?>" />
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
			
			<button type="submit" class="mt-4 btn btn-primary btn-lg btn-block">Publish App</button>
			
		</form>
		
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
// $( document ).ajaxError(function( event, request, settings ) {
//   console.error(request.responseText);
// });
// $("form").submit(function(){
	
// 	var formName = $(this).attr("name");
// 	var formVars = $(":input",this).serialize();
	
// 	$.post("Apps/MarketPublisher/wd_marketpublisher.ajax.json.php",formVars,function(data,textStatus){
		
// 		console.log(data);
		
// 		if(data.result != "success"){
			
// 			console.error(data.msg,data.error);
			
// 			if(data.highlightField != null){
				
// 				for(var x in data.highlightField){
					
// 					console.error("Highlight field " + data.highlightField[x],data.highlightMsg[x]);
					
// 					$(":input[name='" + data.highlightField[x] + "']").addClass("is-invalid").parent(".form-group").children(".invalid-feedback").html(data.highlightMsg[x]).show();
// 					$(":input[name='" + data.highlightField[x] + "']").keydown(function(){
// 						$(":input[name='" + data.highlightField[x] + "']").removeClass("is-invalid").parent(".form-group").children(".invalid-feedback").hide();
// 					});
					
// 				}
				
// 			}
			
// 		}
// 		else{
// 			window.history.go();
// 		}
		
// 	});
	
// 	return false;
	
// });
</script>