<?php include_once "../../wd_protect.php"; ?>
<h1>Manage Users</h1>
<details>
<summary><h3>Add User</h3></summary>
<form method="post" action="<?php wd_urlSub($wd_type, $wd_app, 'AddUser.php', ''); ?>" class="form-group">
    <input type="text" name="user" placeholder="Add User-name" class="form-control">
    <br>
    <select name="tier">
        <option value="t1">Tier 1</option>
        <option value="t2">Tier 2</option>
        <option value="t3">Tier 3</option>
        <option value="t4">Tier 4</option>
        <option value="t5">Tier 5</option>
        <option value="t6">Tier 6</option>
        <option value="t7">Tier 7</option>
        <option value="t8">Tier 8</option>
        <option value="t9">Tier 9</option>
        <option value="t10">Tier 10</option>
        <option value="tA">Admin</option>
    </select>
    <br><br>
    <input type="text" name="pass" placeholder="New Password" class="form-control">
    <br>
    <input type="submit" value="Add" class="btn btn-primary">
</form>
</details>
<hr>
<div class="panel panel-primary">
    <div class="panel-heading"><b>Users</b></div>
    <div class="panel-body">
    <div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th>Username</th>
        <th>Tier</th>
        <th>Resset Password</th>
        <th>View</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
		<?php
		$folder = $wd_root . '/User/';
		if ($handle = opendir($folder)) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
						$tier = test_input(file_get_contents($folder . $entry . '/Admin/tier.txt'));
						//if($tier != 'tA'){
		?>
      <tr>
        <td><a href="<?php wd_url($wd_type, $wd_app, 'user.php', '&user=' . $entry); ?>"><?php echo f_dec($entry); ?></a></td>
        <td><form method="post" action="<?php wd_urlSub($wd_type, $wd_app, 'ManageUsersSubTier.php', ''); ?>" class="form-group"><select name="tier"><option value="t1" <?php if('t1' == $tier){ echo 'selected="selected"';} ?>>Tier 1</option><option value="t2" <?php if('t2' == $tier){ echo 'selected="selected"';} ?>>Tier 2</option><option value="t3" <?php if('t3' == $tier){ echo 'selected="selected"';} ?>>Tier 3</option><option value="t4" <?php if('t4' == $tier){ echo 'selected="selected"';} ?>>Tier 4</option><option value="tA" <?php if('tA' == $tier){ echo 'selected="selected"';} ?>>Admin</option></select><input type="hidden" name="user" value="<?php echo $entry; ?>"><input type="submit" value="Save" class="btn btn-success"></form></td>
        <td><form method="post" action="<?php wd_urlSub($wd_type, $wd_app, 'ManageUsersSubResset.php', ''); ?>" class="form-group"><span class="col-xs-5"><input type="text" name="pass" placeholder="New Password" class="form-control"></span><input type="hidden" name="user" value="<?php echo $entry; ?>"><input type="submit" value="Resset" class="btn btn-warning"></form></td>
        <td>
          <a href="<?php wd_urlSub($wd_type, $wd_app, 'userView.php', '&dir=' . $entry); ?>"><button class="btn btn-primary">View</button></a>
        </td>
        <td><form method="post" action="<?php wd_urlSub($wd_type, $wd_app, 'ManageUsersSubDelete.php', ''); ?>" class="form-group"><input type="hidden" name="user" value="<?php echo $entry; ?>"><input type="submit" value="Delete User" class="btn btn-danger"></form></td>
      </tr>
      <?php
  //}
                    }}}
      ?>
    </tbody>
  </table>
  </div>
    </div>
</div>
