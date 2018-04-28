<?php

if(isset($_GET['title'])){$title = test_input($_GET['title']); file_put_contents($wd_type . '/'. $wd_app . '/view.html', file_get_contents($wd_file . $title)); $_POST['url'] = $wd_type . '/' . $wd_app . '/view.html';}
if(isset($_POST['url'])){$url = test_input($_POST['url']);}
else{$url = "https://duckduckgo.com/";}
?>
<form method="POST" action="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>" style="float: left;">
Browser 
<input type="text" name="url" value="<?php echo $url; ?>" placeholder="URL">
<input type="submit" value="GO">
Not all	websites will allow this browser to work properly.
</form>
<form method="POST" action="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>" style="float: right;">
<select name="url">
<?php
if ($handle = opendir('../../webdesk/User/' . $_SESSION["user"] . '/Web/')) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
                $url2 = file_get_contents('../../webdesk/User/' . $_SESSION["user"] . '/Web/' . $entry);
                $arr = parse_url($url2);
                $host = explode('.', $arr["host"]);
                if(isset($host[2])){
                $host = $host[1];
                }
                else{
                $host = $host[0];
                }
                //$host = preg_replace('/^www\./', '', $arr["host"]);
                //$host = basename($host, ".com");
                $ico = $arr["scheme"] . '://' . $arr["host"] . '/favicon.ico';
                ?>
        <option value="<?php echo $url2; ?>"><?php if(strlen($host) > 12){echo substr($host,0,12);} else{echo $host;} ?></option>
                <?php
                    }
                }
                closedir($handle);
                }
?>
</select>
<input type="submit" value="GO">
</form>
<iframe src="<?php echo $url; ?>" width="100%" height="100%"></iframe>