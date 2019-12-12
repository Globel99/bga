<?php
    session_start();
    if(!isset($_SESSION["isLoggedIn"])) die("gatya");
    require_once $_SERVER['DOCUMENT_ROOT'].'/scripts/db_connect.php';
    file_get_contents("http://bga.rf.gd/scripts/event_list.php");

    $username = $_SESSION["username"];
    "\n";
    $tile = $_POST["tile"];
    "\n";

    $sql = "select * from events_buildings where tile = ".$_SESSION["tiles"][$_SESSION["selectedIndex"]];
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result))
        {
            $row = mysqli_fetch_assoc($result);
        }
    $queue = array(
        "building" => $row["building"],
         "finishTime" => $row["finishTime"]
    );
    echo json_encode($queue);
?>