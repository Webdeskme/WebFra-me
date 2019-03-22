<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
//_wf_backbutton(wd_url($wd_type, $wd_app, 'start.php', ''));
include_once("config.inc.php");
include("appHeader.php");
?>
<nav class="navbar border-top navbar-expand-md navbar-light bg-light">
  <a class="navbar-brand" href="<?php echo wd_url($wd_type, $wd_app, 'start.php', ''); ?>"><i class="fa fa-arrow-circle-left"></i> Manage Users</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#wf_adminSubHeader" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="collapse navbar-collapse" id="wf_adminSubHeader">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <button class="nav-link btn btn-link" data-toggle="modal" data-target="#newUserModal"><i class="fa fa-user-plus fa-fw"></i> Add User</button>
      </li>
    </ul>
    
  </div>
</nav>

<div class="container my-5">
	
	<form class="form-inline my-3" action="<?php echo wd_url($wd_type, $wd_app, 'manage-users.php', ''); ?>" method="GET">
  	<input type="hidden" name="type" value="<?php echo $wd_type ?>" />
		<input type="hidden" name="app" value="<?php echo $wd_app ?>" />
		<input type="hidden" name="sec" value="manage-users.php" />
		<div class="input-group">
    	<input class="form-control rounded-0" name="s" type="search" placeholder="Search users" aria-label="Search">
    	<div class="input-group-append">
    		<button class="btn btn-outline-secondary rounded-0" type="submit"><i class="fa fa-search fa-fw"></i></button>
    	</div>
    </div>
  </form>
	
	<?php
	if(!empty($req["s"])){
		?>
		<h4>Search results for <?php echo $req["s"] ?> <a href="<?php echo wd_url($wd_type, $wd_app, 'manage-users.php', ''); ?>"><i class="fa fa-times-circle"></i></a></h4>
		<?php
	}
	?>
	<table class="table">
		<thead>
			<tr>
				<th>&nbsp;</th>
				<th>
					Username
				</th>
				<th>
					Full Name
				</th>
				<th>
					Tier
				</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach($wf_admin->getUsers() as $key => $user){
				
				if( empty($req["s"]) || (!empty($req["s"]) && ( preg_match("/" . $req["s"] . "/i", $user["user"])) || preg_match("/" . $req["s"] . "/i", $user["details"]["fn"]) || preg_match("/" . $req["s"] . "/i", $user["details"]["ln"]) ) ){
					?>
					<tr>
						<td>
							<div class="modal fade" id="viewUser<?php echo $user["code"] ?>Modal" tabindex="-1" role="dialog" aria-labelledby="viewUser<?php echo $user["code"] ?>ModalLabel" aria-hidden="true">
								<form action="<?php wd_urlSub($wd_type, $wd_app, 'manage-usersSub.php', ''); ?>" method="POST">
									<input type="hidden" name="action" value="saveUser" />
									<input type="hidden" name="user" value="<?php echo $user["code"] ?>" />
								  <div class="modal-dialog modal-lg shadow-lg" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="viewUser<?php echo $user["code"] ?>ModalLabel">Editing User</h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								    
								        <div class="row form-group">
								        	<label for="username-<?php echo $key ?>" class="col-form-label col-sm-3 text-right">Username</label>
								        	<div class="col-sm-9">
								        		<input type="text" name="username" id="username-<?php echo $key ?>" class="form-control" value="<?php echo $user["user"] ?>" />
								        	</div>
								        </div>
								        <div class="row form-group">
								        	<label for="fn-<?php echo $key ?>" class="col-form-label col-sm-3 text-right">First Name</label>
								        	<div class="col-sm-9">
								        		<input type="text" name="fn" id="fn-<?php echo $key ?>" class="form-control" value="<?php echo $user["details"]["fn"] ?>" />
								        	</div>
								        </div>
								        <div class="row form-group">
								        	<label for="ln-<?php echo $key ?>" class="col-form-label col-sm-3 text-right">Last Name</label>
								        	<div class="col-sm-9">
								        		<input type="text" name="ln" id="ln-<?php echo $key ?>" class="form-control" value="<?php echo $user["details"]["ln"] ?>" />
								        	</div>
								        </div>
								        <div class="row form-group">
								        	<label for="contact-<?php echo $key ?>" class="col-form-label col-sm-3 text-right">Contact Info</label>
								        	<div class="col-sm-9">
								        		<textarea name="contact" id="contact-<?php echo $key ?>" class="form-control"><?php echo $user["details"]["contact"] ?></textarea>
								        	</div>
								        </div>
								        <div class="row form-group">
								        	<label for="notes-<?php echo $key ?>" class="col-form-label col-sm-3 text-right">Notes</label>
								        	<div class="col-sm-9">
								        		<textarea name="notes" id="notes-<?php echo $key ?>" class="form-control"><?php echo $user["details"]["notes"] ?></textarea>
								        	</div>
								        </div>
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								        <?php wd_confirm($wd_type, $wd_app, 'manage-usersSub.php', '&action=delete&user=' . $user["code"], 'delete-user-' . $user["code"], 'Delete User') ?>
								        <button type="submit" class="btn btn-primary">Save user</button>
								      </div>
								    </div>
								  </div>
							  </form>
							</div>
							<div class="modal fade" id="resetUserPassword<?php echo $user["code"] ?>Modal" tabindex="-1" role="dialog" aria-labelledby="resetUserPassword<?php echo $user["code"] ?>ModalLabel" aria-hidden="true">
								<form action="<?php wd_urlSub($wd_type, $wd_app, 'manage-usersSub.php', ''); ?>" method="POST">
									<input type="hidden" name="action" value="resetUserPassword" />
									<input type="hidden" name="user" value="<?php echo $user["code"] ?>" />
								  <div class="modal-dialog modal-lg shadow-lg" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="resetUserPassword<?php echo $user["code"] ?>ModalLabel">Reset User Password</h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								    
								        <div class="row form-group">
								        	<label for="new-password-<?php echo $key ?>" class="col-form-label col-sm-3 text-right">Set Password</label>
								        	<div class="col-sm-9">
								        		<input type="password" name="pass" id="username-<?php echo $key ?>" class="form-control" />
								        		<small class="form-text text-muted">Password must be 6 or more characters and contain at least 1 upper-case, 1 lower-case and 1 number</small>
								        	</div>
								        </div>
	
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								        <button type="submit" class="btn btn-primary">Change Password</button>
								      </div>
								    </div>
								  </div>
								</form>
							</div>
							<div class="modal fade" id="changeUserTier<?php echo $user["code"] ?>Modal" tabindex="-1" role="dialog" aria-labelledby="changeUserTier<?php echo $user["code"] ?>ModalLabel" aria-hidden="true">
								<form action="<?php wd_urlSub($wd_type, $wd_app, 'manage-usersSub.php', ''); ?>" method="POST">
									<input type="hidden" name="action" value="changeUserTier" />
									<input type="hidden" name="user" value="<?php echo $user["code"] ?>" />
								  <div class="modal-dialog shadow-lg" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="changeUserTier<?php echo $user["code"] ?>ModalLabel">Change User Tier</h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								    
								        <div class="row form-group">
								        	<label for="new-tier-<?php echo $key ?>" class="col-form-label col-sm-3 text-right">Tier</label>
								        	
								        	<select class="custom-select col-sm-8" name="tier">
								        		<?php
								        		$tiers = $wf_admin->getSystemTiers();
								        		foreach($tiers as $tier => $t_info){
								        			
								        			?>
								        			<option value="t<?php echo $tier ?>"<?php echo ($user["tier"] == "t" . $tier) ? " SELECTED" : ""; ?>>Tier <?php echo $tier ?></option>
								        			<?php
								        			
								        		}
								        		?>
								        		<option value="tA" <?php echo ($user["tier"] == "tA") ? " SELECTED" : ""; ?>>Admin</option>
								        	</select>
								        </div>
								        <div class="text-center">
							        		<small class="form-text text-muted">Go to the <a href="<?php wd_url($wd_type, $wd_app, 'permissions.php', ''); ?>">permissions page</a> to manage tiers</small>
							        	</div>
	
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								        <button type="submit" class="btn btn-primary">Save Tier Level</button>
								      </div>
								    </div>
								  </div>
								</form>
							</div>
						</td>
						<td>
							<?php echo $user["user"] ?>
						</td>
						<td>
							<?php echo $user["details"]["fn"] . " " . $user["details"]["ln"] ?>
						</td>
						<td>
							<?php echo ($user["tier"] == "tA") ? "Admin" : "Tier " . str_replace("t", "", $user["tier"]) ?>
						</td>
						<td class="text-right">
							<button type="button" class="btn btn-light" data-toggle="modal" data-target="#viewUser<?php echo $user["code"] ?>Modal" data-toggle="tooltip" data-placement="top" title="Edit user info"><i class="fa fa-pen"></i></button>
							<button type="button" class="btn btn-light" data-toggle="modal" data-target="#resetUserPassword<?php echo $user["code"] ?>Modal" title="Reset user password"><i class="fa fa-lock-open"></i></button>
							<button type="button" class="btn btn-light" data-toggle="modal" data-target="#changeUserTier<?php echo $user["code"] ?>Modal" title="Change user's tier level" <?php echo ($_SESSION["user"] == $user["code"]) ? "disabled" : ""; ?>><i class="fa fa-shield-alt"></i></button>
						</td>
					</tr>
					<?php
				}
			}
			?>
		</tbody>
	</table>
