<html>
<?php
$start_time = microtime(true);
$GLOBALS["n"] = 0;

require_once $_SERVER['DOCUMENT_ROOT'].'/scripts/db_connect.php';

$sql = "select * from all_events where finishTime <= addtime(current_timestamp(), '5:58:22')";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result))
{
    while($row = mysqli_fetch_assoc($result))
    {
        if($row["type"] == "building") {
            addQuery($row["id"]);
        }
    }
}//else //"<script>console.log('event_list.php active');</script>";


function addQuery($id)
{
    echo "addQuery";
    $GLOBALS["n"] = $GLOBALS["n"]+1;
    $level = "(select level from events_buildings where eventID = ".$id.")";
    $tile = "(select tile from events_buildings where eventID = ".$id.")";
    $building = "(select building from events_buildings where eventID = ".$id.")";
    
    $sql = "update buildings set level = ".$level.
    " where tile = ".$tile." and building = ".$building.";";
    
    $sql .= "delete from events_buildings where eventID = ".$id.";";
    $sql .= "delete from all_events where id = ".$id.";";

    mysqli_multi_query($GLOBALS["conn"], $sql);

    //echo "<script>console.log('building event has been finished - ".$sql."');</script>";
    mysqli_close($GLOBALS["conn"]);
}
echo "end of event_list.php";

$exec_time = (microtime(true) - $start_time);
if($GLOBALS["n"] > 0)
{
    require_once "php/logger.php";
    $message = date("Y.m.d") . " " . date("h:i:sa") . " event_list.php ex. time: ".round(($exec_time*1000))."ms";
    $message .= " - while done ".$GLOBALS["n"]." query\n";
    writeLog("PROCESSOR", $message);
}
?>
</html>