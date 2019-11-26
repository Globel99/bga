<?php
session_start();
if(!isset($_SESSION["isLoggedIn"])) die("gatya = (");
file_get_contents("http://bga.rf.gd/scripts/event_list.php");
include "scripts/db_connect.php";
?>
<!-- aa -->
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=0.35">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="styles/basic.css">
    <link rel="stylesheet" type="text/css" href="http://bga.rf.gd/styles/map.css">
    <link rel="stylesheet" type="text/css" href="http://bga.rf.gd/styles/header.css">
    <script>
        const layerArray = new Uint8Array(<?php echo file_get_contents("data/layer_array_data.json");?>);
        const backgArray = new Uint8Array(<?php echo file_get_contents("data/backg_array_data.json");?>);            
    </script>
    <script type="text/javascript" src="http://bga.rf.gd/scripts/map.js"></script>
</head>
<body>
    <?php include "header.php"; echo $header;?>
    <div id="infoBox"></div>
    <table id="tableParent">
        <tbody id="table"></tbody>
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
        <button class="jump" onclick="zoom()">JUMP</button>
        <button onclick="zoom(0)">+</button>
        <button onclick="zoom(1)">-</button>
        <input id="zoomInput">
        <button onclick="zoom(3)">zoom</button>
    </div>
</body>

<script>
    createInfoBoxContent = (_tile) => {
        const request = new XMLHttpRequest();
        request.open("GET", `http://bga.rf.gd/scripts/php/api/get/get_tile_details.php?tile=${_tile}`);
        request.send();
        request.onload = () => {
            //console.log(_tile);
            //console.log(request.responseText);
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
