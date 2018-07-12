<?php 
/*
////////////////////////////////////////////////////////////
//
// START
// AUTHOR: ANDREW MCCALLISTER
//
// DESCRIPTION: LISTS THE INDIVIDUAL PROEJCTS BY THE 
// USER AND ORGANIZATION. DISPLAYS A DASHBOARD IF
// THERE ARE NO PROJECTS.
//
////////////////////////////////////////////////////////////
*/
if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
include_once("config.inc.php");
include("pageHeader.php");

$dt_my_apps = $wd_dt->getLocalProjects();

?>

<div class="webdesk_container webdesk_mt-4 <?php echo (count($dt_my_apps) > 0) ? "hide" : "" ?>" id="dt_dashboard">
	<div class="webdesk_row">
		<?php
		foreach($wd_dt->create_types as $dt_type){
			
			?>
			<div class="webdesk_col-md-4 webdesk_mb-3">
				<a href="#">
					<div class="webdesk_card">
						<div class="webdesk_card-body">
							<i class="fa fa-<?php echo $dt_type["icon"] ?> fa-fw fa-3x"></i>
							<h4 class="webdesk_mt-3 webdesk_card-title">Create <?php echo $dt_type["name"] ?></h4>
							<p><?php echo $dt_type["blurb"] ?></p>
						</div>
					</div>
				</a>
			</div>
			<?php
		}
		?>
	</div>
</div>
<div class="webdesk_container">
	<h1>My Projects</h1>
	<div class="webdesk_row app-listing">
	<?php
	foreach($dt_my_apps as $dt_app){
		
		$dt_app_img = (file_exists($dt_app["type"]."/".$dt_app["handle"]."/ic.png")) ? $dt_app["type"]."/".$dt_app["handle"]."/ic.png" : $wd_type."/".$wd_app."/ic.png";
		
		?>
		<div class="webdesk_col-md-4 webdesk_mb-3 app-card">
			<a href="<?php echo wd_url($wd_type,$wd_app,"projectEditor.php","&editType=" . $dt_app["type"] . "&editApp=" . $dt_app["handle"]); ?>">
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
					?>
				</div>
			</a>
		</div>
		<?php
	}
	?>
	</div>
</div>
<script type="text/javascript">
var devTools = {
	
	remove_characters: function(the_string){
		
		return the_string.replace(/[\-\.\\\"\'\s]/g,"");
		
	},
	createProject: function(form){
		
		var projectName = $("#new_project_name").val();
		
		console.log("Creating new project titled " + projectName);
		
		var formVars = $(form).serialize();
		console.log(formVars);
		$.post("<?php echo $wd_type."/".$wd_app ?>/devTools.ajax.json.php", formVars + "&f=createProject", function(data, textStatus){
			
			if(data.result != "success")
				console.error(data.msg);
			else{
				
				window.location = "//<?php echo $_SERVER["HTTP_HOST"] ?>/desktop.php?type=<?php echo $wd_type ?>&app=<?php echo $wd_app ?>&sec=projectEditor.php&editType=" + data.data.project.type + "&editApp=" + data.data.project.path;
				
			}
			
		});
		
		
			
	}
	
};
</script>