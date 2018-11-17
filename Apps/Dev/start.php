<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }

include_once("config.inc.php");
include("appHeader.php");
?>
<nav class="webdesk_navbar webdesk_bg-light webdesk_border-top">

	<button class="webdesk_btn webdesk_btn-light webdesk_shadow" data-toggle="webdesk_modal" data-target="#newProjectModal" type="button"><i class="fa fa-plus fa=fw"></i> New Project</button>

</nav>
<div class="webdesk_container webdesk_my-5">
	<?php
	$displayType = (!empty($req["displayType"])) ? $req["displayType"] : "MyApps";
	?>
	<h1><?php echo $wd_dt->getProjectTypeInfo($displayType)["name"]; ?></h1>
	<div class="webdesk_row app-listing">
	<?php
	$dt_my_apps = $wd_dt->getLocalProjects($displayType);
	
	foreach($dt_my_apps as $dt_app){
		
		$display = true;
		
		if(!empty($dt_app["require"])){
			$counting_require = 0;
			foreach($dt_app["require"] as $require_app => $require_version){
				
				if($require_app == "AppEngine"){
					$display = false;
				}
					
			}
		}
		if($display){
			?>
			<div class="webdesk_col-md-4 webdesk_mb-3 webdesk_col-6 app-card">
				<a href="<?php echo (!empty($click_link)) ? $click_link : wd_url($wd_type,$wd_app,"projectfiles.php","&editType=" . $dt_app["type"] . "&editApp=" . $dt_app["handle"]) ?>">
					<div class="webdesk_card webdesk_text-center webdesk_text-md-left">
						<div class="webdesk_card-body webdesk_bg-light">
							<img src="<?php echo $dt_app["icon"] ?>" class="webdesk_img" alt="" width="48" />
							<h4 class="webdesk_mt-3 webdesk_card-title webdesk_d-none webdesk_d-md-block"><?php echo $dt_app["name"] ?></h4>
							<b class="webdesk_d-md-none webdesk_mt-3 webdesk_card-title"><?php echo $dt_app["name"] ?></b>
							<small class="webdesk_d-none webdesk_d-md-inline">
								<?php
								$count = array("file" => 0, "dir" => 0);
								$files = $wd_dt->getProjectFiles($dt_app["type"]."/".$dt_app["handle"]);
								foreach($files as $key => $file){
									$count[$file["type"]] ++;
								}
								echo $count["file"] . " file" . (($count["file"] != 1) ? "s" : "");
								if($count["dir"] > 0)
									echo " and " . $count["dir"] . " director" . (($count["dir"] != 1) ? "ies" : "y");
								?>
							</small>
						</div>
						<?php
						if($displayType == "MyApps"){
							if(!file_exists($dt_app["type"]."/".$dt_app["handle"]."/app.json")){
								?>
								<div class="webdesk_card-footer webdesk_bg-warning">
									<i class="fa fa-exclamation-triangle"></i> Missing app.json
								</div>
								<?php
							}
							else{
								if(!is_array($app_info)){
									?>
									<div class="webdesk_card-footer webdesk_bg-warning">
										<i class="fa fa-exclamation-triangle"></i> Malformatted app.json
									</div>
									<?php
								}
								else if(empty($app_info["version"])){
									?>
									<div class="webdesk_card-footer webdesk_bg-warning">
										<i class="fa fa-exclamation-triangle"></i> Mission version in app.json
									</div>
									<?php
								}
							}
							if(!file_exists($dt_app["type"]."/".$dt_app["handle"]."/start.php")){
								?>
								<div class="webdesk_card-footer webdesk_bg-warning">
									<i class="fa fa-exclamation-triangle"></i> Missing start.php
								</div>
								<?php
							}
							if(!file_exists($dt_app["type"]."/".$dt_app["handle"]."/header.php")){
								?>
								<div class="webdesk_card-footer webdesk_bg-warning">
									<i class="fa fa-exclamation-triangle"></i> Missing header.php
								</div>
								<?php
							}
							if(!file_exists($dt_app["type"]."/".$dt_app["handle"]."/ic.png")){
								?>
								<div class="webdesk_card-footer webdesk_bg-warning">
									<i class="fa fa-exclamation-triangle"></i> Missing icon
								</div>
								<?php
							}
						}
						?>
					</div>
				</a>
			</div>
			<?php
		}
	}
	if(count($dt_my_apps) == 0){
		?>
		<div class="webdesk_col webdesk_text-center webdesk_text-muted webdesk_py-5">
			You don&apos;t have any projects under this category
		</div>
		<?php
	}
	?>
	</div>
</div>
<?php
include("appFooter.php");
?>