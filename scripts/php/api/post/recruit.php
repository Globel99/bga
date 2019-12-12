<?php

session_start();
    if(!isset($_SESSION["isLoggedIn"])) die("gatya");
    require_once $_SERVER['DOCUMENT_ROOT'].'/scripts/db_connect.php';
    file_get_contents("http://bga.rf.gd/scripts/event_list.php");

    echo $username = $_SESSION["username"];
    echo $tile = $_SESSION["tiles"][$_SESSION["selectedIndex"]];
    echo $type = $_POST["type"];
    echo $amount = intval($_POST["amount"]);

    $sql = "INSERT INTO home_units VALUES ($tile, ".$type.", $amount, 1)"; //A LEVEL átmenetileg 1 lesz a tesztelés kedvéért
    if(mysqli_num_rows(mysqli_query($conn, $sql)) != 0)
    {
       die("Something went wrong!"); 
    }
?>