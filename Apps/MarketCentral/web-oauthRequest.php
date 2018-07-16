<?php
include("config.inc.php");
//include_once("pageHeader.php");
?>
<style>
	body{
		background-color: #8911D9;
	}
</style>
<div class="webdesk_container">
	
	<?php
	if(empty($req["client"])){
		?>
		<div class="webdesk_alert webdesk_alert-danger">
			You must supply a <code>client</code> parameter in your request.
		</div>
		<?php
	}
	else if(empty($req["return_uri"])){
		?>
		<div class="webdesk_alert webdesk_alert-danger">
			You must supply a <code>return_uri</code> parameter in your request.
		</div>
		<?php
	}
	else{
		?>
		<div class="webdesk_card webdesk_mt-5">
			<div class="webdesk_card-body webdesk_mt-5">
				<div class="webdesk_text-center">
					<img src="<?php echo $wd_type."/".$wd_app ?>/assets/Webdesk_Logo.png" class="webdesk_img" style="max-width: 150px" />
				</div>
				<p class="webdesk_lead webdesk_pt-4">
					Sign in to your Webdesk Publisher&apos;s Account to continue.
				</p>
				<p class="webdesk_lead webdesk_pb-4">
					<a href="#">Create an account</a>
				</p>
				<form name="loginForm">
					<input type="hidden" name="f" value="marketplacepublisher_login" />
					<div class="webdesk_form-group">
						<label for="email">Email address</label>
						<input type="email" id="email" class="webdesk_form-control" name="publishers_email"  aria-describedby="emailHelp" placeholder="severus@hogwarts.edu" />
						<small id="emailHelp" class="form-text text-muted">This will be different than your Webdesk login</small>
					</div>
					<div class="webdesk_form-group">
						<label for="password">Password</label>
						<input type="password" id="password" class="webdesk_form-control" name="publishers_password" />
						
					</div>
					<input type="submit" class="webdesk_btn webdesk_btn-primary" value="Sign In" />
				</form>
			</div>
		</div>
		<script type="text/javascript">
			$("form").submit(function(){
				
				var formVars = $(this).serialize();
				if($(".alert-msg",this).length == 0){
					$(":input[type='submit']",this).after('<span class="alert-msg webdesk_alert webdesk_alert-danger"></span>');
				}
				
				$.post("<?php echo $wd_type."/".$wd_app ?>/marketcentral.ajax.json.php",formVars, function(data,textStatus){
					
					if(data.result != "success"){
						console.log(data.msg);
						$(".alert-msg").text(data.msg);
					}
					else{
						
						opener.document.location = "<?php echo urldecode($req["return_uri"]) ?>&token=" + data.data.token;
						window.close();
						
					}
					
				});
				
				return false;
				
			});
		</script>
		<?php
	}
	?>
</div>