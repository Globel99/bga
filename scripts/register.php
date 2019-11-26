<?php
    include "db_connect.php";

    $username = $_POST["username"];
    $pw = $_POST["pw"];

    $hashed_password = password_hash($pw, PASSWORD_DEFAULT);

    $conn = new mysqli($host, $user, $db_password, $db_name);

    if(!$conn) echo "connection failed";
    else{

        $sql = "INSERT INTO users (username, pw)
        VALUES ('$username', '$hashed_password')";

        if(mysqli_query($conn, $sql)) {
            echo "registration successful";
        }else echo "username already exists";
    }

    mysqli_close($conn);
?>