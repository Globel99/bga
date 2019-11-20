<?php
file_get_contents("http://bga.rf.gd/scripts/event_list.php");
session_start();
if(!isset($_SESSION["isLoggedIn"])) die("gatya = (");
include "scripts/db_connect.php";
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=0.4, maximum-scale=1, user-scalable=0"/> <!--320-->
    <meta charset="utf-8">
    <script type="text/javascript" src="scripts/countdown.js"></script>
    <script type="text/javascript" src="scripts/village.js"></script>
    <link rel="stylesheet" type="text/css" href="styles/basic.css">
    <link rel="stylesheet" type="text/css" href="styles/village.css">
    <link rel="stylesheet" type="text/css" href="styles/header.css">
</head>
<body>
    <?php include "header.php"; echo $header;?>
    <div id="container">
    <div id="main">
        <div id="gridDiv">
            <div class="gridColumn">
                <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
            </div>
            <div class="gridColumn">
                <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
            </div>
            <div class="gridColumn">
                <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
            </div>
            <div class="gridColumn">
                <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
            </div>
            <div class="gridColumn">
                <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>            
            </div>
    </div>
    </div>
    <div class="events">
        <?php

        $un = $_SESSION["username"];
        $sql = "select * from all_events where username = '$un'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result))
        {
            while($row2 = mysqli_fetch_assoc($result)) {
                echo "<br>".$row2["type"]."  ".$row2["finishTime"];
                $t = $row2["finishTime"];
            }
        }
        
        ?>
        <br>
        <div id="cd"></div>
    </div>
    </div>
</body>
    <script>
        document.addEventListener('DOMContentLoaded', () =>{
        <?php
            if(mysqli_num_rows($result))
            echo "countdown('".$t."');";
        ?>
        placeBuildings();

        });

        //js obj. létrehozás
        (function () {
            <?php
                $sql = "select * from buildings where tile = ".$_SESSION["tiles"][$_SESSION["selectedIndex"]]." order by place asc";
                
                if($result = mysqli_query($conn, $sql))
                {
                    $arr = array();
                    
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $arr["name"][] = str_replace(" ", "_", strtolower($row["building"]));
                        $arr["level"][] = intval($row["level"]);
                        $arr["place"][] = intval($row["place"]);
                        
                    }
                    echo "buildings = ".json_encode($arr).";";
                }
            ?>
        })();
    </script>
</html>
<?php $conn->close(); var_dump($arr, true);?>