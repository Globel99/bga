<?php
    include "scripts/db_connect.php";
    $sql = "update resources set wood = 96969 where tile = ".intval($_POST["t"]);

    $result = mysqli_query($conn, $sql);
    echo "ok";
?>