<?php
    session_start();
    if(!isset($_SESSION["isLoggedIn"])) die("gatya = (");
    $_SESSION["selectedIndex"] = $_POST["index"];
?>