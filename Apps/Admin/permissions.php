<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
//_wf_backbutton(wd_url($wd_type, $wd_app, 'start.php', ''));
include_once("config.inc.php");
include("appHeader.php");
?>
<nav class="navbar border-top navbar-expand-md navbar-light bg-light">
  <a class="navbar-brand" href="<?php echo wd_url($wd_type, $wd_app, 'start.php', ''); ?>"><i class="fa fa-arrow-circle-left"></i> Permissions</a>

</nav>
<div class="row">
	<div class="col-md-3 p-5">
		<h3>Tiers</h3>
		<ul class="nav flex-column mb-5">
			
			<?php
			if(empty($req["tier"]) || ($req["tier"] < 1))
				$req["tier"] = 1;
			
			$tiers = $wf_admin->getSystemTiers();
			foreach($tiers as $tier => $tier_info){
				?>
				<li class="nav-item">
			    <a class="nav-link active <?php echo ($req["tier"] == $tier) ? "bg-secondary text-white" : "" ?>" href="<?php wd_url($wd_type, $wd_app, 'permissions.php', '&tier=' . $tier) ?>">Tier <?php echo $tier ?></a>
			  </li>
				
				<?php
			}
			
			if(count($tiers) == 0){
				?>
				<li class="nav-item my-3">
					You have no active tiers
				</li>
				<?php
			}
			?>
			
		</ul>
		<a class="btn btn-<?php echo (count($tiers) == 0) ? "primary" : "light"; ?>" href="<?php wd_urlSub($wd_type, $wd_app, 'permissionsSub.php', '&action=addTier&nextTier=' . (count($tiers) + 1)); ?>"><i class="fa fa-plus fa-fw"></i> Add Tier</a>
	</div>
	<div class="col my-5 p-5">
		<?php
		//if(file_exists($wd_admin . 't' . $req["tier"] . '.json')){
		if(!empty($req["tier"]) && isset($tiers[$req["tier"]])){
			//$Obj = json_decode(file_get_contents($wd_admin . 't' . $req["tier"] . '.json'));
			$Obj = $tiers[$req["tier"]];
			?>
			<form name="savePermissionsForm" action="<?php wd_urlSub($wd_type, $wd_app, 'permissionsSub.php', ''); ?>" method="POST">
				<input type="hidden" name="action" value="saveTier" />
				<input type="hidden" name="tier" value="<?php echo $req["tier"] ?>" />
				<div class="row border-bottom">
					<div class="col-sm-2 text-center">
						<i class="fa fa-5x fa-fw fa-columns"></i>
						<br />
						User Experience
					</div>
					<div class="col-sm-8 offset-sm-1">
						<div class="form-group row">
							<label for="HUD-option" class="col-sm-4 col-form-label">HUD</label>
							<div class="sm_8">
								<select id="HUD-option" name="HUD" class="custom-select">
									<?php
									if ($handle = opendir('HUD/')) {
										while (false !== ($entry = readdir($handle))) {
											if ($entry != "." && $entry != "..") {
											?>
											<option value="<?php echo $entry; ?>" <?php if(file_exists($wd_admin . 't' . $tier . '.json') && isset($Obj->HUD)){$test = $Obj->HUD; if($test == $entry){echo ' selected="selected"';}} ?>><?php echo $entry; ?></option>
											<?php
											}
										}
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="MHUD-option" class="col-sm-4 col-form-label">MHUD</label>
							<div class="sm_8">
								<select id="MHUD-option" name="MHUD" class="custom-select">
									<?php
									if ($handle = opendir('MHUD/')) {
										while (false !== ($entry = readdir($handle))) {
											if ($entry != "." && $entry != "..") {
											?>
											<option value="<?php echo $entry; ?>" <?php if(file_exists($wd_admin . 't' . $tier . '.json' && isset($Obj->MHUD))){$test = $Obj->MHUD; if($test == $entry){echo ' selected="selected"';}} ?>><?php echo $entry; ?></option>
											<?php
											}
										}
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="chat-option" class="col-sm-4 col-form-label">Chat</label>
							<div class="sm_8">
								
								<div class="custom-control custom-radio custom-control-inline">
								  <input type="radio" id="chat-option-Yes" name="wd_chat" class="custom-control-input" value="Yes" <?php echo (!empty($Obj->wd_chat) && ($Obj->wd_chat == "Yes") ) ? "checked" : ""; ?>>
								  <label class="custom-control-label" for="chat-option-Yes">On</label>
								</div>
								<div class="custom-control custom-radio custom-control-inline">
								  <input type="radio" id="chat-option-No" name="wd_chat" class="custom-control-input" value="No" <?php echo (empty($Obj->wd_chat) || ($Obj->wd_chat == "No") ) ? "checked" : ""; ?>>
								  <label class="custom-control-label" for="chat-option-No">Off</label>
								</div>
								
							</div>
						</div>
					</div>
				</div>
				
				<?php
				$step = 0;
				while($step < 2){
					if($step == 0)
						$dir = "Apps";
					else
						$dir = "MyApps";
					?>
					<div class="row border-bottom py-5">
						<div class="col-sm-2 text-center">
							<i class="fa fa-5x fa-fw fa-<?php echo ($step == 0) ? "shapes" : "object-group"; ?>"></i>
							<br />
							<?php echo ($step == 1) ? "My " : ""; ?> Apps
						</div>
						<div class="col-sm-8 offset-sm-1">
							<?php
							if ($handle = opendir($dir . '/')) {
		            while (false !== ($entry = readdir($handle))) {
		              
		              if ($entry != "." && $entry != "..") {
		              	
		              	if(file_exists($dir . "/" . $entry . "/app.json")){
		              		$this_app = json_decode(file_get_contents($dir . "/" . $entry . "/app.json"),true);
		              	}
		              	else
		              		$this_app["name"] = $entry;
		              	
		              	
		              	$entry = ($step == 1) ? "myApp_" . $entry : $entry;
		              	?>
		              	<div class="form-group row">
											<label for="app-<?php echo $entry ?>-option" class="col-sm-4 col-form-label"><?php echo $this_app["name"] ?></label>
											<div class="sm_8">
												<div class="custom-control custom-radio custom-control-inline">
												  <input type="radio" id="app-<?php echo $entry ?>-option-Yes" name="<?php echo $entry; ?>" class="custom-control-input" value="Yes" <?php echo (!empty($Obj->$entry) && ($Obj->$entry == "Yes") ) ? "checked" : ""; ?>>
												  <label class="custom-control-label" for="app-<?php echo $entry ?>-option-Yes">On</label>
												</div>
												<div class="custom-control custom-radio custom-control-inline">
												  <input type="radio" id="app-<?php echo $entry ?>-option-No" name="<?php echo $entry; ?>" class="custom-control-input" value="No" <?php echo (empty($Obj->$entry) || ($Obj->$entry == "No") ) ? "checked" : ""; ?>>
												  <label class="custom-control-label" for="app-<?php echo $entry ?>-option-No">Off</label>
												</div>
											</div>
										</div>
		              	<?php
		              	
		              }
		                
		            }
		                
							}
							?>
						</div>
						
					</div>
				
					<?php
					
					$step ++;
				}//while
				?>
				<div class="py-4">
					<button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> Save changes</button>
					<?php
					if(!file_exists($wd_admin . 't' . ($req["tier"] + 1) . '.json')){
						?>
						<a href="<?php wd_urlSub($wd_type, $wd_app, 'permissionsSub.php', '&action=removeTier&tier=' . $req["tier"]); ?>" class="btn btn-danger text-white"><i class="fa fa-trash fa-fw"></i> Remove tier</a>
						<?php
					}
					?>
					&nbsp;  
					There are <?php echo count($wf_admin->getUsers("t" . $req["tier"])); ?> users in this tier
				</div>
			</form>
			<?php
		}
		?>
	</div>
</div>
<?php
include("appFooter.php");
?>