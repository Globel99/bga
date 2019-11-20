document.addEventListener('DOMContentLoaded', () =>{
    grid = document.getElementById("gridDiv");
    gridRows = grid.children;

    const noBuild = [0,1,6,7,10,19,20,24,28,29,31,32,33,37,38,39];

    placeBuildings = () =>{
        let curPlace = 0;
        let index = 0;
        for(let i=0;i<gridRows.length;i++)
        {
            let gridColumns = gridRows[i].children;
            for(let k=0;k<gridColumns.length;k++)
            {
                
                if(!noBuild.includes(curPlace))
                {
                    gridColumns[k].onmouseover = () => gridColumns[k].className = "mouseOverGrid";
                    gridColumns[k].onmouseout = () => gridColumns[k].className = "mouseOutGrid";
                    
                    if(buildings["place"] != null && buildings["place"].includes(curPlace))
                    {
                        const url = 
                        "http://bga.rf.gd/images/buildings/" + buildings["name"][index] + "_" +
                         buildings["level"][index] + ".jpg";

                        gridColumns[k].innerHTML = 
                        "<a href='http://bga.rf.gd/buildings/" + buildings["name"][index] + ".php'><img class='building' src=" + url + "></img></a>";

                        
                        index++;
                    }else
                    gridColumns[k].innerHTML = "<a href='http://bga.rf.gd/buildings/empty.php'><img src='http://bga.rf.gd/images/village/empty.png'></img></a>";
                }
                curPlace++;
            }
        }
    }

    })