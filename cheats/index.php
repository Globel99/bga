<?php
    $host = "sql109.epizy.com";
    $user = "epiz_24762160";
    $db_password = "JuItz7HcclcW";
    $db_name = "epiz_24762160_bga";
    $conn = new mysqli($host, $user, $db_password, $db_name);
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="http://bga.rf.gd/cheats/basic.css">
        <link rel="stylesheet" type="text/css" href="http://bga.rf.gd/cheats/cheats.css">
        <link href='https://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet'>
        <script type="text/javascript" src="http://bga.rf.gd/cheats/cheats.js"></script>
    </head>
    <body>
        <div class="title">
            <h1 id="titleInner">Cheats</h1>
        </div>
        <div id="main">
            <?php
                echo "<div>";
                echo "<div id='tableHeader'>Tile</div><div id='tableHeader'>Player</div><div id='tableHeader'>Village name</div><div id='tableHeader'>Wood</div><div id='tableHeader'>Wood Production</div><div id='tableHeader'>Wheat</div><div id='tableHeader'>Wheat Production</div><div id='tableHeader'>Stone</div><div id='tableHeader'>Stone Production</div>";
                echo "</div>";

                $sql = "SELECT * FROM resources RIGHT OUTER JOIN villages ON villages.tile = resources.tile ORDER BY username;";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result))
                {
                    $y = intval($row["tile"]/64);
                    $x = $row["tile"]-($y)*64;
                    $y++; $x++;
                    echo "<div>";
                    echo "<div>(".$x.", ".$y.")</div>"."<div>".$row["username"]."</div>"."<div>".$row["name"]."</div>"."<div>".$row["wood"]."</div>"."<div>".$row["wood_prod"]."</div>"."<div>".$row["wheat"]."</div>"."<div>".$row["wheat_prod"]."</div>"."<div>".$row["stone"]."</div>"."<div>".$row["stone_prod"]."</div>";
                    echo "</div>";
                }
            ?>
        </div>
        <div id="form">
            <?php
                $sql2 = "SELECT * FROM resources RIGHT OUTER JOIN villages ON villages.tile = resources.tile ORDER BY username;";
                $result2 = mysqli_query($conn, $sql2);
                echo 'City: <select class="custom-select" name="city" id="city" >';
                while($row = mysqli_fetch_assoc($result2))
                {
                    $y = intval($row["tile"]/64);
                    $x = $row["tile"]-($y)*64;
                    $y++; $x++;
                    echo '<option value="'.$row["tile"].'"> '.$row["username"].' | '.$x.', '.$y.' | '.$row["name"].'</option>';
                }
                echo '</select>';
                echo '<br>Amount: <input type="number" name="amount" id="amount">';
                echo '<br><input type="radio" class="container" name="resourceType" value="wood" id="wood" checked> Wood | <input type="radio" class="container" name="resourceType" value="wheat" id="wheat"> Wheat | <input type="radio" class="container" name="resourceType" value="stone" id="stone"> Stone';
                echo '<br> Resource <input id="slider" type="range" class="slider" min="1" max="2" value="1" onchange="changeSlider()"> Production';
                echo '<br><button class="button" id="button" onclick="submit()" style="vertical-align:middle"><span>Change</span></button>';
            ?>
        </div>
    </body>
</html>