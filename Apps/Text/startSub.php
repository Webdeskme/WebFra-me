<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; }
    $title = test_input($_POST["title"]);
    $text = htmlspecialchars_decode($_POST["text"], ENT_QUOTES);
    file_put_contents($wd_file . $title, $text);
    wd_head($wd_type, $wd_app, 'start.php', '&title=' . $title);
?>
