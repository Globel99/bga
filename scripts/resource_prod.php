<?php
include "db_connect.php";

$sql = "update resources set wood = wood + wood_prod, wheat = wheat + wheat_prod, stone = stone + stone_prod";
$result = mysqli_query($conn, $sql);
?>