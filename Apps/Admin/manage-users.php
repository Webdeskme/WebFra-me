<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
//_wf_backbutton(wd_url($wd_type, $wd_app, 'start.php', ''));
include_once("config.inc.php");
include("appHeader.php");
?>
<nav class="webdesk_navbar webdesk_border-top webdesk_navbar-expand-md webdesk_navbar-light webdesk_bg-light">
  <a class="webdesk_navbar-brand" href="<?php echo wd_url($wd_type, $wd_app, 'start.php', ''); ?>"><i class="fa fa-arrow-circle-left"></i></a> Manage Users
  <button class="webdesk_navbar-toggler" type="button" data-toggle="webdesk_collapse" data-target="#wf_adminSubHeader" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="webdesk_navbar-toggler-icon"></span>
  </button>
  
  <div class="webdesk_collapse webdesk_navbar-collapse" id="wf_adminSubHeader">
    <ul class="webdesk_navbar-nav webdesk_ml-auto">
      <li class="webdesk_nav-item">
        <button class="webdesk_nav-link webdesk_btn webdesk_btn-link" data-toggle="webdesk_modal" data-target="#newUserModal"><i class="fa fa-user-plus fa-fw"></i> Add User</button>
      </li>
    </ul>
    
  </div>
</nav>

<div class="webdesk_container webdesk_my-5">
	
	<form class="form-inline webdesk_my-3" action="<?php echo wd_url($wd_type, $wd_app, 'manage-users.php', ''); ?>" method="GET">
  	<input type="hidden" name="type" value="<?php echo $wd_type ?>" />
		<input type="hidden" name="app" value="<?php echo $wd_app ?>" />
		<input type="hidden" name="sec" value="manage-users.php" />
		<div class="webdesk_input-group">
    	<input class="webdesk_form-control webdesk_rounded-0" name="s" type="search" placeholder="Search users" aria-label="Search">
    	<div class="webdesk_input-group-append">
    		<button class="webdesk_btn webdesk_btn-outline-secondary webdesk_rounded-0" type="submit"><i class="fa fa-search fa-fw"></i></button>
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
	<table class="webdesk_table">
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
							<div class="webdesk_modal webdesk_fade" id="viewUser<?php echo $user["code"] ?>Modal" tabindex="-1" role="dialog" aria-labelledby="viewUser<?php echo $user["code"] ?>ModalLabel" aria-hidden="true">
								<form action="<?php wd_urlSub($wd_type, $wd_app, 'manage-usersSub.php', ''); ?>" method="POST">
									<input type="hidden" name="action" value="saveUser" />
									<input type="hidden" name="user" value="<?php echo $user["code"] ?>" />
								  <div class="webdesk_modal-dialog webdesk_modal-lg webdesk_shadow-lg" role="document">
								    <div class="webdesk_modal-content">
								      <div class="webdesk_modal-header">
								        <h5 class="webdesk_modal-title" id="viewUser<?php echo $user["code"] ?>ModalLabel">Editing User</h5>
								        <button type="button" class="webdesk_close" data-dismiss="webdesk_modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="webdesk_modal-body">
								    
								        <div class="webdesk_row webdesk_form-group">
								        	<label for="username-<?php echo $key ?>" class="webdesk_col-form-label webdesk_col-sm-3 webdesk_text-right">Username</label>
								        	<div class="webdesk_col-sm-9">
								        		<input type="text" name="username" id="username-<?php echo $key ?>" class="webdesk_form-control" value="<?php echo $user["user"] ?>" />
								        	</div>
								        </div>
								        <div class="webdesk_row webdesk_form-group">
								        	<label for="fn-<?php echo $key ?>" class="webdesk_col-form-label webdesk_col-sm-3 webdesk_text-right">First Name</label>
								        	<div class="webdesk_col-sm-9">
								        		<input type="text" name="fn" id="fn-<?php echo $key ?>" class="webdesk_form-control" value="<?php echo $user["details"]["fn"] ?>" />
								        	</div>
								        </div>
								        <div class="webdesk_row webdesk_form-group">
								        	<label for="ln-<?php echo $key ?>" class="webdesk_col-form-label webdesk_col-sm-3 webdesk_text-right">Last Name</label>
								        	<div class="webdesk_col-sm-9">
								        		<input type="text" name="ln" id="ln-<?php echo $key ?>" class="webdesk_form-control" value="<?php echo $user["details"]["ln"] ?>" />
								        	</div>
								        </div>
								        <div class="webdesk_row webdesk_form-group">
								        	<label for="contact-<?php echo $key ?>" class="webdesk_col-form-label webdesk_col-sm-3 webdesk_text-right">Contact Info</label>
								        	<div class="webdesk_col-sm-9">
								        		<textarea name="contact" id="contact-<?php echo $key ?>" class="webdesk_form-control"><?php echo $user["details"]["contact"] ?></textarea>
								        	</div>
								        </div>
								        <div class="webdesk_row webdesk_form-group">
								        	<label for="notes-<?php echo $key ?>" class="webdesk_col-form-label webdesk_col-sm-3 webdesk_text-right">Notes</label>
								        	<div class="webdesk_col-sm-9">
								        		<textarea name="notes" id="notes-<?php echo $key ?>" class="webdesk_form-control"><?php echo $user["details"]["notes"] ?></textarea>
								        	</div>
								        </div>
								      </div>
								      <div class="webdesk_modal-footer">
								        <button type="button" class="webdesk_btn webdesk_btn-secondary" data-dismiss="webdesk_modal">Close</button>
								        <?php wd_confirm($wd_type, $wd_app, 'manage-usersSub.php', '&action=delete&user=' . $user["code"], 'delete-user-' . $user["code"], 'Delete User') ?>
								        <button type="submit" class="webdesk_btn webdesk_btn-primary">Save user</button>
								      </div>
								    </div>
								  </div>
							  </form>
							</div>
							<div class="webdesk_modal webdesk_fade" id="resetUserPassword<?php echo $user["code"] ?>Modal" tabindex="-1" role="dialog" aria-labelledby="resetUserPassword<?php echo $user["code"] ?>ModalLabel" aria-hidden="true">
								<form action="<?php wd_urlSub($wd_type, $wd_app, 'manage-usersSub.php', ''); ?>" method="POST">
									<input type="hidden" name="action" value="resetUserPassword" />
									<input type="hidden" name="user" value="<?php echo $user["code"] ?>" />
								  <div class="webdesk_modal-dialog webdesk_modal-lg webdesk_shadow-lg" role="document">
								    <div class="webdesk_modal-content">
								      <div class="webdesk_modal-header">
								        <h5 class="webdesk_modal-title" id="resetUserPassword<?php echo $user["code"] ?>ModalLabel">Reset User Password</h5>
								        <button type="button" class="webdesk_close" data-dismiss="webdesk_modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="webdesk_modal-body">
								    
								        <div class="webdesk_row webdesk_form-group">
								        	<label for="new-password-<?php echo $key ?>" class="webdesk_col-form-label webdesk_col-sm-3 webdesk_text-right">Set Password</label>
								        	<div class="webdesk_col-sm-9">
								        		<input type="password" name="pass" id="username-<?php echo $key ?>" class="webdesk_form-control" />
								        		<small class="webdesk_form-text webdesk_text-muted">Password must be 6 or more characters and contain at least 1 upper-case, 1 lower-case and 1 number</small>
								        	</div>
								        </div>
	
								      </div>
								      <div class="webdesk_modal-footer">
								        <button type="button" class="webdesk_btn webdesk_btn-secondary" data-dismiss="webdesk_modal">Close</button>
								        <button type="submit" class="webdesk_btn webdesk_btn-primary">Change Password</button>
								      </div>
								    </div>
								  </div>
								</form>
							</div>
							<div class="webdesk_modal webdesk_fade" id="changeUserTier<?php echo $user["code"] ?>Modal" tabindex="-1" role="dialog" aria-labelledby="changeUserTier<?php echo $user["code"] ?>ModalLabel" aria-hidden="true">
								<form action="<?php wd_urlSub($wd_type, $wd_app, 'manage-usersSub.php', ''); ?>" method="POST">
									<input type="hidden" name="action" value="changeUserTier" />
									<input type="hidden" name="user" value="<?php echo $user["code"] ?>" />
								  <div class="webdesk_modal-dialog webdesk_shadow-lg" role="document">
								    <div class="webdesk_modal-content">
								      <div class="webdesk_modal-header">
								        <h5 class="webdesk_modal-title" id="changeUserTier<?php echo $user["code"] ?>ModalLabel">Change User Tier</h5>
								        <button type="button" class="webdesk_close" data-dismiss="webdesk_modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="webdesk_modal-body">
								    
								        <div class="webdesk_row webdesk_form-group">
								        	<label for="new-tier-<?php echo $key ?>" class="webdesk_col-form-label webdesk_col-sm-3 webdesk_text-right">Tier</label>
								        	<select class="webdesk_custom-select webdesk_col-sm-8" name="tier">
								        		<?php
								        		for($x=1;$x<=10;$x++){
								        			if(file_exists($wd_admin . 't' . $x . '.json')){
									        			?>
									        			<option value="t<?php echo $x ?>"<?php echo ($user["tier"] == "t" . $x) ? " SELECTED" : ""; ?>>Tier <?php echo $x ?></option>
									        			<?php
								        			}
								        		}
								        		?>
								        		<option value="tA" <?php echo ($user["tier"] == "Admin") ? " SELECTED" : ""; ?>>Admin</option>
								        	</select>
								        </div>
	
								      </div>
								      <div class="webdesk_modal-footer">
								        <button type="button" class="webdesk_btn webdesk_btn-secondary" data-dismiss="webdesk_modal">Close</button>
								        <button type="submit" class="webdesk_btn webdesk_btn-primary">Save Tier Level</button>
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
						<td class="webdesk_text-right">
							<button type="button" class="webdesk_btn webdesk_btn-light" data-toggle="webdesk_modal" data-target="#viewUser<?php echo $user["code"] ?>Modal" data-toggle="webdesk_tooltip" data-placement="top" title="Edit user info"><i class="fa fa-pen"></i></button>
							<button type="button" class="webdesk_btn webdesk_btn-light" data-toggle="webdesk_modal" data-target="#resetUserPassword<?php echo $user["code"] ?>Modal" title="Reset user password"><i class="fa fa-lock-open"></i></button>
							<button type="button" class="webdesk_btn webdesk_btn-light" data-toggle="webdesk_modal" data-target="#changeUserTier<?php echo $user["code"] ?>Modal" title="Change user's tier level"><i class="fa fa-shield-alt"></i></button>
						</td>
					</tr>
					<?php
				}
			}
			?>
		</tbody>
	</table>
