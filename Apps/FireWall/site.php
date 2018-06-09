<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; } ?>
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1>Your Sites</h1>
    <p>Delete a domain name and press save to remove a domain name. Fill in the empty field at the bottom to add a domain name. After adding a domain name and pointing the domain name to this site, go through the install process like normal.</p>
    <?php //print_r($wd_roots); ?>
  </div>
</div>
<div class="container">
  <form method="post" action="<?php wd_urlSub($wd_type, $wd_app, 'siteSub.php', ''); ?>">
  <table class="table table-dark table-striped">
    <thead>
      <tr>
        <th>Domain Name</th>
        <th>File Path</th>
        <th>Default</th>
        <th>Save</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $x = 1;
      foreach($wd_roots as $key => $value){
        if($key != 'default'){
          ?>
      <tr>
        <td><input type="text" name="n<?php echo $x; ?>" value="<?php echo $key; ?>"></td>
        <td><input type="text" name="p<?php echo $x; ?>" value="<?php echo $value; ?>"></td>
        <td><input type="radio" name="default" value="p<?php echo $x; ?>" <?php if($value == $wd_roots['default']){echo "checked";} ?>></td>
        <td><button type="submit" class="btn btn-success">Save</button></td>
      </tr>
      <?php
          $x = $x + 1;
        }
      }
      ?>
      <tr>
        <td><input type="text" name="n<?php echo $x; ?>" value=""></td>
        <td><input type="text" name="p<?php echo $x; ?>" value="NA"></td>
        <td><input type="radio" name="default" value="p<?php echo $x; ?>"></td>
        <td><button type="submit" class="btn btn-success">Save</button></td>
      </tr>
    </tbody>
  </table>
    <input type="hidden" name="num" value="<?php echo $x; ?>">
  </form>
</div>
<br><br><br><br>
