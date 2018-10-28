<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
//_wf_backbutton(wd_url($wd_type, $wd_app, 'start.php', ''));
include_once("config.inc.php");
include("appHeader.php");
?>
<nav class="webdesk_navbar webdesk_border-top webdesk_navbar-expand-md webdesk_navbar-light webdesk_bg-light">
  <a class="webdesk_navbar-brand" href="<?php echo wd_url($wd_type, $wd_app, 'start.php', ''); ?>"><i class="fa fa-arrow-circle-left"></i></a> System Logs
  <button class="webdesk_navbar-toggler" type="button" data-toggle="webdesk_collapse" data-target="#wf_adminSubHeader" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="webdesk_navbar-toggler-icon"></span>
  </button>
  
  <div class="webdesk_collapse webdesk_navbar-collapse" id="wf_adminSubHeader">
    <ul class="webdesk_navbar-nav webdesk_ml-auto">
      <li class="webdesk_nav-item">
        
      </li>
    </ul>
    
  </div>
</nav>

<div class="webdesk_container">
	<?php
	if(file_exists($wd_admin . 'LoginLog.txt')){
		
		$log = file_get_contents($wd_admin . 'LoginLog.txt');
		
		$log_a = explode("<br>", $log);
		$log_a = array_reverse($log_a);
		
		foreach($log_a as $entry){
			if(preg_match("/(.*?)\[(.*?)\]/i", $entry, $match)){
				
				$match[2] = str_replace(array("Sunday ", "Monday ", "Tuesday ", "Wednesday ", "Thursday ", "Friday ", "Saturday ", "th of", "st of", "nd of", "rd of"), "", $match[2]);
				$timestamp = strtotime($match[2]);
				
				$the_day = date("Y-m-d", $timestamp);
				
				$the_log[$the_day][$timestamp] = $match[1];
				
			}
		}
		
		?>
		<div class="webdesk_my-5">
			
			<ul class="webdesk_nav wedesk_nav-pills">
			  <li class="webdesk_nav-item">
			    <a class="webdesk_nav-link webdesk_active" href="#">Successful logins</a>
			  </li>
			  <li class="webdesk_nav-item">
			    <a class="webdesk_nav-link" href="#">Failed</a>
			  </li>
			  
			</ul>
			
			<table class="webdesk_table">
				<?php
				
				foreach($the_log as $day => $entry_a){
					
					?>
					<tr>
						<td>
							<?php echo date("F j", strtotime($day)) ?>
						</td>
						<td>
							<?php
							ksort($entry_a);
							foreach($entry_a as $timestamp => $entry){
								?>
								<b><?php echo date("h:ia", $timestamp); ?></b> &mdash; <?php echo $entry ?><br />
								<?php
							}
							?>
						</td>
					</tr>
					<?php
				}
				?>
			</table>
		</div>
		<?php
	}
	else{
		echo 'No logged entries this month.';
	}
	?>
</div>
<?php
include("appFooter.php");
?>