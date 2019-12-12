<?php
    require_once $_SERVER['DOCUMENT_ROOT']."/init.php";
    
    if(isset($_GET["t"])) $tile = $_GET["t"];

    $array = json_decode(file_get_contents("http://bga.rf.gd/data/resource_field_types.json"), true);

    echo json_encode($array[$tile]);
?>
