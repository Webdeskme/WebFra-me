<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; } 
include_once("config.inc.php");

if(file_exists($wd_appFile."MarketPublisher/auth_token.json")){
	$token_info = json_decode(file_get_contents($wd_appFile."MarketPublisher/auth_token.json"),true);
}

if(!empty($wd_app) && ($wd_app == "MarketPublisher")){
	?>
	<p>
		This page is accessed from external applications, not from the Marketplace Publisher app
	</p>
	<?php
}
else if(isset($token_info) && is_array($token_info) && !empty($token_info["token"])){
	
	$app_info = array();
	if(file_exists($req["editType"]."/".$req["editApp"]."/app.json")){
		$app_info = json_decode(file_get_contents($req["editType"]."/".$req["editApp"]."/app.json"),true);
	}
	
	?>
	<div class="webdesk_container">
		
		
		<form name="publishAppForm" class="webdesk_mt-3">
			
			<div class="webdesk_form-group">
				<label for="app_name">App Name</label>
				<input type="text" name="app_name" class="webdesk_form-control" value="<?php echo (!empty($app_info["name"])) ? $app_info["name"] : $wd_app ?>" id="app_name" />
				<small class="webdesk_text-muted">Required</small>
			</div>
			<div class="webdesk_form-group">
				<label for="app_description">Description</label>
				<textarea rows="3" name="app_description" class="webdesk_form-control" id="app_description"><?php echo (!empty($app_info["description"])) ? $app_info["description"] : "" ?></textarea>
				<small class="webdesk_text-muted">Required</small>
			</div>
			<div class="webdesk_form-group">
				<label for="app_ver">Version</label>
				<input type="text" name="app_ver" class="webdesk_form-control" value="<?php echo (!empty($app_info["version"])) ? $app_info["version"] : $wd_app ?>" id="app_ver" />
				<small class="webdesk_text-muted">Required</small>
			</div>
			<div class="webdesk_form-group">
				<label for="app_category">Category</label>
				<select name="app_category" id="app_category" class="webdesk_custom-select">
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
			</div>
			<div class="webdesk_form-group">
				<label for="app_rate">Rating</label>
				<select name="app_rate" id="app_rate" class="webdesk_custom-select">
					<option>Everyone</option>
					<option>Teen</option>
					<option>Mature</option>
				</select>
			</div>
			
			<button type="submit" class="webdesk_btn webdesk_btn-primary webdesk_btn-lg webdesk_btn-block">Publish App</button>
			
		</form>
		
	</div>
	<?php
	
}
else{
	?>
	<div class="webdesk_container webdesk_text-center">
		
		<button class="webdesk_btn webdesk_btn-light webdesk_shadow-sm webdesk_border" onclick="window.open('<?php echo $wd_marketpublisher->publisher_oauth_url ?>','_blank','width=800,height=600,scrollbars=yes,resizeable=yes');"><img src="Apps/MarketPublisher/assets/Webdesk_Logo.png" alt="" class="webdesk_img" style="max-width: 24px;" /> Connect to Webdesk Publisher</button>
		<br />
		<div class="webdesk_mt-2">
			<small>You must have a Webdesk Publisher&apos;s account before you publish.</small>
		</div>
	</div>
	<?php
}
?>