<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
if(isset($_GET['title'])){
    $title1 = test_input($_GET['title']);
}
else{
    $title1 = "";
}
if(isset($_GET['dir'])){
    $dir1 = test_input($_GET['dir']);
}
else{
    $dir1 = "";
}
if(isset($_GET['entry'])){
    $Uentry1 = test_input($_GET['entry']);
}
else{
    $Uentry1 = "";
}
?>
<a href="<?php wd_url('Apps', 'Files', 'start.php', '&prog=' . $wd_app . '&ptype=' . $wd_type . '&psec=start.php'); ?>">Open File</a> | <a href="<?php wd_url('Apps', 'Files', 'start.php', '&prog=' . $wd_app . '&ptype=' . $wd_type . '&psec=start.php&pb=View Slide Show'); ?>">Set Slide Show</a> | <a href="<?php wd_urlSub($wd_type, $wd_app, 'viewerSub.php', '&title=' . $title1 . '&dir=' . $dir1 . '&entry=' . $Uentry1); ?>">Make Desktop Background if suported image.</a><br>
<?php
if(!isset($_GET['pb'])){
if(isset($_GET['title'])){
    $title = test_input($_GET['title']);
}
else{
    $title = "";
}
if(isset($_GET['dir'])){
    $dir = test_input($_GET['dir']);
}
else{
    $dir = "";
}
if(isset($_GET['entry'])){
    $Uentry = test_input($_GET['entry']);
}
else{
    $Uentry = "";
}
If(isset($_GET['title'])){
$file = $wd_file . $title;
$ext = pathinfo($file, PATHINFO_EXTENSION);
        $ext = strtolower($ext);
$folder = file_get_contents($wd_adminFile . 'oid.txt');
$temp = 'web/' . $folder . '/' . $Uentry;
copy($file,  $temp);
if($ext == "mp3"){
            ?>
            <audio controls><source src="<?php echo $temp;?>" type="audio/mpeg" style="max-width: 100%; max-height: 100%;" align="middle">Your Brouser does not support the audio option.</audio>
            <?php
        }
        elseif($ext == "mp4"){
            ?>
            <video controls style="max-width: 100%; max-height: 100%;" align="middle"><source src="<?php echo $temp;?>" type="video/mp4">Your Brouser does not support the video option.</video>
            <?php
        }
        elseif($ext == "wav"){
            ?>
            <audio controls style="max-width: 100%; max-height: 100%;" align="middle"><source src="<?php echo $temp;?>" type="audio/wav">Your Brouser does not support the audio option.</audio>
            <?php
        }
        elseif($ext == "m4a"){
            ?>
            <video controls style="max-width: 100%; max-height: 100%;" align="middle"><source src="<?php echo $temp;?>" type="audio/mp4">Your Brouser does not support the video option.</video>
            <?php
        }
        elseif($ext == "ogg"){
            ?>
            <video controls style="max-width: 100%; max-height: 100%;" align="middle"><source src="<?php echo $temp;?>" type="video/ogg">Your Brouser does not support the video option.</video>
            <?php
        }
        elseif($ext == "webm"){
            ?>
            <video controls style="max-width: 100%; max-height: 100%;" align="middle"><source src="<?php echo $temp;?>" type="video/webm">Your Brouser does not support the video option.</video>
            <?php
        }
        elseif($ext == "mov"){
            ?>
            <video controls style="max-width: 100%; max-height: 100%;" align="middle"><source src="<?php echo $temp;?>">Your Brouser does not support the video option.</video>
	    <?php
        }
        elseif($ext == "jpeg"){
            ?>
            <img src="<?php echo $temp;?>" alt="<?php echo $title;?>" style="max-width: 100%; max-height: 100%;" align="middle">
            <?php
        }
        elseif($ext == "gif"){
            ?>
            <img src="<?php echo $temp;?>" alt="<?php echo $title;?>" style="max-width: 100%; max-height: 100%;" align="middle">
            <?php
        }
        elseif($ext == "png"){
            ?>
            <img src="<?php echo $temp;?>" alt="<?php echo $title;?>" style="max-width: 100%; max-height: 100%;" align="middle">
            <?php
        }
        elseif($ext == "jpg"){
            ?>
            <img src="<?php echo $temp;?>" alt="<?php echo $title;?>" style="max-width: 100%; max-height: 100%;" align="middle">
            <?php
        }
        elseif($ext == "pdf"){
            ?>
            <iframe src="<?php echo $temp;?>" width="100%" height="100%" align="middle"></iframe>
            <?php
        }
        elseif($ext == "epub"){
          ?>
          <iframe src="<?php echo $wd_type . '/' . $wd_app .  '/epub.js-master/reader/index.php?epub=' . $temp;?>" width="100%" height="100%" align="middle"></iframe>
<?php
        }
        else{
            ?>
            <iframe src="<?php echo $temp;?>" width="100%" height="100%" align="middle"></iframe>
            <?php
        }

      // unlink($temp);
}
}
else{
$pb = test_input($_GET['pb']);
$folder = $wd_file . $pb;

        ?>
<style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 70%;
      margin: auto;
  }
  .fullscreen {
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 9999;
  margin: 0;
  padding: 0;
  background: inherit;
}
.modal-dialog {
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
}