</div>

<div class="webdesk_modal webdesk_fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="newUserModalLabel" aria-hidden="true">
  <div class="webdesk_modal-dialog webdesk_modal-lg webdesk_shadow-lg" role="document">
    <div class="webdesk_modal-content">
      <div class="webdesk_modal-header">
        <h5 class="webdesk_modal-title" id="newUserModalLabel"><i class="fa fa-user-plus fa-fw"></i> Add User</h5>
        <button type="button" class="webdesk_close" data-dismiss="webdesk_modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form name="addUserForm" action="<?php echo wd_urlSub($wd_type, $wd_app, 'manage-usersSub.php', ''); ?>" method="POST">

      	<input type="hidden" name="action" value="add" />
      	<div class="webdesk_modal-body">
        	<div class="webdesk_form-group">
        		<label for="newUsername">Username</label>
        		<input type="text" name="user" class="webdesk_form-control" id="newUsername" />
        	</div>
        	<div class="webdesk_form-group">
        		<label for="newPassword">Password</label>
        		<div class="webdesk_input-group">
        			<input type="password" name="pass" class="webdesk_form-control" id="newPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" />
        			<div class="webdesk_input-group-append">
        				<button type="button" class="webdesk_btn webdesk_btn-white webdesk_border" onclick="if($(':input[name=pass]').attr('type') == 'password'){ $(':input[name=pass]').attr('type','text'); $(this).removeClass('webdesk_btn-white').addClass('webdesk_btn-secondary'); }else{ $(':input[name=pass]').attr('type','password'); $(this).addClass('webdesk_btn-white').removeClass('webdesk_btn-secondary');}"><i class="fa fa-eye"></i></button>
        			</div>
        		</div>
        	</div>
        	<div class="webdesk_form-group">
        		<label for="newTier">Tier</label>
        		<select name="tier" class="webdesk_custom-select" id="newTier">
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
	      <div class="webdesk_modal-footer">
	        <button type="button" class="webdesk_btn webdesk_btn-secondary" data-dismiss="webdesk_modal">Close</button>
	        <button type="submit" class="webdesk_btn webdesk_btn-primary">Add User</button>
	      </div>
	    </form>
    </div>
  </div>
</div>

<?php
include("appFooter.php");
?>