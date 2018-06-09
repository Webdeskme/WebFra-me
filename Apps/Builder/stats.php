<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; } ?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>">WebSite Builder</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>">Pages</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'ppost.php', ''); ?>">Post</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pcss.php', ''); ?>">CSS</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pheader.php', ''); ?>">Header</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pmedia.php', ''); ?>">Media</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pbanner.php', ''); ?>">Banner</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pfooter.php', ''); ?>">Footer</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'psettings.php', ''); ?>">Settings</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pplugins.php', ''); ?>">Plugins</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pthemes.php', ''); ?>">Themes</a></li>
        <li class="active"><a href="<?php wd_url($wd_type, $wd_app, 'stats.php', ''); ?>">Stats</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'log.php', ''); ?>">Log</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#" data-toggle="collapse" data-target="#NewP">Create Page</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
<?php
  $month = file_get_contents($wd_root . '/Admin/month.txt');
?>
<h2><?php echo $month; ?>'s Website Stats:</h2>
  <?php
    $bytes = disk_free_space(".");
    $tbytes = disk_total_space('.');
    $si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
    $base = 1024;
    $class = min((int)log($bytes , $base) , count($si_prefix) - 1);
    $left = sprintf('%1.2f' , $bytes / pow($base,$class)) . ' ' . $si_prefix[$class];
    $total = sprintf('%1.2f' , $tbytes / pow($base,$class)) . ' ' . $si_prefix[$class];
    $pb = $bytes / $tbytes;
    $pb = $pb * 100;
    $pb = number_format((float)$pb, 2, '.', '');
?>
  <h3>Your Servers Disk has <?php echo $left . " out of " . $total; ?> remaining. That is <?php echo $pb; ?>% left.</h3>
