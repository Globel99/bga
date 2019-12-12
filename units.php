<?php
    session_start();
    if(!isset($_SESSION["isLoggedIn"])) die("gatya = (");
    require_once $_SERVER['DOCUMENT_ROOT'].'/scripts/db_connect.php';
    file_get_contents("http://bga.rf.gd/scripts/event_list.php");
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/basic.css">
        <link rel="stylesheet" type="text/css" href="styles/header.css">
        <link rel="stylesheet" type="text/css" href="styles/scoreboard.css">
    </head>
    <body>
        <?php include "header.php"; echo $header;?>
        <div id="main">
            <div>
                <h2>Home Units:</h2>
            </div>
            <?php
                $tile = $_SESSION["tiles"];
                $citiesNumber = count($tile,COUNT_NORMAL);

                echo "<div>";
                echo "<div id='tableHeader'>City Name</div><div id='tableHeader'>Name</div><div id='tableHeader'>Number</div><div id='tableHeader'>Level</div>";
                echo "</div>";

                for($i = 0; $i < $citiesNumber; $i++) {
                    $sql = "SELECT home_units.name, home_units.number, home_units.level, villages.name AS village FROM home_units LEFT OUTER JOIN villages ON villages.tile = home_units.tile WHERE home_units.tile = ".$tile[$i];
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result))
                    {
                        echo "<div>";
                        echo "<div>".$row["village"]."</div>"."<div>".$row["name"]."</div>"."<div>".$row["number"]."</div>"."<div>".$row["level"]."</div>";
                        echo "</div>";
                    }
                }
            ?>
            <div>
                <h2>Moving Units:</h2>
            </div>
            <?php
                echo "<div>";
                echo "<div id='tableHeader'>City Name</div><div id='tableHeader'>Name</div><div id='tableHeader'>Number</div><div id='tableHeader'>Level</div>";
                echo "</div>";

                for($i = 0; $i < $citiesNumber; $i++) {
                    $sql = "SELECT moving_units.name, moving_units.number, moving_units.level, villages.name AS village FROM moving_units LEFT OUTER JOIN villages ON villages.tile = moving_units.tile WHERE moving_units.tile = ".$tile[$i];
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result))
                    {
                        echo "<div>";
                        echo "<div>".$row["village"]."<div>".$row["name"]."</div>"."<div>".$row["number"]."</div>"."<div>".$row["level"]."</div>";
                        echo "</div>";
                    }
                }
            ?>
        </div>
    </body>
</html>