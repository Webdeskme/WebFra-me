<?php
if(isset($_GET['title'])){
	$title = test_input($_GET['title']);
	$tentry = test_input($_GET['entry']);
	$dir = test_input($_GET['dir']);
	$newEntry = explode(".", $tentry);
	if($newEntry[1] == 'jpg' ||  $newEntry[1] == 'png' ||  $newEntry[1] == 'jpeg' ||  $newEntry[1] == 'tif'){
                            $image = $wd_file . $title;
                            //Read image path, convert to base64 encoding
                           //$imageData = base64_encode(file_get_contents($image));
                           // Format the image SRC:  data:{mime};base64,{data};
                           //$src = 'data: '.mime_content_type($image).';base64,'.$imageData;
	//file_put_contents($wd_adminFile . 'back.txt', $src);
	copy($image, 'back.jpg');
	wd_head($wd_type, $wd_app, 'start.php', '&wd_as=Your desktop image has been changed.');
}
else{
	wd_head($wd_type, $wd_app, 'start.php', '&wd_ad=Sory your selction is not a suported image. You desktop did not change.');
}
}
else{
	wd_head($wd_type, $wd_app, 'start.php', '&title=' . $title . '&dir=' . $dir . '$entry=' . $tentry . '&wd_ad=Sory no changes were made.');
}
?>
