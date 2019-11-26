<?php
    session_start();
    if(!isset($_SESSION["isLoggedIn"])) die("gatya = (");
    file_get_contents("http://bga.rf.gd/scripts/event_list.php");
    include $_SERVER['DOCUMENT_ROOT'].'/scripts/db_connect.php';
?>


<html>
<head>
    <script type="text/javascript" src="http://bga.rf.gd/scripts/js/simple_request.js"></script>
    <script type="text/javascript" src="http://bga.rf.gd/buildings/scripts/js/town_hall.js"></script>
    <link rel="stylesheet" type="text/css" href="http://bga.rf.gd/styles/basic.css">
    <link rel="stylesheet" type="text/css" href="http://bga.rf.gd/styles/header.css">
    <link rel="stylesheet" type="text/css" href="http://bga.rf.gd/buildings/styles/basic.css">
</head>
<body>
</body>
    <?php
        include $_SERVER['DOCUMENT_ROOT']."/header.php";
        echo $header;
        $building = basename(__FILE__, ".php");
        require_once "building_template.php";
    ?>

</html>