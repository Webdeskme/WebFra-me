<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
include_once("config.inc.php");
include("appHeader.php");

$free_bytes = disk_free_space(".");
$total_bytes = disk_total_space('.');
$si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
$base = 1024;
$class = min((int)log($free_bytes , $base) , count($si_prefix) - 1);
$left = sprintf('%1.2f' , $free_bytes / pow($base,$class)) . ' ' . $si_prefix[$class];
$total = sprintf('%1.2f' , $total_bytes / pow($base,$class)) . ' ' . $si_prefix[$class];

$amount_full = sprintf('%1.2f' , ($total_bytes-$free_bytes) / pow($base,$class));
$pct_full = 100 - number_format((float)$free_bytes / (float)$total_bytes * 100,2);

if(file_exists($wd_admin . 'fstat.json')){
  $obj = file_get_contents($wd_admin . 'fstat.json');
  $obj = json_decode($obj, true);
  $count_page_views = count($obj);
}
else
  $count_page_views = 0;
?>

<div class="webdesk_container webdesk_my-5">
  <?php
    $month = file_get_contents($wd_root . '/Admin/month.txt');
  ?>
  <div class="webdesk_float-right">
    <a href="<?php wd_url($wd_type, $wd_app, "log.php", ''); ?>" class="webdesk_text-primary">View raw data</a>
  </div>
  <h2><?php echo $month; ?>'s Website Stats</h2>
  <div class="webdesk_row webdesk_my-5">
    <div class="webdesk_col-md-3 webdesk_col-sm-4 webdesk_text-center">
      <div class="webdesk_card webdesk_p-3">
        <h1 class="webdesk_display-5"><?php echo $count_page_views ?></h1>
        <small>PAGE VIEWS</small>
      </div>
    </div>
    <div class="webdesk_col-md-3 webdesk_col-sm-4 webdesk_text-center">
      <div class="webdesk_card webdesk_p-3">
        
        <h1 class="webdesk_display-5"><?php echo $amount_full ?><small style="font-size: .8rem;"><?php echo $si_prefix[$class] ?></small></h1>
        <div class="webdesk_progress webdesk_rounded-0">
          <div class="webdesk_progress-bar" role="progressbar" aria-valuenow="<?php echo $pct_full ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $pct_full ?>%;"></div>
        </div>
        <small>HARD DISK</small>
      </div>
    </div>
  </div>
  
    <!--<h3>Your Servers Disk has <?php echo $left . " out of " . $total; ?> remaining. That is <?php echo $pb; ?>% left.</h3>-->
  <?php
  if(file_exists($wd_admin . 'fstat.json')){
    $obj = file_get_contents($wd_admin . 'fstat.json');
    $obj = json_decode($obj, true);
    $total = count($obj);
    //echo "<h3><b>Total Page Views: </b>" . $total . "</h3>";
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
      else if(isset($page[$obj])){
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
  <div class="webdesk_card webdesk_bg-light">
    <div class="webdesk_card-header">OS</div>
    <div class="webdesk_card-body">
    	<table class="webdesk_table webdesk_-striped">
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
      $T = round($value/$total*100,2);
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
  <div class="webdesk_card webdesk_bg-light">
    <div class="webdesk_card-header">Browser</div>
    <div class="webdesk_card-body">
    	<table class="webdesk_table webdesk_-striped">
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
      $T = round($value/$total*100,2);
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
  <div class="webdesk_card webdesk_bg-light">
    <div class="webdesk_card-header">Mobile</div>
    <div class="webdesk_card-body">
    	<table class="webdesk_table webdesk_-striped">
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
      $T = round($value/$total*100,2);
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
  <div class="webdesk_card webdesk_bg-light">
    <div class="webdesk_card-header">Cookies</div>
    <div class="webdesk_card-body">
    	<table class="webdesk_table webdesk_-striped">
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
      $T = round($value/$total*100,2);
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
  <div class="webdesk_card webdesk_bg-light">
    <div class="webdesk_card-header">Screen</div>
    <div class="webdesk_card-body">
    	<table class="webdesk_table webdesk_-striped">
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
      $T = round($value/$total*100,2);
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
  <div class="webdesk_card webdesk_bg-light">
    <div class="webdesk_card-header">Page</div>
    <div class="webdesk_card-body">
    	<table class="webdesk_table webdesk_-striped">
      	<thead>
        		<tr>
          		<th>Page</th>
          		<th>Total Views</th>
          		<th>Percent of Total</th>
        		</tr>
      	</thead>
      	<tbody>
            <?php
            if(isset($page) && is_array($page)){
              foreach($page as $key => $value){
                $T = round($value/$total*100,2);
              ?>
                  		<tr>
                    		<td><?php echo $key;?></td>
                    		<td><?php echo $value;?></td>
                    		<td><?php echo $T;?>%</td>
                  		</tr>
                      <?php
              }
            }
            ?>
      	</tbody>
    	</table>
    </div>
  </div>
  <br><br>
  <div class="webdesk_card webdesk_bg-light">
    <div class="webdesk_card-header">IP</div>
    <div class="webdesk_card-body">
    	<table class="webdesk_table webdesk_-striped">
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
      $T = round($value/$total*100,2);
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

<?php
include("appFooter.php");
?>