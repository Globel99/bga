<?php
    include "db_connect.php";

    $username = $_POST["username"];
    $pw = $_POST["pw"];

    $conn = new mysqli($host, $user, $db_password, $db_name);

    if(!$conn) echo "connection failed";
    else{

        $sql = "INSERT INTO users (username, pw)
        VALUES ('$username', '$pw')";

        if(mysqli_query($conn, $sql)) {
            echo "registration successful";
        }else echo "username already exists";
    }

    mysqli_close($conn);
?>