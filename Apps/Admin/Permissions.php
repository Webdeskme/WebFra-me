<style>
	table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

	td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
<h1>Permissions</h1>
<form method="post" action="<?php wd_url($wd_type, $wd_app, 'Permissions.php', ''); ?>">
    <select name="tier">
      <option value="1">Tier 1</option>
      <option value="2">Tier 2</option>
      <option value="3">Tier 3</option>
      <option value="4">Tier 4</option>
      <option value="5">Tier 5</option>
      <option value="6">Tier 6</option>
      <option value="7">Tier 7</option>
      <option value="8">Tier 8</option>
      <option value="9">Tier 9</option>
      <option value="10">Tier 10</option>
      <option value="11">Tier 11</option>
      <option value="12">Tier 12</option>
      <option value="13">Tier 13</option>
      <option value="14">Tier 14</option>
      <option value="15">Tier 15</option>
      <option value="16">Tier 16</option>
      <option value="17">Tier 17</option>
      <option value="18">Tier 18</option>
      <option value="19">Tier 19</option>
      <option value="20">Tier 20</option>
      <option value="21">Tier 21</option>
      <option value="22">Tier 22</option>
      <option value="23">Tier 23</option>
      <option value="24">Tier 24</option>
      <option value="25">Tier 25</option>
      <option value="26">Tier 26</option>
      <option value="27">Tier 27</option>
      <option value="28">Tier 28</option>
      <option value="29">Tier 29</option>
      <option value="30">Tier 30</option>
      <option value="31">Tier 31</option>
      <option value="32">Tier 32</option>
      <option value="33">Tier 33</option>
      <option value="34">Tier 34</option>
      <option value="35">Tier 35</option>
      <option value="36">Tier 36</option>
      <option value="37">Tier 37</option>
      <option value="38">Tier 38</option>
      <option value="39">Tier 39</option>
      <option value="40">Tier 40</option>
      <option value="41">Tier 41</option>
      <option value="42">Tier 42</option>
      <option value="43">Tier 43</option>
      <option value="44">Tier 44</option>
      <option value="45">Tier 45</option>
      <option value="46">Tier 46</option>
      <option value="47">Tier 47</option>
      <option value="48">Tier 48</option>
      <option value="49">Tier 49</option>
      <option value="50">Tier 50</option>
    </select>
    <input type="submit" class="btn btn-primary" value="Select">
</form>
<br>
<?php
if(isset($_POST['tier'])){
	$tier = test_input($_POST['tier']);
if(file_exists($wd_admin . 't' . $tier . '.json')){$Obj=json_decode(file_get_contents($wd_admin . 't' . $tier . '.json'));}
?>
<h1>Permissions</h1>
<div class="panel panel-primary">
    <div class="panel-heading"><b>Tier <?php echo $tier; ?>: permissions</b></div>
        <div class="panel-body">
            <form method="post" action="<?php wd_urlSub($wd_type, $wd_app, 'PermissionsSub.php', '&tier=' . $tier) ?>">
               <!-- List Type: 
                <select name="type">
                    <option value="Blacklist">Blacklist</option>
                    <option value="Whitelist">Whitelist</option>
                </select>
                <hr>-->
                <table>
			      <caption>Settings</caption>
				  <tr>
					<th><u>Setting</u></th>
					<th><u>Permission</u></th>
				  </tr>
                  <tr>
                    <th><b>HUD</b></th>
                    <th><select name="HUD">
                      <?php
                if ($handle = opendir('HUD/')) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
						?>
                        <option value="<?php echo $entry; ?>" <?php if(file_exists($wd_admin . 't' . $tier . '.json') && isset($Obj->HUD)){$test = $Obj->HUD; if($test == $entry){echo ' selected="selected"';}} ?>><?php echo $entry; ?></option>
                       <?php
                    }}}
                ?>
                      </select></th>
                  </tr>
                  <tr>
                    <th><b>MHUD</b></th>
                    <th><select name="MHUD">
                      <?php
                if ($handle = opendir('MHUD/')) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
						?>
                        <option value="<?php echo $entry; ?>" <?php if(file_exists($wd_admin . 't' . $tier . '.json' && isset($Obj->MHUD))){$test = $Obj->MHUD; if($test == $entry){echo ' selected="selected"';}} ?>><?php echo $entry; ?></option>
                       <?php
                    }}}
                ?>
                      </select></th>
                  </tr>
                  <tr>
                    <th><b>Chat</b></th>
                    <th><select name="wd_chat">
                            <option value="No"<?php if(file_exists($wd_admin . 't' . $tier . '.json')){if(isset($Obj->wd_chat)){$test = $Obj->wd_chat; if($test == 'No'){echo ' selected="selected"';}}} ?>>No</option>
                            <option value="Yes"<?php if(file_exists($wd_admin . 't' . $tier . '.json')){if(isset($Obj->wd_chat)){$test = $Obj->wd_chat; if($test == 'Yes'){echo ' selected="selected"';}}} ?>>Yes</option>
                        </select></th>
                  </tr>
                </table>
              <br>
                <table>
					<caption>Apps</caption>
					<tr>
						<th><u>App</u></th>
						<th><u>Permission</u></th>
					</tr>
                <?php
                if ($handle = opendir('Apps/')) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
						?>
                            <tr>
                        <th><b><?php echo $entry; ?>: </b></th>
                        <th><select name="<?php echo $entry; ?>">
                            <option value="No"<?php if(file_exists($wd_admin . 't' . $tier . '.json')){if(isset($Obj->$entry)){$test = $Obj->$entry; if($test == 'No'){echo ' selected="selected"';}}} ?>>No</option>
                            <option value="Yes"<?php if(file_exists($wd_admin . 't' . $tier . '.json')){if(isset($Obj->$entry)){$test = $Obj->$entry; if($test == 'Yes'){echo ' selected="selected"';}}} ?>>Yes</option>
                        </select></th>
                        </tr>
                        <?php
                    }}}
                ?>
                </table>
                <br>
                <table>
					<caption>MyApps</caption>
					<tr>
						<th><u>App</u></th>
						<th><u>Permission</u></th>
					</tr>
                <?php
                if ($handle = opendir('MyApps/')) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
						?>
                            <tr>
                        <th><b><?php echo $entry; ?>: </b></th>
                        <th><select name="myApp_<?php echo $entry; $entry = 'myApp_' . $entry; ?>">
                            <option value="No"<?php if(file_exists($wd_admin . 't' . $tier . '.json')){if(isset($Obj->$entry)){$test = $Obj->$entry; if($test == 'No'){echo ' selected="selected"';}}} ?>>No</option>
                            <option value="Yes"<?php if(file_exists($wd_admin . 't' . $tier . '.json')){if(isset($Obj->$entry)){$test = $Obj->$entry; if($test == 'Yes'){echo ' selected="selected"';}}} ?>>Yes</option>
                        </select></th>
                        </tr>
                        <?php
                    }}}
                ?>
                </table>
                <!--<input type="hidden" name="Tier" value="<?php echo $tier; ?>">-->
                <br>
                <input type="submit" class="btn btn-success" value="Save">
            </form>
        </div>
    </div>
    <?php
}
    ?>
