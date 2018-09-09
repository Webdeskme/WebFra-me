<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Webframe Updater</title>
  </head>
  <body>
  	
  	<div class="site-alert text-center" style="position: absolute; left: 0; width: 100%;display:none;">
  		<div class="alert alert-danger" role="alert" style="display:inline-block;">
			  <span class="alert-text"></span>
			</div>
  	</div>
  	
  	<div class="container my-5 py-5">
  		<div class="row mt-5">
  			<div class="col-md-6 offset-md-3">
  				<h1>Webframe Updater</h1>
  				<p>
  					This installation file will download and install the new version of Webframe.
  				</p>
  				<div class="card">
  					<ul class="list-group list-group-flush">
  						
  						<li class="list-group-item"><i class="step1 fa fa-dot-circle fa-lg fa-fw"></i> &nbsp; Checking version</li>
  						<li class="list-group-item"><i class="step2 fa fa-dot-circle fa-lg fa-fw"></i> &nbsp; Downloading Webframe</li>
  						<li class="list-group-item"><i class="step3 fa fa-dot-circle fa-lg fa-fw"></i> &nbsp; Unpacking Webframe</li>
  						<li class="list-group-item"><i class="step4 fa fa-dot-circle fa-lg fa-fw"></i> &nbsp; Cleaning up</li>
  						
  					</ul>
  				</div>
  				<br />
  				<div class="text-center">
  					<button onclick="install(1);" type="button" class="btn btn-primary"><i class="fa fa-download fa-fw"></i> Begin update</button>
  				</div>
  			</div>
  		</div>
  	</div>
	
    <script defer src="https://use.fontawesome.com/releases/v5.2.0/js/all.js" integrity="sha384-4oV5EgaV02iISL2ban6c/RmotsABqE4yZxZLcYMAdG7FAPsyHYAPpywE9PJo+Khy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    
    <script type="text/javascript">
    	var is_finished = false;
    	function install(curr_step){
    		
    		if(is_finished)
    			document.location = "//" + window.location.host + "/desktop.php?wd_as=Your+installation+of+Webframe+has+been+successfully+updated";
    		else{
	    		$(".site-alert").hide();
	    		$("button").addClass("disabled").prop("disabled",true).html('Please wait');
	    		if(curr_step == 1)
	    			$(".step1,.step2,.step3,.step4").removeClass("fa-circle-notch fa-spin fa-times fa-check text-success text-danger").addClass("fa-dot-circle");
	    		
	    		$("body").prop("currStep", curr_step);
	    		$(".step" + curr_step).removeClass("fa-dot-circle").addClass("fa-circle-notch fa-spin");
	    		$.get("//<?php echo $_SERVER["HTTP_HOST"] ?>/updaterSub.php", {step: curr_step},function(data){
			      
			      if(data.result != "success"){
			      	$(".step" + $("body").prop("currStep")).removeClass("fa-circle-notch fa-spin").addClass("fa-times text-danger");
			      	$(".site-alert").show();
			      	$(".site-alert .alert-text").html(data.error);
			      	$("button").removeClass("disabled").prop("disabled",false).html('<i class="fa fa-download fa-fw"></i> Retry update');
			      }
			      else{
			      	$(".step" + $("body").prop("currStep")).removeClass("fa-circle-notch fa-spin").addClass("fa-check text-success");
			      	if(data.next_step != null){
			      		
			      		install(data.next_step);
			      		
			      	}
			      	if( (data.last_step != null) && data.last_step){
			      		
			      		is_finished = true;
			      		window.title = "Update complete!";
			      		$("button").removeClass("disabled").prop("disabled",false).html("Continue");
			      		
			      	}
			      }
			      
			    });
    		}
    		
    	}
    </script>
    
  </body>
</html>