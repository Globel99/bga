<html>
<head>
    <link rel="stylesheet" type="text/css" href="http://bga.rf.gd/styles/village.css">
</head>
<body>
</body>


    <?php
        session_start();
        if(!isset($_SESSION["isLoggedIn"])) die("gatya = (");
        file_get_contents("http://bga.rf.gd/scripts/event_list.php");
        include $_SERVER['DOCUMENT_ROOT'].'/scripts/db_connect.php';

        echo "Town hall of tile ".$_SESSION["tiles"][$_GET["t"]]."<br>";

        $sql = "select * from buildings where tile = ".$_SESSION["tiles"][$_GET["t"]];

        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        echo "level: ".$row["level"];
    ?>


</html>