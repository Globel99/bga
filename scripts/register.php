<?php
    require "db_connect.php";
    include $_SERVER['DOCUMENT_ROOT'].'/scripts/php/logger.php';

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
            $message = date("Y.m.d") . " " . date("h:i:sa") . " " . "$username succesfully registrated\n";
            writeLog("INFO", $message);
        } else {
            echo "username already exists";
            $message = date("Y.m.d") . " " . date("h:i:sa") . " " . "$username's, registration was unsuccesful. Password: $hashed_password\n";
            writeLog("ERROR", $message);
        }
    }

    mysqli_close($conn);
?>