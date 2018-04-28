<?php 
$content = test_input($_POST['content']);
//$content = $_POST['content'];
$title = test_input($_POST['title']);
$file = $wd_file . $title . '.wd_writer';
$f = fopen($file, "w");
    fwrite($f, $content);
    fclose($f);
    $date = date("F j, Y, g:i a");
wd_head($wd_type, 'Writer', 'start.php', '&title=' . $title . '&date=' . $date . '&wd_as=Saved!');
//echo $wd_head;
//echo 'bob: ' . $content . $title;
//header('Location: ' . $wd_head);
?>
