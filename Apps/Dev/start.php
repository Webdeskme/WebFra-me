<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }

include_once("config.inc.php");
include("appHeader.php");
?>
<nav class="navbar bg-light border-top">

	<button class="btn btn-light shadow" data-toggle="modal" data-target="#newProjectModal" type="button"><i class="fa fa-plus fa=fw"></i> New Project</button>

</nav>
<div class="container my-5">
	<?php
	$displayType = (!empty($req["displayType"])) ? $req["displayType"] : "MyApps";
	?>
	<h1><?php echo $wd_dt->getProjectTypeInfo($displayType)["name"]; ?></h1>
	<div class="row app-listing">
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
			<div class="col-md-4 mb-3 col-6 app-card">
				<a href="<?php echo (!empty($click_link)) ? $click_link : wd_url($wd_type,$wd_app,"projectfiles.php","&editType=" . $dt_app["type"] . "&editApp=" . $dt_app["handle"]) ?>">
					<div class="card text-center text-md-left">
						<div class="card-body bg-light">
							<img src="<?php echo $dt_app["icon"] ?>" class="img" alt="" width="48" />
							<h4 class="mt-3 card-title d-none d-md-block"><?php echo $dt_app["name"] ?></h4>
							<b class="d-md-none mt-3 card-title"><?php echo $dt_app["name"] ?></b>
							<small class="d-none d-md-inline">
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
								<div class="card-footer bg-warning">
									<i class="fa fa-exclamation-triangle"></i> Missing app.json
								</div>
								<?php
							}
							else{
								if(!is_array($app_info)){
									?>
									<div class="card-footer bg-warning">
										<i class="fa fa-exclamation-triangle"></i> Malformatted app.json
									</div>
									<?php
								}
								else if(empty($app_info["version"])){
									?>
									<div class="card-footer bg-warning">
										<i class="fa fa-exclamation-triangle"></i> Mission version in app.json
									</div>
									<?php
								}
							}
							if(!file_exists($dt_app["type"]."/".$dt_app["handle"]."/start.php")){
								?>
								<div class="card-footer bg-warning">
									<i class="fa fa-exclamation-triangle"></i> Missing start.php
								</div>
								<?php
							}
							if(!file_exists($dt_app["type"]."/".$dt_app["handle"]."/header.php")){
								?>
								<div class="card-footer bg-warning">
									<i class="fa fa-exclamation-triangle"></i> Missing header.php
								</div>
								<?php
							}
							if(!file_exists($dt_app["type"]."/".$dt_app["handle"]."/ic.png")){
								?>
								<div class="card-footer bg-warning">
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
		<div class="col text-center text-muted py-5">
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