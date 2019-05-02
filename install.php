<?php
include("testInput.php");
if(file_exists("path.php") && file_exists($wd_roots[$_SERVER['HTTP_HOST']])){
	header('Location: index.php');
	//echo "Installation exists";
}
else{
	
	$extensions_needed = array('gd','imap','curl','json','Zend OPcache','xmlrpc','zip');
	$extensions_installed = get_loaded_extensions();
	//print_r($extensions_installed);
	$extensions_notinstalled = array();
	$all_is_well = true;
	
	foreach($extensions_needed as $key => $value){
		
		if(!in_array($value, $extensions_installed)){
			$extensions_notinstalled[] = $value;
			$all_is_well = false;
		}
		
	}
	
	$writeable_dirs = array();
	$unwriteable_dirs = array();
	function recursive_check_dir_permissions($dir){
		
		global $all_is_well, $unwriteable_dirs, $writeable_dirs;
		
		if(!is_writeable($dir)){
			
			$unwriteable_dirs[] = $dir;
      
      $all_is_well = false;
		}
		else{
			$writeable_dirs[] = $dir;
			
			$files = array_diff(scandir($dir), array('..', '.', '.git'));
			foreach($files as $file_key => $dir_file){
				if(is_dir($dir."/".$dir_file) )
					recursive_check_dir_permissions($dir."/".$dir_file);
			}
			
		}
			
		
	}
	recursive_check_dir_permissions($_SERVER["DOCUMENT_ROOT"]);
	
	
	?>
	<!doctype html>
	<html lang="en">
	  <head>
	    <!-- Required meta tags -->
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    
	    <link rel="stylesheet" href="//<?php echo $_SERVER["HTTP_HOST"] ?>/Plugins/fontawesome-free-5.8.1/css/all.min.css">
	    <link rel="stylesheet" href="//<?php echo $_SERVER["HTTP_HOST"] ?>/Plugins/bootstrap-4.3.1/css/bootstrap.min.css">
	
	    <title>Install Webframe</title>
	    
	  </head>
	  <body>
	    
	    <div class="container my-5">
	    	<div class="row my-5">
	    		<div class="col-md-6 offset-md-3 mb-5">
	    			<div class="text-center mb-5">
	    				<img src="https://www.webfra.me/img/WebFrame.png" class="img" style="max-width: 200px;" />
	    			</div>
	    			
	    			
	    			<div id="step1" class="collapse multi-collapse <?php echo ($all_is_well) ? "hide" : "show"; ?>">
	    				
	    				<h1 class="">Installation</h1>
		    			<p>
		    				Thanks for downloading!
		    			</p>
		    			<p>
		    				Let&apos;s get things started. First, we&apos;ll check your environment.
		    			</p>
		    			<h3>Plugins</h3>
		    			<table class="table mb-3">
	            	<tbody>
	                <tr class="table-<?php echo (phpversion() >= 5.1) ? "success" : "danger"; ?>">
	                  <th width="33%">
	                    PHP Version
	                  </th>
	                  <td width="33%">
	                    <?php echo phpversion(); ?>
	                  </td>
	                  <td class="text-center">
	                    <i class="fa fa-<?php echo (phpversion() >= 5.1) ? "check" : 'times'; ?>-circle fa-fw fa-2x"></i>
	                  </td>
	                </tr>
	                <?php
	                if(count($extensions_notinstalled) > 0){
		                foreach($extensions_notinstalled as $ext_key => $extension){
		                	?>
		                	<tr class="table-danger">
			                  <th width="33%">
			                    <?php echo $extension ?>
			                  </th>
			                  <td width="33%">
			                    Not installed
			                  </td>
			                  <td class="text-center">
			                    <i class="fa fa-times-circle fa-fw fa-2x"></i>
			                  </td>
			                </tr>
		                	<?php
		                }
	                }
	                else{
			        			?>
			        			<tr class="table-light">
			        				<td>
			        					No problems
			        				</td>
			        				
			        			</tr>
			        			<?php
			        		}
	                ?>
	                <tr>
	                	<td colspan="10">
	              			<a data-toggle="collapse" href="#installedExtensions" role="button" ><i class="fa fa-plus fa-fw"></i> Installed Extensions</a>
	              		</td>
	              	</tr>
	              </tbody>
	              <tbody class="collapse hide" id="installedExtensions">
	              	
	                <?php
	                foreach($extensions_needed as $ext_key => $extension){
	                	if(!in_array($extension, $extensions_notinstalled)){
		                	?>
		                	<tr class="table-success">
			                  <th width="33%">
			                    <?php echo $extension ?>
			                  </th>
			                  <td width="33%">
			                    Installed
			                  </td>
			                  <td class="text-center">
			                    <i class="fa fa-check-circle fa-fw fa-2x"></i>
			                  </td>
			                </tr>
		                	<?php
	                	}
	                }
	
	                ?>
	                
		            </tbody>
		        	</table>
	        		
	        		<h3>Directories</h3>
	        		<table class="table mb-5">
	            	<tbody>
			        		<?php
			        		
			        		if(count($unwriteable_dirs) > 0){
			        			foreach($unwriteable_dirs as $key => $dir){
			        				?>
			        				<tr class="table-danger">
			                  <th width="33%">
			                    <?php echo str_replace($_SERVER["DOCUMENT_ROOT"], "", $dir) ?>
			                  </th>
			                  <td width="33%">
			                    Not writeable
			                  </td>
			                  <td class="text-center">
			                    <i class="fa fa-times-circle fa-fw fa-2x"></i>
			                  </td>
			                </tr>
			                <?php
			        			}
			        		}
			        		else{
			        			?>
			        			<tr class="table-light">
			        				<td>
			        					No problems
			        				</td>
			        				
			        			</tr>
			        			<?php
			        		}
			        		?>
			        		<tr>
	                	<td colspan="10">
	              			<a data-toggle="collapse" href="#directoryPermissions" role="button" ><i class="fa fa-plus fa-fw"></i> Writeable Directories</a>
	              		</td>
	              	</tr>
			        	</tbody>
			        	<tbody class="collapse hide" id="directoryPermissions">
			        		<?php
			        		if(count($writeable_dirs) > 0){
			        			foreach($writeable_dirs as $key => $dir){
			        				?>
			        				<tr class="table-success">
			                  <th width="33%">
			                    <?php echo str_replace($_SERVER["DOCUMENT_ROOT"], "", $dir) ?>
			                  </th>
			                  <td width="33%">
			                    Writeable
			                  </td>
			                  <td class="text-center">
			                    <i class="fa fa-check-circle fa-fw fa-2x"></i>
			                  </td>
			                </tr>
			                <?php
			        			}
			        		}
			        		
			        		?>
			        	</tbody>
	            </table>
	            <?php
	            //$all_is_well = true;
	            ?>
	            <div class="mt-5 text-center">
        			
        			<span class="text-danger"><?php echo (!$all_is_well) ? 'Please fix the installation problems before continuing.<br />' : ''; ?></span>
        			
	        			<button type="button" data-target=".multi-collapse" data-toggle="collapse" role="button" class="btn btn-primary <?php echo (!$all_is_well) ? "disabled" : ""; ?>" <?php echo (!$all_is_well) ? "disabled" : ""; ?>>Continue <i class="fa fa-arrow-right fa-fw"></i></button>
	        			
	        		</div>
	            
	          </div>
	          <form id="installForm" method="POST" action="installSub.php" class="check">
	          	
		          <div id="step2" class="collapse multi-collapse multi-collapse2 <?php echo ($all_is_well) ? "show" : "hide"; ?>">
		          	
		          	<h2>User Details</h2>
	          		
	          		
							  <div class="form-group row">
							    <label for="title" class="col-sm-2 col-form-label">Site Title</label>
							    <div class="col-sm-10">
							      <input type="text" class="form-control" id="title" name="title" placeholder="My Webframe installation" required>
							    </div>
							  </div>
							  <div class="form-group row">
							    <label for="Username" class="col-sm-2 col-form-label">Choose username</label>
							    <div class="col-sm-10">
							      <input type="text" class="form-control" id="Username" name="Username" placeholder="Username" required>
							    </div>
							  </div>
							  <div class="form-group row">
							    <label for="password" class="col-sm-2 col-form-label">Choose password</label>
							    <div class="col-sm-10">
							      <input type="password" class="form-control" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
							    </div>
							  </div>
							  <div class="form-group row">
							    <label for="confirm" class="col-sm-2 col-form-label">Confirm password</label>
							    <div class="col-sm-10">
							      <input type="password" class="form-control" id="confirm" name="confirm" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
							    </div>
							  </div>
							  <div class="form-group row">
							    <label for="path" class="col-sm-2 col-form-label">File Path</label>
							    <div class="col-sm-10">
							      <input type="text" class="form-control" id="path" name="path" value="<?php echo __DIR__ . '_' . md5($_SERVER["HTTP_HOST"].$_SERVER["DOCUMENT_ROOT"].microtime(true)); ?>">
							      <small id="passwordHelpBlock" class="form-text text-muted">
							      	This is where data for your installation will be installed. It should be outside the webroot directory.
							      </small>
							    </div>
							  </div>
	
	          	
	          	
		          	<div class="mt-5 text-center">
	        			
		        			<button type="button" data-target=".multi-collapse" data-toggle="collapse" role="button" class="btn btn-light"><i class="fa fa-arrow-left fa-fw"></i> Back</button>
		        			<button type="submit" role="button" class="btn btn-primary">Continue <i class="fa fa-arrow-right fa-fw"></i></button>
		        			
		        		</div>
		        		
		        	
	          	
		          </div>
		          <div id="step3" class="collapse hide multi-collapse2">
		          	
		          	<h2>SMTP (Optional)</h2>
		          	<p>
		          		Add these if you want to be able to send email from your Webframe installation.  
		          	</p>
		          	<div class="form-group row">
							    <label for="SMTP" class="col-sm-2 col-form-label">Server Name</label>
							    <div class="col-sm-10">
							      <input type="text" class="form-control" id="SMTP" name="SMTP" placeholder="mail.yourserver.com">
							    </div>
							  </div>
							  <div class="form-group row">
							    <label for="port" class="col-sm-2 col-form-label">Port</label>
							    <div class="col-sm-10">
							      <input type="text" class="form-control" id="port" name="port" placeholder="587" value="587">
							    </div>
							  </div>
							  <div class="form-group row">
							    <label for="email" class="col-sm-2 col-form-label">SMTP Email</label>
							    <div class="col-sm-10">
							      <input type="text" class="form-control" id="email" name="email" placeholder="yourname@example.com">
							    </div>
							  </div>
							  <div class="form-group row">
							    <label for="epass" class="col-sm-2 col-form-label">SMTP Password</label>
							    <div class="col-sm-10">
							      <input type="password" class="form-control" id="epass" name="epass" placeholder="">
							    </div>
							  </div>
							  <h5 class="mt-4">Terms</h5>
							  <p>
							  	By clicking install you are agreeing <a href="License.html" target="_blank">Webframe&apos;s Licence</a>. This install also comes with a generic pricey policy and terms of use for your install. You will be held accountable to that terns of use and privacy policy until the time you edit it.</p>
							  
							  <div class="mt-5 text-center">
							  	<button type="button" data-target=".multi-collapse2" data-toggle="collapse" role="button" class="btn btn-light"><i class="fa fa-arrow-left fa-fw"></i> Back</button>
							  	<button type="submit" class="btn btn-primary" onclick='$("body").prop("check",false);'>Complete Installation</button>
							  </div>
		          	
		          </div>
		          
		        </form>
        	
	    		</div>
	    	</div>
	    </div>
	
	    <!-- Optional JavaScript -->
	    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	    <script src="//<?php echo $_SERVER["HTTP_HOST"] ?>/Plugins/jquery.min.js"></script>
	    <script src="//<?php echo $_SERVER["HTTP_HOST"] ?>/Plugins/bootstrap-4.3.1/js/bootstrap.bundle.min.js"></script>
	    <script type="text/javascript">
	    	$("body").prop("check",true);
	    	$("form").submit(function(){
    			
    			if($("body").prop("check")){
    			
	    			if($(":input[name='password']").val() != $(":input[name='confirm']").val())
	    				alert("Passwords do not match");
	    			else{
	    				$('.multi-collapse2').collapse('toggle');
	    			}
	    			
	    			return false;
	    			
    			}
    			
    			return true;
	    	});
	    </script>
	    
	  </body>
	</html>
	<?php
	
}
?>d