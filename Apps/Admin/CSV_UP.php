<?php include_once "../../wd_protect.php"; ?>
<br><br>
<div class="panel panel-primary">
  <div class="panel-heading"><b>Upload CSV(Users)</b></div>
  <div class="panel-body">
      <form action="<?php wd_urlSub($wd_type, $wd_app, 'uploadCSV.php', ''); ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="fileToUpload">Select CSV to upload:</label>
          <input type="file" name="fileToUpload" id="fileToUpload">
        </div>
        <div class="form-group">
          <label for="tier">Tier: </label>
          <select name="tier" id="tier" class="form-control">
            <option value="t1">Tier 1</option>
            <option value="t2">Tier 2</option>
            <option value="t3">Tier 3</option>
            <option value="t4">Tier 4</option>
            <option value="tA">Admin</option>
          </select>
        </div>
        <div class="form-group">
          <label for="pass">Password: </label>
          <input type="password" name="pass" id="password" class="form-control">
        </div>
        <input type="submit" value="Upload" name="submit" class="btn btn-success">
      </form>
  </div>
</div>
