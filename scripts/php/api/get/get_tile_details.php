<?php
    include $_SERVER['DOCUMENT_ROOT'].'/scripts/db_connect.php';

    $tile = intval($_GET["tile"]);

    $sql = "select * from villages where tile = ".$tile;
    $result = mysqli_query($GLOBALS["conn"], $sql);
    
    $layer = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/data/layer_array_data.json'));
    $backg = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/data/backg_array_data.json'));
    $resources = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/data/resource_field_types.json'));
    $array["tile"] = $tile;

    if($row = mysqli_fetch_assoc($result))
    {
        //$array["type"] = "user";
        $array["username"] = $row["username"];
        $array["villageName"] = $row["name"];
    }else if($layer[$tile] == 2)
    {
        $array["type"] = "forest";
    }else if($backg[$tile] == 255)
    {
        $array["type"] = "water";
    }else if($backg[$tile] == 0)
    {
        $array["type"] = "land";
    }else
    {
        $array["type"] = "coast";
    }

    $counts = array_count_values($resources[$tile]);
    $array["land"] = "wheat: ".$counts[0]."f";
    echo json_encode($array);
?>