</div>

<div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="newUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg shadow-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newUserModalLabel"><i class="fa fa-user-plus fa-fw"></i> Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form name="addUserForm" action="<?php echo wd_urlSub($wd_type, $wd_app, 'manage-usersSub.php', ''); ?>" method="POST">

      	<input type="hidden" name="action" value="add" />
      	<div class="modal-body">
        	<div class="form-group">
        		<label for="newUsername">Username</label>
        		<input type="text" name="user" class="form-control" id="newUsername" />
        	</div>
        	<div class="form-group">
        		<label for="newPassword">Password</label>
        		<div class="input-group">
        			<input type="password" name="pass" class="form-control" id="newPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" />
        			<div class="input-group-append">
        				<button type="button" class="btn btn-white border" onclick="if($(':input[name=pass]').attr('type') == 'password'){ $(':input[name=pass]').attr('type','text'); $(this).removeClass('btn-white').addClass('btn-secondary'); }else{ $(':input[name=pass]').attr('type','password'); $(this).addClass('btn-white').removeClass('btn-secondary');}"><i class="fa fa-eye"></i></button>
        			</div>
        		</div>
        	</div>
        	<div class="form-group">
        		<label for="newTier">Tier</label>
        		<select name="tier" class="custom-select" id="newTier">
        			<?php
        			for($x=1;$x<=10;$x++){
        				?>
        				<option value="t<?php echo $x ?>">Tier <?php echo $x ?></option>
        				<?php
        			}
        			?>
        			<option value="tA">Admin</option>
        		</select>
        	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Add User</button>
	      </div>
	    </form>
    </div>
  </div>
</div>

<?php
include("appFooter.php");
?>