.modal-content {
  height: auto;
  min-height: 100%;
  border-radius: 0;
}
  </style>
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Fullscreen</button>
<br>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <?php
      $x = -1;
      if ($handle = opendir($folder)) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
                        $newEntry = explode(".", $entry);
                        if(isset($newEntry[1])){
                        if($newEntry[1] == 'jpg' ||  $newEntry[1] == 'png' ||  $newEntry[1] == 'jpeg' ||  $newEntry[1] == 'tif'){
                            $x = $x + 1;
      ?>
      <li data-target="#myCarousel" data-slide-to="<?php echo $x; ?>"<?php if($x === 0){ echo ' class="active"';} ?>></li>
      <?php
      }}}}}
      ?>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
    <?php
      $x = -1;
      if ($handle = opendir($folder)) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
                        $newEntry = explode(".", $entry);
                        if(isset($newEntry[1])){
                        if($newEntry[1] == 'jpg' ||  $newEntry[1] == 'png' ||  $newEntry[1] == 'jpeg' ||  $newEntry[1] == 'tif'){
                            $x = $x + 1;
                            $image = $folder . $entry;
                            //Read image path, convert to base64 encoding
                           $imageData = base64_encode(file_get_contents($image));
                           // Format the image SRC:  data:{mime};base64,{data};
                           $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
      ?>
      <div<?php if($x == 0){ echo ' class="item active"'; } else{ echo ' class="item"'; } ?>>
        <img src="<?php echo $src; ?>" alt="<?php echo $entry; ?>" style="max-width: 100%; max-height: 100%;">
      </div>
      <?php
      }}}}}
      ?>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
<?php
}
?>

<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Slide Show: <?php echo $pb; ?></h4>
        </div>
        <div class="modal-body">
          <div id="myCarouselF" class="carousel slide" data-ride="carousel">
    <!-- Indicators
    <ol>
      <?php
      $x = -1;
      if ($handle = opendir($folder)) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
                        $newEntry = explode(".", $entry);
                        if($newEntry[1] == 'jpg' ||  $newEntry[1] == 'png' ||  $newEntry[1] == 'jpeg' ||  $newEntry[1] == 'tif'){
                            $x = $x + 1;
      ?>
      <li data-target="#myCarouselF" data-slide-to="<?php echo $x; ?>"<?php if($x === 0){ echo ' class="active"';} ?>></li>
      <?php
      }}}}
      ?>
    </ol>-->

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
    <?php
      $x = -1;
      if ($handle = opendir($folder)) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
                        $newEntry = explode(".", $entry);
                        if($newEntry[1] == 'jpg' ||  $newEntry[1] == 'png' ||  $newEntry[1] == 'jpeg' ||  $newEntry[1] == 'tif'){
                            $x = $x + 1;
                            $image = $folder . $entry;
                            //Read image path, convert to base64 encoding
                           $imageData = base64_encode(file_get_contents($image));
                           // Format the image SRC:  data:{mime};base64,{data};
                           $src = 'data: '.mime_content_type($image).';base64,'.$imageData;
      ?>
      <div<?php if($x == 0){ echo ' class="item active"'; } else{ echo ' class="item"'; } ?>>
        <img src="<?php echo $src; ?>" alt="<?php echo $entry; ?>" style="max-width: 100%; max-height: 100%;">
      </div>
      <?php
      }}}}
      ?>
    </div>
    <!-- Left and right controls
    <a class="left carousel-control" href="#myCarouselF" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarouselF" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>-->
  </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
<script>
    $("audio").show();
  </script>
