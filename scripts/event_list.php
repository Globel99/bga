<?php
include "db_connect.php";

$sql = "select * from all_events where finishTime <= addtime(current_timestamp(), '5:58:0')";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result))
{
    while($row = mysqli_fetch_assoc($result))
    {
        if($row["type"] == "building") events_buildings($row["id"], $conn);
        echo "row";
    }
}else echo "no events in queue";


function events_buildings($id, $conn_inner)
{
    $sql = "select * from events_buildings where eventID = ".$id;
    $result2 = mysqli_query($conn_inner, $sql);

    while($row2 = mysqli_fetch_assoc($result2))
    {
        $sql = "update buildings set level = ".$row2["level"].
        " where tile = ".$row2["tile"]." and building = '".$row2["building"]."'";
        $result3 = mysqli_query($conn_inner, $sql);
    }
    echo "<b>building</b> event has been finished <i>- ".$sql."</i><br>";

    
    $sql = "delete from events_buildings where eventID = ".$id;
    mysqli_query($conn_inner, $sql);
    
    $sql= "delete from all_events where id = ".$id;
    mysqli_query($conn_inner, $sql);
}
?>