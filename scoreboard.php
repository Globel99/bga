<?php
file_get_contents("http://bga.rf.gd/scripts/event_list.php");
session_start();
if(!isset($_SESSION["isLoggedIn"])) die("gatya = (");
include "scripts/db_connect.php";
$current_tile = $_SESSION["tiles"][$_GET["t"]];
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/basic.css">
        <link rel="stylesheet" type="text/css" href="styles/header.css">
    </head>
    <body>
        <?php include "header.php"; echo $header;?>
        
    </body>
</html>