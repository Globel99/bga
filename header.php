    <?php
    if(!isset($_SESSION["isLoggedIn"])) die("gatya = (");
    ob_start();
    ?>
    <div id="header">
        <div id="menu">
            <div>
                <p class="auto">Map</p>
            </div>
            <div id="Select">
                <p><?php include 'scripts/village_select.php';?></p>
            </div>
            <div id='Player'>
                <p>player: <?php echo $_SESSION["username"]?></p>
            </div>
            <div id='Logout'>
                <p>Logout</p>
            </div>
        </div>
        <div id="resources">
            <?php include "scripts/resources.php";?>
            <div id="wheat">
                <p>Wheat: <?php echo $res_arr["wheat"];?>
                +<?php echo $res_arr["wheat_prod"];?>/h</p>
            </div>
            <div id="wood">
                <p>Wood: <?php echo $res_arr["wood"];?>
                +<?php echo $res_arr["wood_prod"];?>/h</p>
            </div>
            <div id="stone">
                <p>Stone: <?php echo $res_arr["stone"];?>
                +<?php echo $res_arr["stone_prod"];?>/h</p>
            </div>
        </div>        
    </div>

    <script>
    function windowOpen(param){
        switch(param)
        {
            
            case 'Logout':{
                window.open('http://bga.rf.gd/scripts/logout.php', '_self');
            }break;
            case 'Map':{
                window.open('http://bga.rf.gd/map.php', '_self');
            }break;
            case 'Village':{
                window.open("http://bga.rf.gd/village.php", "_self");
            }break;
            case 'Player':{
                window.open("http://bga.rf.gd/scoreboard.php", "_self");
            }break;
            default:
                ;
        }
    }
    document.addEventListener('DOMContentLoaded', ()=>
        {
            _villageSelect = document.getElementById("villageSelect");
            _villageSelect.selectedIndex = <?php echo $_SESSION["selectedIndex"];?>;
            _villageSelect.onchange = () => {
                
                var xhttp = new XMLHttpRequest();
                xhttp.open("POST", "http://bga.rf.gd/scripts/change_current_village.php", false);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send(`index=${parseInt(_villageSelect.selectedIndex)}`);

                location.reload();
            }
            var el = document.getElementById('menu').children;
            console.log(el);
            
            for(let i=0;i<el.length;i++)
            {
                el[i].className = 'mouseOut';
                if(i == 1) continue;
                el[i].onclick = () => windowOpen(el[i].innerText);
                el[i].onmouseover = () => el[i].className = 'mouseOver';
                el[i].onmouseout = () => el[i].className = 'mouseOut';
            }
            el[2].onclick = () => windowOpen("Player");
        }
    )
    </script>
    <?php
    $header = ob_get_clean();
    ?>