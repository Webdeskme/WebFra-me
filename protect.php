<?php
session_start();
header("X-Robots-Tag: noIndex, nofollow", true);
if ($_SESSION["Login"] != "YES") {
	  session_destroy();
          header('Location: index.php?test=bad');
        }
include("testInput.php");
include("function.php");
?>
