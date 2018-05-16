<?php
session_start();
include("../testInput.php");
if ($_SESSION["Login"] != "YES") {
          session_destroy();
          header('Location: ../index.html');
        }
?>
