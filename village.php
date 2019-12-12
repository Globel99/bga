<?php
require_once "init.php";
require "Medoo.php";
use Medoo\Medoo;
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=0.4, maximum-scale=1, user-scalable=0"/> <!--320-->
    <meta charset="utf-8">
    <script type="text/javascript" src="scripts/countdown.js"></script>
    <script type="text/javascript" src="scripts/village.js"></script>
    <script type="text/javascript" src="scripts/js/simple_request.js"></script>
    <link rel="stylesheet" type="text/css" href="styles/basic.css">
    <link rel="stylesheet" type="text/css" href="styles/village.css">
    <link rel="stylesheet" type="text/css" href="styles/header.css">
</head>
<body>
    <?php include "header.php"; echo $header;?>
    <div id="main">
        <div id="container">
            <div id="wrapper">
                <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
            </div>
        </div>
        <div id="events" class="events">
            <div id="eventsWrapper">
                <div id="queueBuilding"></div>
                <div id="cd"></div>
            </div>
        </div>
    </div>
</body>
    <script>
        document.addEventListener('DOMContentLoaded', () =>{
        const queueRequest = new SimpleRequest();
        const header = "tile=<?php echo $tile;?>";
        queueRequest.sendPOST("http://bga.rf.gd/scripts/php/api/post/build_queue.php", header);
        queueRequest.onload = () =>{
            var queue = JSON.parse(queueRequest.responseText);
            console.log(queue);
            if(queue["building"]){
                document.getElementById("queueBuilding").innerHTML = queue["building"] + "<br>";
                countdown(queue["finishTime"]);
                }
            }
        
        
        placeBuildings();

        });

        //js 'buildings' obj. létrehozása amivel elérhetőek az épületek a placeBuildings()ben
        (function () {
            <?php
                $database = new Medoo();
                $datas = $database->query("select * from buildings where tile = $tile order by place asc")->fetchAll();
                
                if(!empty($datas))
                {
                    $arr = array();
                    $i=0;

                    unset($_SESSION["buildings"]);
                    foreach($datas as $data)
                    {
                        $arr["name"][] = str_replace(" ", "_", strtolower($data["building"]));
                        $arr["level"][] = intval($data["level"]);
                        $arr["place"][] = intval($data["place"]);
                        //if(!isset($_SESSION["buildings"][$i])){
                            $_SESSION["buildings"][$i] = $data["building"];
                            echo "console.log('set session buildings');";
                        //}
                        $i++;
                    }
                    echo "buildings = ".json_encode($arr).";";
                }else
                echo "buildings = 0;";
            ?>
        })();
    </script>
</html>
<?php
$conn->close();
//var_dump($_SESSION["buildings"]);
//echo time();
/*


OLD
            <?php
                $sql = "select * from buildings where tile = ".$_SESSION["tiles"][$_SESSION["selectedIndex"]]." order by place asc";
                
                if($result = mysqli_query($conn, $sql))
                {
                    $arr = array();
                    
                    $i=0;
                    unset($_SESSION["buildings"]);
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $arr["name"][] = str_replace(" ", "_", strtolower($row["building"]));
                        $arr["level"][] = intval($row["level"]);
                        $arr["place"][] = intval($row["place"]);
                        //if(!isset($_SESSION["buildings"][$i])){
                            $_SESSION["buildings"][$i] = $row["building"];
                            echo "console.log('set session buildings');";
                        //}
                        $i++;
                    }
                    echo "buildings = ".json_encode($arr).";";
                }
            ?>
            */
?>



