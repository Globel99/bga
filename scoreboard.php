<?php
file_get_contents("http://bga.rf.gd/scripts/event_list.php");
session_start();
if(!isset($_SESSION["isLoggedIn"])) die("gatya = (");
include "scripts/db_connect.php";
$current_tile = $_SESSION["tiles"][$_GET["t"]];
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
            <?php
                echo "<div>";
                echo "<div id='tableHeader'>Tile</div><div id='tableHeader'>Player</div><div id='tableHeader'>Village name</div>";
                echo "</div>";

                $sql = "select * from villages order by username";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result))
                {
                    $y = intval($row["tile"]/64);
                    $x = $row["tile"]-($y)*64;
                    $y++; $x++;
                    echo "<div>";
                    echo "<div>(".$x.", ".$y.")</div>"."<div>".$row["username"]."</div>"."<div>".$row["name"]."</div>";
                    echo "</div>";
                }
            ?>
        </div>
    </body>
</html>