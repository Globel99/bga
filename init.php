<?php
    session_start();
    if(!isset($_SESSION["isLoggedIn"])) die("gatya = (");
    file_get_contents("http://bga.rf.gd/scripts/event_list.php");
    require_once "scripts/db_connect.php";
    $tile = $_SESSION["tiles"][$_SESSION["selectedIndex"]];
?>