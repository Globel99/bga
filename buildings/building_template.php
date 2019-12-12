<?php
    $sql = "select * from buildings where tile = ".$_SESSION["tiles"][$_SESSION["selectedIndex"]]." and building = '".$building."'";
    $result = mysqli_query($GLOBALS["conn"], $sql);
    $row = mysqli_fetch_assoc($result);
    $level = $row["level"];
    $title = ucfirst(str_replace("_", " ", $building));
    
    ob_start();
    $script = "const json =";
    $buil_json = file_get_contents("json/".$building.".json");

    //echo "<script>$script $buil_json</script>";
?>
    <script>
        const json = JSON.parse(`<?php echo $buil_json;?>`);
        document.addEventListener("DOMContentLoaded", ()=>{
        const parent = document.getElementById("upgradeResources");
        const children = parent.children;
        const arr = ["wheat", "wood", "stone"];

        for(let i=0;i<3;i++)
        {
            src = "http://bga.rf.gd/images/resources/" + arr[i] + ".png";
            children[i*2].innerHTML = `<img src="${src}"></img>`;
            children[i*2+1].innerText = json[arr[i]][<?php echo $level;?>];
        }
        });
    </script>
    <div><h1><?php echo $title;?></h1></div>
    <div>
        <h3>Level: <?php echo $level;?></h3>
        <button onclick="upgrade('<?php echo $building;?>')" id="upgradeButton">Upgrade to LVL <?php echo $level+1;?></button>
        <div id="wrapper">
            <div id="upgradeResources">
                <div></div><div></div><div></div><div></div><div></div><div></div>
            </div>
        </div>    
    </div>
<?php
    echo ob_get_clean();
?>

