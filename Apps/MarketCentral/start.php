<?php
// start.php
// THIS IS THE DEFAULT PAGE FOR YOUR APP. REFER TO WD_FUNCTIONS FOR ENVIRONMENTAL VARIABLES.
//if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; } 
include_once("config.inc.php");
include("pageHeader.php");
?>
<div class="webdesk_container">
	<p class="webdesk_lead webdesk_py-5">
		This app handles requests for publishing apps and updating marketplace files.
	</p>
	<?php
	$result = $db->query("SELECT 1 FROM apps WHERE status='1'");
	?>
	<p>
		There are currently <b><?php echo $result->num_rows ?></b> registered apps
	</p>
	<p>
		Marketplace Download Location: <a href="http://market.webdesk.me/Apps/MarketCentral/wd_marketplace.json.php" target="_blank">http://market.webdesk.me/Apps/MarketCentral/wd_marketplace.json.php</a>
	</p>
</div>
<?php

// $apps = json_decode(file_get_contents("wd_market.json"),true);
// foreach($apps as $key => $app){
	
// 	$result = $db->query("SELECT * FROM categories WHERE cat_name='".$app["cat"]."'");
// 	if($result->num_rows == 0){
// 		$sql = "INSERT INTO categories (cat_name) VALUES ('".$app["cat"]."')";
// 		if(!$db->query($sql))
// 			echo $db->error;
// 		else{
// 			$cat["id"] = $db->insert_id;
// 		}
// 	}
// 	else
// 		$cat = $result->fetch_array(MYSQLI_ASSOC);
	
// 	$app_id = md5($app["app"].$app["email"].$app["host"]);
// 	$sql = "INSERT INTO apps (app_id, cat_id, app_name, app_path, app_email, app_host, app_version, app_rating, date_added, date_updated, status) VALUES ('$app_id', '".$cat["id"]."', '".$app["app"]."','Apps/".$app["app"]."','".$app["email"]."','".$app["host"]."','".$app["vr"]."', '".$app["rate"]."', '2016-01-01 00:00:00', '".date("Y-m-d H:i:s")."', '1')";
// 	if(!$db->query($sql))
// 		echo $db->error;
// }
?>