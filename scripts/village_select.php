<?php
if(!isset($_SESSION["isLoggedIn"])) die("gatya = (");

if(!isset($_SESSION["selectedIndex"])) $_SESSION["selectedIndex"] = 0;



function initSessionTiles()
{
    
    $un = $_SESSION['username'];
    $sql = "SELECT * FROM villages WHERE username = '$un'";
    $result = mysqli_query($GLOBALS["conn"], $sql);
        
    

    if (!mysqli_num_rows($result))
    {
        include "php/init_player.php";
        initUsersTile(); 
        echo "<script>location.reload();</script>";
    }
    $result = mysqli_query($GLOBALS["conn"], $sql);
    echo "<script>console.log('initsession');</script>";

        $_SESSION["tiles"] = array();
        $_SESSION["villageNames"] = array();

        while($row = mysqli_fetch_assoc($result)) {
            $_SESSION["tiles"][] = intval($row["tile"]);
            $_SESSION["villageNames"][] = $row["name"];
        }
}

function loadSelect()
{
    echo "<script>console.log('reloaddom');</script>";

    echo "<select id=\"villageSelect\" onchange=\"villageSelectFunc(this)\">";

    $i = 0;
    foreach($_SESSION["tiles"] as $value)
    {
        $y = intval($value/64);
        $x = $value-($y)*64;
        $y++; $x++;

        echo "<option value={$value}>{$_SESSION["villageNames"][$i]} ({$x}, {$y})</option>";

        $i++;
    }

    echo "</select>";
}

if(!isset($_SESSION["tiles"])) initSessionTiles();
loadSelect();

?>