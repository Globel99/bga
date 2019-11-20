<?php
    include "db_connect.php";

    session_start();
    if(!isset($_SESSION["isLoggedIn"])) die("gatya = (");
    $val = $_POST["name"];
    $current = $_SESSION["tiles"][$_SESSION["selectedIndex"]];

    $sql = "update villages set name = '".$val."' where tile = ".$current;
    $result= mysqli_query($conn, $sql);

    $_SESSION["villageNames"][$_SESSION["selectedIndex"]] = $val;
?>