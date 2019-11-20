<?php
    include $_SERVER['DOCUMENT_ROOT'].'/scripts/php/logger.php';

    $host = "sql109.epizy.com";
    $user = "epiz_24762160";
    $db_password = "JuItz7HcclcW";
    $db_name = "epiz_24762160_bga";

    $tile = $_POST["tile"];
    $amount = $_POST["amount"];
    $wood = $_POST["wood"];
    $wheat = $_POST["wheat"];
    $stone = $_POST["stone"];
    $slider = $_POST["slider"];

    $conn = new mysqli($host, $user, $db_password, $db_name);

    if(!$conn) echo "connection failed";
    else{
        if($slider == 1) {
            if($wood == 1) {
                $sql = "UPDATE resources SET wood = $amount WHERE tile = '$tile'";
            } else if($wheat == 1) {
                $sql = "UPDATE resources SET wheat = $amount WHERE tile = '$tile'";
            } else {
                $sql = "UPDATE resources SET stone = $amount WHERE tile = '$tile'";
            }
        } else if($slider == 2) {
            if($wood == 1) {
                $sql = "UPDATE resources SET wood_prod = $amount WHERE tile = '$tile'";
            } else if($wheat == 1) {
                $sql = "UPDATE resources SET wheat_prod = $amount WHERE tile = '$tile'";
            } else {
                $sql = "UPDATE resources SET stone_prod = $amount WHERE tile = '$tile'";
            }
        }
        if(mysqli_query($conn, $sql)) {
            $messageINFO = date("Y.m.d") . " " . date("h:i:sa") . " " . "Resource added via Cheats menu to $tile, amount is $amount\n";
            writeLog("INFO", $messageINFO);
        } else { 
            $messageERROR = date("Y.m.d") . " " . date("h:i:sa") . " " . "Error in resource addition via Cheats menu, some info: TILE: $tile | AMOUNT: $amount | WOOD: $wood | WHEAT: $wheat | STONE: $stone | SLIDER: $slider | SQL: $sql \n";
            writeLog("ERROR", $messageERROR);
        }
    }

    mysqli_close($conn);

?>