<?php
if(file_exists($wd_admin . 'fstat.json')){
  $obj = file_get_contents($wd_admin . 'fstat.json');
  $obj = json_decode($obj, true);
  $total = count($obj);
  echo "<h3><b>Total Page Views: </b>" . $total . "</h3>";
  foreach($obj as $key => $value){
    if(isset($os[$obj[$key]['os']])){
      $os[$obj[$key]['os']] = $os[$obj[$key]['os']] + 1;
    }
    else{
      $os[$obj[$key]['os']] = 1;
    }
    if(isset($browser[$obj[$key]['browser']])){
      $browser[$obj[$key]['browser']] = $browser[$obj[$key]['browser']] + 1;
    }
    else{
      $browser[$obj[$key]['browser']] = 1;
    }
    if(isset($mobile[$obj[$key]['mobile']])){
      $mobile[$obj[$key]['mobile']] = $mobile[$obj[$key]['mobile']] + 1;
    }
    else{
      $mobile[$obj[$key]['mobile']] = 1;
    }
    if(isset($cookies[$obj[$key]['cookies']])){
      $cookies[$obj[$key]['cookies']] = $cookies[$obj[$key]['cookies']] + 1;
    }
    else{
      $cookies[$obj[$key]['cookies']] = 1;
    }
    if(isset($screen[$obj[$key]['screen']])){
      $screen[$obj[$key]['screen']] = $screen[$obj[$key]['screen']] + 1;
    }
    else{
      $screen[$obj[$key]['screen']] = 1;
    }
    if(isset($page[$obj[$key]['page']])){
      $page[$obj[$key]['page']] = $page[$obj[$key]['page']] + 1;
    }
    else{
      $page[$obj[$key]['page']] = 1;
    }
    if(isset($ip[$obj[$key]['ip']])){
      $ip[$obj[$key]['ip']] = $ip[$obj[$key]['ip']] + 1;
    }
    else{
      $ip[$obj[$key]['ip']] = 1;
    }
  }
  ?>
<div class="panel panel-info">
  <div class="panel-heading">OS</div>
  <div class="panel-body">
  	<table class="table table-striped">
    	<thead>
      		<tr>
        		<th>OS</th>
        		<th>Total Views</th>
        		<th>Percent of Total</th>
      		</tr>
    	</thead>
    	<tbody>
          <?php
  foreach($os as $key => $value){
    $T = $value/$total;
    $T = $T * 100;
  ?>
      		<tr>
        		<td><?php echo $key;?></td>
        		<td><?php echo $value;?></td>
        		<td><?php echo $T;?>%</td>
      		</tr>
          <?php
  }
  ?>
    	</tbody>
  	</table>
  </div>
</div>
<br><br>
<div class="panel panel-info">
  <div class="panel-heading">Browser</div>
  <div class="panel-body">
  	<table class="table table-striped">
    	<thead>
      		<tr>
        		<th>Browser</th>
        		<th>Total Views</th>
        		<th>Percent of Total</th>
      		</tr>
    	</thead>
    	<tbody>
          <?php
  foreach($browser as $key => $value){
    $T = $value/$total;
    $T = $T * 100;
  ?>
      		<tr>
        		<td><?php echo $key;?></td>
        		<td><?php echo $value;?></td>
        		<td><?php echo $T;?>%</td>
      		</tr>
          <?php
  }
  ?>
    	</tbody>
  	</table>
  </div>
</div>
<br><br>
<div class="panel panel-info">
  <div class="panel-heading">Mobile</div>
  <div class="panel-body">
  	<table class="table table-striped">
    	<thead>
      		<tr>
        		<th>Mobile</th>
        		<th>Total Views</th>
        		<th>Percent of Total</th>
      		</tr>
    	</thead>
    	<tbody>
          <?php
  foreach($mobile as $key => $value){
    $T = $value/$total;
    $T = $T * 100;
  ?>
      		<tr>
        		<td><?php echo $key;?></td>
        		<td><?php echo $value;?></td>
        		<td><?php echo $T;?>%</td>
      		</tr>
          <?php
  }
  ?>
    	</tbody>
  	</table>
  </div>
</div>
<br><br>
<div class="panel panel-info">
  <div class="panel-heading">Cookies</div>
  <div class="panel-body">
  	<table class="table table-striped">
    	<thead>
      		<tr>
        		<th>Cookies</th>
        		<th>Total Views</th>
        		<th>Percent of Total</th>
      		</tr>
    	</thead>
    	<tbody>
          <?php
  foreach($cookies as $key => $value){
    $T = $value/$total;
    $T = $T * 100;
  ?>
      		<tr>
        		<td><?php echo $key;?></td>
        		<td><?php echo $value;?></td>
        		<td><?php echo $T;?>%</td>
      		</tr>
          <?php
  }
  ?>
    	</tbody>
  	</table>
  </div>
</div>
<br><br>
<div class="panel panel-info">
  <div class="panel-heading">Screen</div>
  <div class="panel-body">
  	<table class="table table-striped">
    	<thead>
      		<tr>
        		<th>Screen</th>
        		<th>Total Views</th>
        		<th>Percent of Total</th>
      		</tr>
    	</thead>
    	<tbody>
          <?php
  foreach($screen as $key => $value){
    $T = $value/$total;
    $T = $T * 100;
  ?>
      		<tr>
        		<td><?php echo $key;?></td>
        		<td><?php echo $value;?></td>
        		<td><?php echo $T;?>%</td>
      		</tr>
          <?php
  }
  ?>
    	</tbody>
  	</table>
  </div>
</div>
<br><br>
<div class="panel panel-info">
  <div class="panel-heading">Page</div>
  <div class="panel-body">
  	<table class="table table-striped">
    	<thead>
      		<tr>
        		<th>Page</th>
        		<th>Total Views</th>
        		<th>Percent of Total</th>
      		</tr>
    	</thead>
    	<tbody>
          <?php
  foreach($page as $key => $value){
    $T = $value/$total;
    $T = $T * 100;
  ?>
      		<tr>
        		<td><?php echo $key;?></td>
        		<td><?php echo $value;?></td>
        		<td><?php echo $T;?>%</td>
      		</tr>
          <?php
  }
  ?>
    	</tbody>
  	</table>
  </div>
</div>
<br><br>
<div class="panel panel-info">
  <div class="panel-heading">IP</div>
  <div class="panel-body">
  	<table class="table table-striped">
    	<thead>
      		<tr>
        		<th>IP</th>
        		<th>Total Views</th>
        		<th>Percent of Total</th>
      		</tr>
    	</thead>
    	<tbody>
          <?php
  foreach($ip as $key => $value){
    $T = $value/$total;
    $T = $T * 100;
  ?>
      		<tr>
        		<td><?php echo $key;?></td>
        		<td><?php echo $value;?></td>
        		<td><?php echo $T;?>%</td>
      		</tr>
          <?php
  }
  ?>
    	</tbody>
  	</table>
  </div>
</div>
<br><br>
<?php
}
?>
</div>
<br><br><br>
