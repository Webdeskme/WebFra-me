<h1>Web</h1>
    <form method="post" action="webSubAdd.php">
        <iframe src="http://duckduckgo.com/search.html?prefill=Search The Web&kn=1&kf=fw&kz=1&kp=1&kh=1&kg=p" style="overflow:hidden;margin:0;padding:0;width:408px;height:40px;" frameborder="0">Your browser boes not support iframes.</iframe><br>
        <label for="add">Add Website: </label>
        <input type="text" name="add" id="add" placeholder="http://www.something.com" title="http://www.something.com" required>
        <input type="submit" value="add">
    </form><br><hr><br>
    <div>
        <?php
        if ($handle = opendir($wd_root . '/User/' . $_SESSION["user"] . '/Web/')) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
                $url = file_get_contents($wd_root . '/User/' . $_SESSION["user"] . '/Web/' . $entry);
                $arr = parse_url($url);
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
        <figure style="float: left;">
                <figcaption style="text-align: center;"><a style="font-size: 1.2em;" href="<?php echo $url; ?>" target="_blank" title="<?php echo $url; ?>" style="font-size: 0.5em;"><?php if(strlen($host) > 12){echo substr($host,0,12);} else{echo $host;} ?></a></figcaption>
                <a href="<?php echo $url; ?>" target="_blank" title = "<?php echo $url; ?>" style="text-align: center;"><img src="<?php echo $ico; ?>" style="display: block; height: 50px; width: 50px; margin: 2px; padding: 2px;"></a>
                <figcaption style="text-align: center;"><a href="webSubDelete.php?id=<?php echo basename($entry, '.txt'); ?>" class="text-danger" style="font-size: 1em;">remove</a></figcaption>
        </figure>
                <?php
                    }
                }
                closedir($handle);
                }
                ?>
    </div>
