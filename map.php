<?php
session_start();
if(!isset($_SESSION["isLoggedIn"])) die("gatya = (");
file_get_contents("http://bga.rf.gd/scripts/event_list.php");
include "scripts/db_connect.php";
?>
<!-- aa -->
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=0.4, maximum-scale=1, user-scalable=0"/> <!--320-->
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="styles/basic.css">
    <link rel="stylesheet" type="text/css" href="http://bga.rf.gd/styles/map.css">
    <script>
        const layerArray = new Uint8Array(<?php echo file_get_contents("data/layer_array_data.json");?>);
        const backgArray = new Uint8Array(<?php echo file_get_contents("data/backg_array_data.json");?>);            
    </script>
    <script type="text/javascript" src="http://bga.rf.gd/scripts/map.js"></script>
</head>
<body>
    <div id="infoBox"></div>
    <div id="mainHeader" class="mainHeader">
        <div onclick="jumpToVillage();">
            </p>Jump to village on map</p>
        </div>
        <div onclick="openLink(1)">
            <p>Village</p>
        </div>
        <div>
            <p><?php include "scripts/village_select.php";?></p>
        </div>
        <div>
            <p>player: <?php echo $_SESSION["username"]?></p>
        </div>
        <div onclick="openLink(2)">
            <p>Logout</p>
        </div>

    </div>
    <table id="table">
        <tr id="header">
            <td><td><td><td><td><td><td><td>
        </tr>
        <tr id="tr0">
            <td id="coord"><td><td><td><td><td><td><td>
        </tr>
        <tr id="tr1">
            <td id="coord"><td><td><td><td><td><td><td>
        </tr>
        <tr id="tr2">
            <td id="coord"><td><td><td><td><td><td><td>
        </tr>
        <tr id="tr3">
            <td id="coord"><td><td><td><td><td><td><td>
        </tr>
        <tr id="tr4">
            <td id="coord"><td><td><td><td><td><td><td>
        </tr>
        <tr id="tr5">
            <td id="coord"><td><td><td><td><td><td><td>
        </tr>
        <tr id="tr6">
            <td id="coord"></td><td><td><td><td><td><td><td>
        </tr>
    </table>
    <div id="buttons">
        <button onclick="reloadMap('y', -1)">🡹</button>
        <button onclick="reloadMap('y', 1)">🡻</button>
        <button onclick="reloadMap('x', -1)">🡸</button>
        <button onclick="reloadMap('x', 1)">🡺</button>
        <font>X</font>
        <input id="xJump">
        <font>Y</font>
        <input id="yJump">
        <button class="jump" onclick="jump()">JUMP</button>
    </div>
</body>

<script>
    createInfoBoxContent = (_tile) => {
        const request = new XMLHttpRequest();
        request.open("GET", `http://bga.rf.gd/scripts/php/api/get/get_tile_details.php?tile=` + _tile);
        //request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //request.send("tile="+_tile);
        request.send();
        request.onload = () => {
            console.log(_tile);
            console.log(request.responseText);
            const obj = JSON.parse(request.responseText);
            console.log(obj);
            fillInfoBox(obj);
        }
        
    }
</script>

<?php
    echo "tiles:";
    var_dump($_SESSION["tiles"]);
    echo "village:";
    var_dump($_SESSION["villageNames"]);
?>
</html>
