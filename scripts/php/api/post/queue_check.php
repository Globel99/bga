<?php
    session_start();
    if(!isset($_SESSION["isLoggedIn"]) || !isset($_POST["tile"])) die("gatya");
    require_once $_SERVER['DOCUMENT_ROOT'].'/scripts/db_connect.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/scripts/db_connect.php';
    file_get_contents("http://bga.rf.gd/scripts/event_list.php");

    /*echo */$tile = $_SESSION["tiles"][$_SESSION["selectedIndex"]];
    //echo "\n";

    $sql = "select * from events_buildings where tile = ".$tile;
    if(mysqli_num_rows(mysqli_query($conn, $sql))>0){
        echo "busy";
    }else echo "free";
?>