<?php
    session_start();
    if(!isset($_SESSION["isLoggedIn"])) die("gatya = (");
    file_get_contents("http://bga.rf.gd/scripts/event_list.php");
    require $_SERVER['DOCUMENT_ROOT'].'/scripts/db_connect.php';
?>


<html>
<head>
    <script type="text/javascript" src="http://bga.rf.gd/scripts/js/simple_request.js"></script>
    <script type="text/javascript" src="http://bga.rf.gd/buildings/scripts/js/empty.js"></script>
    <link rel="stylesheet" type="text/css" href="http://bga.rf.gd/styles/basic.css">
    <link rel="stylesheet" type="text/css" href="http://bga.rf.gd/styles/header.css">
</head>
<body>
</body>
    <?php include $_SERVER['DOCUMENT_ROOT']."/header.php"; echo $header;?>
    <div><h1>Empty place</h1><div>

    <?php
    /*     
        $sql = "select * from buildings where tile = ".$_SESSION["tiles"][$_SESSION["selectedIndex"]]." and building = 'Town hall'";

        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $level = $row["level"];

        $obj = json_decode(file_get_contents("town_hall.json"), true);*/
    ?>

    <div><h3>New building options:</h3></div>
    <?php
        $i = 0;
        $buildingsArr = json_decode(file_get_contents("json/buildings.json"));
        while(isset($buildingsArr[$i]))
        {
            if(!isset($_SESSION["buildings"]) || !in_array($buildingsArr[$i], $_SESSION["buildings"]))
            {
                $name = str_replace("_", " ", $buildingsArr[$i]);
                $name = ucfirst($name);
    
                echo "<div onclick='build(this.innerText, ".$_GET["p"].");'>".$name."</div>";
            }

            $i++;
        }
    ?>
</html>
<?php
    echo "<br><br>";
    var_dump($_SESSION["buildings"]);
?>
