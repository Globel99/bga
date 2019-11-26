document.addEventListener('DOMContentLoaded', () =>{
    grid = document.getElementById("wrapper");
    grids = grid.children;

    const noBuild = [0,1,6,7,10,19,20,24,28,29,31,32,33,37,38,39];

    placeBuildings = () =>{
        let buildingIndex = 0;
        for(let i=0;i<grids.length;i++)
        {
            if(!noBuild.includes(i))
            {
                
                if(buildings["place"] != null && buildings["place"].includes(i))
                {
                    const url = 
                    "http://bga.rf.gd/images/buildings/" + buildings["name"][buildingIndex] + "_" +
                    buildings["level"][buildingIndex] + ".jpg";
                    const alt = buildings["name"][buildingIndex] + buildings["level"][buildingIndex];
                    console.log(alt);
                    grids[i].innerHTML = 
                    //"<div><a href='http://bga.rf.gd/buildings/" + buildings["name"][buildingIndex] + ".php'><img class='building' src=" + url +" alt="+ alt +"></img></a></div>";
                    "<a href='http://bga.rf.gd/buildings/" + buildings["name"][buildingIndex] + ".php'><img class='building' src=" + url +" alt="+ alt +"></img></a>";

                    buildingIndex++;
                }else
                {
                    //grids[i].innerHTML = "<div><a href='http://bga.rf.gd/buildings/empty.php?p="+ i +"'><img src='http://bga.rf.gd/images/village/empty.png'></img></a></div>";
                    grids[i].innerHTML = "<a href='http://bga.rf.gd/buildings/empty.php?p="+ i +"'><img src='http://bga.rf.gd/images/village/empty.png'></img></a>";
                }
            }
        }
    }

    })