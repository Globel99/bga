<?php
    include "scripts/db_connect.php";
    $sql = "insert into users values ('".$_POST['fname']."','123')";

    $result = mysqli_query($conn, $sql);

?>