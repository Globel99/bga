<?php
if(!isset($_SESSION["isLoggedIn"])) die("gatya = (");

if(!isset($_SESSION["selectedIndex"])) $_SESSION["selectedIndex"] = 0;
if(isset($_SESSION["tiles"])) reloadDOM(); else initSessionTiles();

function initSessionTiles()
{
    function createFirstVillage()
    {
        $backg_array = json_decode(file_get_contents("http://bga.rf.gd/backg_array_data.json"));
        $layer_array = json_decode(file_get_contents("http://bga.rf.gd/layer_array_data.json"));

        $bool = false;
        while($bool == false)
        {
            $tile = rand(0,4095);
            if($backg_array[$tile] != 255 && $layer_array[$tile] == 0)
            {
                $bool = true;
            }
        }
        $sql = "INSERT INTO villages VALUES (\"${tile}\",\"" . $_SESSION["username"] . "\",\"falu1\")";
        $result = mysqli_query($GLOBALS["conn"], $sql);

        $url = "http://bga.rf.gd/scripts/layer_array_replace.php?pw=szkuvi&rep={$tile}&with=1";
        $contents = file_get_contents($url);

        $GLOBALS["refreshReq"] = true;
    }

    $un = $_SESSION['username'];
    $sql = "SELECT * FROM villages WHERE username = '$un'";
    $result = mysqli_query($GLOBALS["conn"], $sql);

    if (!mysqli_num_rows($result)) createFirstVillage();

    echo "<script>console.log('initsession');</script>";

    echo "<select id=\"villageSelect\" onchange=\"villageSelectFunc(this)\">";

        $_SESSION["tiles"] = array();
        $_SESSION["villageName"] = array();

        while($row = mysqli_fetch_assoc($result)) {
            
            $y = intval($row["tile"]/64);
            $x = $row["tile"]-($y)*64;

            $y++; $x++;
            echo "<option value={$row["tile"]}>{$row["name"]} ({$x}, {$y})</option>";

            $_SESSION["tiles"][] = $row["tile"];
            $_SESSION["villageName"][] = $row["name"];
        }
    echo "</select>";

    $GLOBALS["refreshReq"] = true;
}

function reloadDOM()
{
    $GLOBALS["refreshReq"] = false;

    echo "<script>console.log('reloaddom');</script>";

    echo "<select id=\"villageSelect\" onchange=\"villageSelectFunc(this)\">";

    $i = 0;
    foreach($_SESSION["tiles"] as $value)
    {
        $y = intval($value/64);
        $x = $value-($y)*64;
        $y++; $x++;

        echo "<option value={$value}>{$_SESSION["villageName"][$i]} ({$x}, {$y})</option>";

        $i++;
    }

    echo "</select>";
}
?>