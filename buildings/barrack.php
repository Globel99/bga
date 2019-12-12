<?php
    session_start();
    if(!isset($_SESSION["isLoggedIn"])) die("gatya = (");
    file_get_contents("http://bga.rf.gd/scripts/event_list.php");
    require $_SERVER['DOCUMENT_ROOT'].'/scripts/db_connect.php';
?>


<html>
<head>
    <script type="text/javascript" src="http://bga.rf.gd/scripts/js/simple_request.js"></script>
    <script type="text/javascript" src="http://bga.rf.gd/buildings/scripts/js/town_hall.js"></script>
    <script type="text/javascript" src="http://bga.rf.gd/buildings/scripts/js/barrack.js"></script>
    <link rel="stylesheet" type="text/css" href="http://bga.rf.gd/styles/basic.css">
    <link rel="stylesheet" type="text/css" href="http://bga.rf.gd/styles/header.css">
    <link rel="stylesheet" type="text/css" href="http://bga.rf.gd/buildings/styles/table.css">
    <link rel="stylesheet" type="text/css" href="http://bga.rf.gd/buildings/styles/basic.css">
</head>
    <?php
        include $_SERVER['DOCUMENT_ROOT']."/header.php";
        echo $header;
        $building = basename(__FILE__, ".php");
        require_once "building_template.php";
    ?>
    <body>
        <div>
            <h2>Units in this city's barack:</h2>
        </div>
        <div id="main">
            <?php
                echo "<div>";
                echo "<div id='tableHeader'>Name</div><div id='tableHeader'>Number</div><div id='tableHeader'>Level</div>";
                echo "</div>";

                $sql = "SELECT * FROM home_units WHERE tile = ".$_SESSION["tiles"][$_SESSION["selectedIndex"]];
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result))
                {
                    echo "<div>";
                    echo "<div>".$row["name"]."</div>"."<div>".$row["number"]."</div>"."<div>".$row["level"]."</div>";
                    echo "</div>";
                }
            ?>
        </div>
        <div id="form">
            <?php
                $i = 0;
                $unitTypes = json_decode(file_get_contents("http://bga.rf.gd/units/json/units.json"), true);
                echo 'Unit type: <select name="type" id="type" >';
                while(isset($unitTypes[$i])) {
                    echo "<script>console.log('Debug Objects:".$unitTypes[$i]."');</script>";
                    echo '<option value="'.$unitTypes[$i].'"</option>';
                    $i++;
                }
                echo '</select>';
                echo 'Amount: <input type="number" name="amount" id="amount">';
                echo '<br><button class="button" id="submit" onclick="submit()">Recruit</button>';
            ?>
        </div>
    </body>
</html>