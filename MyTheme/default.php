<?php
session_start();
header("Content-type: text/css; charset: UTF-8");
?>
        html{
            height: 100%;
            padding: 0px;
            margin: 0px;
        }
        body{
            height: 100%;
            padding: 0px;
            margin: 0px;
        }
        div.tab{
            background-color: <?php 
if(file_exists('../../../webdesk/User/' . $_SESSION["user"] . '/Admin/Pcolor.txt')){ 
    $pcolor = file_get_contents('../../../webdesk/User/' . $_SESSION["user"] . '/Admin/Pcolor.txt');
    echo $pcolor;
}
else{
    echo '#FFFFFF';
}
?>;
<?php if(!isset($_SESSION["wd_fullscreen"]) || $_SESSION["wd_fullscreen"] != 'on'){ 
            echo 'height: 80%;
            width: 94%;';
}
else{ 
           echo 'height: 95%; 
            width: 100%;';
 }
?>
            padding: 0px;
            margin: 0px;
            overflow-y: auto;
            position: absolute;
            left: 0px;
            top: 0px;
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            -o-border-radius: 10px;
            -ms-border-radius: 10px;
            -khtml-border-radius: 10px;
            border-radius: 10px;
        }
         div.con{
            height: 100%;
            padding: 0px;
            margin: 0px;
            /*background-image: url('back.jpg');*/
        }
        figure{
            padding: 10px;
        }
        
  
#wd_tabs {
    position: absolute;
    bottom: 0;
    width: 100%;
    z-index: 100;
}

.chat {
    position: absolute;
    right: 0px;
    bottom: 50px;
    z-index: 100;
    width: 50%;
    height: 50%;
    background-color: #000000;
    color: #ffffff;
    overflow-y: scroll;
}
.center {
    margin: auto;
    width: 50%;
    border: 3px solid green;
    padding: 10px;
}