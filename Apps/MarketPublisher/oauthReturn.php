<?php
if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; } 
include_once("config.inc.php");

if(empty($req["code"])){
	?>
	<div class="webdesk_alert webdesk_alert-danger">
		You are missing a <code>code</code> parameter in your request.
	</div>
	<?php
}else{
	
	//echo $req["code"];

	$post_fields = array(
		"code" => $req["code"],
		"method" => "getOauthToken",
		"client" => $_SERVER["HTTP_HOST"]
	);
	ksort($post_fields);
	foreach($post_fields as $key => $value){
		$temp[] = $key."=".$value;
	}
	$post_fields["auth"] = md5(implode("",$temp));

	$ch = curl_init();
	
	curl_setopt($ch, CURLOPT_URL, $wd_marketpublisher->get_publisher_api_url());
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
	
	$output = curl_exec($ch);
	if($output){
		
		$output = json_decode($output,true);
		if(is_array($output) && !empty($output["token"])){
			
			if(!file_exists($wd_appFile.$wd_app)){
				mkdir($wd_appFile.$wd_app,0775);
			}
			
			if(file_put_contents($wd_appFile.$wd_app."/auth_token.json",json_encode($output))){
				?>
				<script>
					window.close();
				</script>
				<?php
			}
			else{
				echo "Could not save token on server";
			}
			
		}
		else{
			echo "Could not parse response text";
		}
		
		curl_close($ch);
		
	}
	else
		echo "Could not connect to MarketCentral API";
	
	
}
?>