<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; } ?>
<!--<nav class="navbar navbar-inverse">-->
<!--  <div class="container-fluid">-->
<!--    <div class="navbar-header">-->
<!--      <button type="button" class="navbar-toggle" data-toggle="webdesk_collapse" data-target="#myNavbar">-->
<!--        <span class="icon-bar"></span>-->
<!--        <span class="icon-bar"></span>-->
<!--        <span class="icon-bar"></span>-->
<!--      </button>-->
<!--      <a class="navbar-brand" href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>">Developer Portal: Apps</a>-->
<!--    </div>-->
<!--    <div class="webdesk_collapse navbar-collapse" id="myNavbar">-->
<!--      <ul class="nav navbar-nav">-->
<!--        <li><a href="desktop.php">Back</a></li>-->
<!--        <li class="active"><a href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>">Apps</a></li>-->
<!--        <li><a href="<?php wd_url($wd_type, $wd_app, 'startApl.php', ''); ?>">Applets</a></li>-->
<!--        <li><a href="<?php wd_url($wd_type, $wd_app, 'startTheme.php', ''); ?>">Themes</a></li>-->
<!--        <li><a href="<?php wd_url($wd_type, $wd_app, 'startGame.php', ''); ?>">Game</a></li>-->
<!--        <li><a href="<?php wd_url($wd_type, $wd_app, 'startHud.php', ''); ?>">HUD</a></li>-->
<!--        <li><a href="<?php wd_url($wd_type, $wd_app, 'startMhud.php', ''); ?>">MHUD</a></li>-->
<!--      </ul>-->
<!--      <ul class="nav navbar-nav navbar-right">-->
<!--		<li><a href="#" data-toggle="webdesk_collapse" data-target="#NewA">Create App</a></li>-->
<!--	  </ul>-->
<!--    </div>-->
<!--  </div>-->
<!--</nav>-->
<?php
include_once("config.inc.php");
include("appHeader.php");
?>
<nav class="webdesk_navbar webdesk_bg-light webdesk_border-top">
  <div class="">

		<button class="webdesk_btn webdesk_btn-light webdesk_shadow" data-toggle="webdesk_modal" data-target="#newProjectModal" type="button"><i class="fa fa-plus fa=fw"></i> New Project</button>

  </div>
</nav>
<div id="NewA" class="webdesk_collapse">
<form method="post" action="<?php wd_urlSub($wd_type, $wd_app, 'startSub.php', ''); ?>">
  <label for="nameA">New App Name: </label>
  <input type="text" name="nameA" for="nameA" class="form-control" placeholder="Enter the name of your new App." title="Enter the name of your new App.">
  <input type="submit" class="btn btn-success" value="Start">
</form>
</div>
<div class="webdesk_container webdesk_my-5">
	<?php
	$displayType = (!empty($req["displayType"])) ? $req["displayType"] : "MyApps";
	?>
	<h1><?php echo $wd_dt->getProjectTypeInfo($displayType)["name"]; ?></h1>
	<div class="webdesk_row app-listing">
	<?php
	$dt_my_apps = $wd_dt->getLocalProjects($displayType);
	foreach($dt_my_apps as $dt_app){
		
		$dt_app_img = (file_exists($dt_app["type"]."/".$dt_app["handle"]."/ic.png")) ? $dt_app["type"]."/".$dt_app["handle"]."/ic.png" : $wd_type."/".$wd_app."/ic.png";
		
		?>
		<div class="webdesk_col-md-4 webdesk_mb-3 app-card">
			<a href="<?php echo wd_url($wd_type,$wd_app,"projectfiles.php","&editType=" . $dt_app["type"] . "&editApp=" . $dt_app["handle"]); ?>">
				<div class="webdesk_card">
					<div class="webdesk_card-body webdesk_bg-light">
						<img src="<?php echo $dt_app_img ?>" class="webdesk_img" alt="" width="48" />
						<h4 class="webdesk_mt-3 webdesk_card-title"><?php echo $dt_app["name"] ?></h4>
						<small>
						<?php
						$count = array("file" => 0, "dir" => 0);
						$dh = opendir($dt_app["type"]."/".$dt_app["handle"]);
						while(($file = readdir($dh)) !== false){
							if( ($file != "..") && ($file != ".") ){
								$filetype = filetype($dt_app["type"]."/".$dt_app["handle"] . "/" . $file);
								$count[$filetype] ++;
							}
						}
						echo $count["file"] . " file" . (($count["file"] != 1) ? "s" : "");
						if($count["dir"] > 0)
							echo " and " . $count["dir"] . " director" . (($count["dir"] != 1) ? "ies" : "y");
						?>
						</small>
					</div>
					<?php
					if(!file_exists($dt_app["type"]."/".$dt_app["handle"]."/app.json")){
						?>
						<div class="webdesk_card-footer webdesk_bg-warning">
							<i class="fa fa-exclamation-triangle"></i> Missing app.json
						</div>
						<?php
					}
					if(!file_exists($dt_app["type"]."/".$dt_app["handle"]."/start.php")){
						?>
						<div class="webdesk_card-footer webdesk_bg-warning">
							<i class="fa fa-exclamation-triangle"></i> Missing start.php
						</div>
						<?php
					}
					?>
				</div>
			</a>
		</div>
		<?php
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