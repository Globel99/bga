<?php
    session_start();
    if(!isset($_SESSION["isLoggedIn"]) || !isset($_POST["building"])) die("gatya");
    require_once $_SERVER['DOCUMENT_ROOT'].'/scripts/db_connect.php';
    file_get_contents("http://bga.rf.gd/scripts/event_list.php");

    echo $username = $_SESSION["username"];
    echo "\n";
    echo $tile = $_SESSION["tiles"][$_SESSION["selectedIndex"]];
    echo "\n";
    echo $building = $_POST["building"];
    echo "\n";
    echo $place = intval($_POST["place"]);
    echo "\n";

    $sql = "select * from events_buildings where tile = ".$_SESSION["tiles"][$_SESSION["selectedIndex"]];
    if(mysqli_num_rows(mysqli_query($conn, $sql)) != 0)
    {
       die("Already building"); 
    }
    //nagybetűk, space-ek cserélése
    $building = str_replace(" ", "_", strtolower($building));
    echo $building;
    echo "\n";

    //az épülethez tartozó json
    $json = json_decode(file_get_contents("http://bga.rf.gd/buildings/json/".$building.".json"), true);

    //jelenlegi ilyen épület keresése
    $sql = "select * from buildings where tile = ".$tile." and building = '".$building."'";
    echo $sql."\n";

    $result = mysqli_query($conn, $sql);
    if($row = mysqli_fetch_assoc($result))
    {
        //ha van már, az új szint beállítása, ID tárolása
        $buildingExisted = true;
        $newLevel = intval($row["level"])+1;
        $idOfBuilding = intval($row["id"]);
    }else
    {
        $buildingExisted = false;
    }

    //szükséges mennyiségű nyersanyag ellenőzése
    $sql = "select * from resources where tile = ".$tile;
    $row = mysqli_fetch_assoc(mysqli_query($conn, $sql));

    $wood = $json["wood"][$newLevel-1];
    $wheat = $json["wheat"][$newLevel-1];
    $stone = $json["stone"][$newLevel-1];
    
    if($row["wood"] >= $wood && $row["wheat"] >= $wheat && $row["stone"] >= $stone)
    {
        //ideiglenes szintek:
        if($buildingExisted){
            //ha már létezett az épület
            //szint beállítása az építkezés gif-hez
            //ez lesz az épület ideiglenes szintje

            //ez a query a többivel multi query-vel fog lefutni
            $buildAnimationLevel = 100 + $newLevel;
            $sql = "update buildings set level = ".$buildAnimationLevel." where id = ".$idOfBuilding.";";
            echo "\nAlready existed\n";
        }else
        {
            //ha nem létezett, létrehozás, ideiglenesen 'építés 1-re' szinttel (lvl 101)
            $sql = "insert into buildings (level, tile, building, place) values (101, ".$tile.", '".$building."', ".$place.");";
            mysqli_query($conn, $sql);
            echo $sql;
            echo "\n\n";
            
            $newLevel = 1;
            $sql = "";
            echo "\nDid not exist\n";
        }

        $time = $json["time"][$newLevel];

        //multi query-hez stringek létrehozása
        $startTime = "addtime(CURRENT_TIMESTAMP(), '5:58:22')";
        $finishTime = "addtime(".$startTime.", '".$time."')";
        $maxID = "(select max(id) from all_events)";

        //all_event-be, events_buildings-be 1-1 sor beszúrása az eventhez, nyersanayag levonása
        $sql .= "set @id = (SELECT max(id) from all_events);";
        $sql .= "set @id = if(@id is null, 1, @id+1);";
        $sql .= "insert into all_events (id, username, startTime, finishTime, type) values (@id, '".$username."', ".$startTime.", ".$finishTime.", 'building');";
        $sql .= "insert into events_buildings values (@id, ".$tile.", '".$building."', ".$newLevel.", ".$finishTime.");";
        $sql .= "update resources set wood = wood - ".$wood.", wheat = wheat - ".$wheat.", stone = stone - ".$stone." where tile = ".$tile.";";
        echo "\n".$sql;
        if(mysqli_multi_query($conn, $sql)){
            echo "\nEvent - $building to lvl $newLevel at tile $tile - addet at all_events";

        }else echo "\nError: ".mysqli_error($conn);
        
        unset($_SESSION["buildings"]);
    }else
    echo "\nnot enough resources";
?>