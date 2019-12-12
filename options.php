<?php
file_get_contents("http://bga.rf.gd/scripts/event_list.php");
session_start();
if(!isset($_SESSION["isLoggedIn"])) die("gatya = (");
require "scripts/db_connect.php";
$current_tile = $_SESSION["tiles"][$_GET["t"]];
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/basic.css">
        <link rel="stylesheet" type="text/css" href="styles/header.css">
        <link rel="stylesheet" type="text/css" href="styles/scoreboard.css">
    </head>
    <body>
        <?php include "header.php"; echo $header;?>
        <div id="main">
            Itt lesznek majd mindenféle fasza beállítások... Pl: account törlése
        </div>
    </body>
</html>