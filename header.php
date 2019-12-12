    <?php
    if(!isset($_SESSION["isLoggedIn"])) die("gatya = (");
    ob_start();
    ?>
    <div id="header">
            <div>
                Map
            </div>
            <div id="Select">
                <?php include 'scripts/village_select.php';?>
            </div>
            <div id='Player'>
                Player: <?php echo $_SESSION["username"]?>
            </div>
            <div id='renameVillage'>
                    Rename Village
                    <div id="renameVillageInner">
                        <input id='renameVillageInput'>
                        <button id='renameVillageButton'>ok</button>  
                    </div>
            </div>
            <div id="Units">
                Units
            </div>
            <div id='Logout'>
                Logout
            </div>
            <div id="village">
                Village
            </div>
            <div>
                Resources
            </div>
            <?php include "scripts/resources.php";?>
            <div id="wheat">
                <img src="http://bga.rf.gd/images/resources/wheat.png">
                <?php echo $res_arr["wheat"]." +".$res_arr["wheat_prod"]."/h";?>
            </div>
            <div id="wood">
                <img src="http://bga.rf.gd/images/resources/wood.png">
                <?php echo $res_arr["wood"]." +".$res_arr["wood_prod"]."/h";?>
            </div>
            <div id="stone">
                <img src="http://bga.rf.gd/images/resources/stone.png">
                <?php echo $res_arr["stone"]." +".$res_arr["stone_prod"]."/h";?>
            </div>
            <div id="Options">
                Options
            </div>
    </div>

    <script>
    function windowOpen(param){
        const validParams = ['Map', 'Village', 'Scoreboard', 'Options', 'Resources', 'Units'];
        switch(param)
        {
            case 'Logout':{
                window.open("http://bga.rf.gd/scripts/logout.php", "_self");
            }break;
            case 'Rename Village':{
                document.getElementById('renameVillageInner').classList.add("renameVillageActive");
            }break;
            default:
                if(validParams.includes(param))
                {
                    window.open("http://bga.rf.gd/"+ param.toLowerCase() +".php", "_self");
                }
            ;
        }
    }

    document.addEventListener('DOMContentLoaded', ()=>
        {
            _renameVillageInput = document.getElementById("renameVillageInput");
            _renameVillageButton = document.getElementById("renameVillageButton");
            _renameVillage = document.getElementById("renameVillage");
            _villageSelect = document.getElementById("villageSelect");

            _villageSelect.selectedIndex = <?php echo $_SESSION["selectedIndex"];?>;

            _renameVillageButton.onclick = () =>{
                if(_renameVillageInput.value)
                {
                    var xhttp = new XMLHttpRequest();
                    xhttp.open("POST", "http://bga.rf.gd/scripts/rename_village.php", false);
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhttp.send(`name=${_renameVillageInput.value}`);
                    location.reload();
                }
            }

            _villageSelect.onchange = () => {
                var xhttp = new XMLHttpRequest();
                xhttp.open("POST", "http://bga.rf.gd/scripts/change_current_village.php", false);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send(`index=${parseInt(_villageSelect.selectedIndex)}`);
                location.reload();
            }


            el = document.getElementById('header').children;
            
            for(let i=0;i<el.length;i++)
            {
                el[i].className = 'mouseOut';
                if(i == 1) continue;
                el[i].onclick = () => windowOpen(el[i].innerText);
            }
            el[2].onclick = () => windowOpen("Scoreboard");
            el[3].onclick = () => windowOpen("Rename Village");
            document.getElementById('village').onclick = () => windowOpen("Village");
        }
    )
    </script>
    <?php
    $header = ob_get_clean();
    ?>