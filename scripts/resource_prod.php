<?php
    include "db_connect.php";
    include $_SERVER['DOCUMENT_ROOT'].'/scripts/php/logger.php';

    $sql = "update resources set wood = wood + wood_prod, wheat = wheat + wheat_prod, stone = stone + stone_prod";
    //$result = mysqli_query($conn, $sql);
    if(mysqli_query($conn, $sql)) {
        $message = date("Y.m.d") . " " . date("h:i:sa") . " " . "resource_prod.php process did it's job\n";
        writeLog("PROCESSOR", $message);
    } else { 
        $message= date("Y.m.d") . " " . date("h:i:sa") . " " . "resource_prod.php process thrown an error... SORT IT OUT FAST!\n";
        writeLog("ERROR", $message);
}
?>