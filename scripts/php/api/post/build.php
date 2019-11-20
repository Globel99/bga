<?php
    session_start();
    if(!isset($_SESSION["isLoggedIn"])) die("gatya = (");
    file_get_contents("http://bga.rf.gd/scripts/event_list.php");
    include $_SERVER['DOCUMENT_ROOT'].'/scripts/db_connect.php';

    $json = json_decode(file_get_contents("http://bga.rf.gd/buildings/json/town_hall.json"), true);
    

    echo $username = $_POST["username"];
    echo "\n";
    echo $tile = $_POST["tile"];
    echo "\n";
    echo $building = $_POST["building"];
    echo "\n";
    echo $newLevel = 0;
    echo "\n";

    $sql = "select * from buildings where tile = $tile and building = '$building'";
    $result = mysqli_query($conn, $sql);
    if($row = mysqli_fetch_assoc($result))
    {
        $newLevel = intval($row["level"])+1;
    }else $newLevel = 1;

    $sql = "select * from resources where tile = $tile";
    $row = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    
    
    if($row["wood"] >= $json["wood"][$newLevel] && $row["wheat"] >= $json["wheat"][$newLevel] && $row["stone"] >= $json["stone"][$newLevel])
    {
        $time = $json["time"][$newLevel];

        $startTime = "addtime(CURRENT_TIMESTAMP(), '5:58:22')";
        $finishTime = "addtime($startTime, '3:0')";
        $maxID = "(select max(id) from all_events)";

        $sql = "insert into all_events (id, username, startTime, finishTime, type) values ($maxID+1, 'szkuvi', $startTime, $finishTime, 'building');";
        $sql .= "insert into events_buildings values ((select max(id) from (select * from all_events))+1, $tile, '$building', $newLevel);";
        echo "\n".$sql;
        if(mysqli_multi_query($conn, $sql)){
            echo "\nEvent - $building to lvl $newLevel at tile $tile - addet at all_events";



        }else echo "\nError: ".mysqli_error($conn);
    }else
    echo "\nnot enough resources";

    
?>