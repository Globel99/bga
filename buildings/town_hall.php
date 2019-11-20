<?php
    session_start();
    if(!isset($_SESSION["isLoggedIn"])) die("gatya = (");
    file_get_contents("http://bga.rf.gd/scripts/event_list.php");
    include $_SERVER['DOCUMENT_ROOT'].'/scripts/db_connect.php';
?>


<html>
<head>
    <link rel="stylesheet" type="text/css" href="http://bga.rf.gd/styles/basic.css">
    <link rel="stylesheet" type="text/css" href="http://bga.rf.gd/styles/header.css">
</head>
<body>
</body>
    <?php include $_SERVER['DOCUMENT_ROOT']."/header.php"; echo $header;?>
    <div><h1>Town Hall</h1><div>

    <?php        
        $sql = "select * from buildings where tile = ".$_SESSION["tiles"][$_SESSION["selectedIndex"]]." and building = 'Town hall'";

        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $level = $row["level"];

        $obj = json_decode(file_get_contents("town_hall.json"), true);
    ?>

    <div><h3>Level: <?php echo $level ?></h3></div>


</html>