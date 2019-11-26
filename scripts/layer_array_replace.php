<?php
if($_GET["pw"] == "szkuvi")
{
    $decoded = json_decode(file_get_contents("http://bga.rf.gd/data/layer_array_data.json"));

    $decoded[intval($_GET["rep"])] = intval($_GET["with"]);
    
    $encoded = json_encode($decoded);
    
    file_put_contents($_SERVER['DOCUMENT_ROOT']."/data/layer_array_data.json", $encoded);
}
?>