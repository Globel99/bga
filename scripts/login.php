<?php
    include "db_connect.php";


    if(!$conn) echo "connection failed";
    else{

        $sql = "SELECT * from users WHERE username = '" . $_POST["username"] . "'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0) {
            $row  = mysqli_fetch_assoc($result);
            if($row["pw"] == $_POST["pw"])
            {
                session_start();
                session_regenerate_id();
                $_SESSION["isLoggedIn"] = true;
                $_SESSION["username"] = $_POST["username"];
                echo "ok";
            }
            
            else echo "password error";
        }else 
        echo "username error";
    }

    mysqli_close($conn);
?>