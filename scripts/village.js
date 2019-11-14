document.addEventListener('DOMContentLoaded', () =>{
    grid = document.getElementById("gridDiv");
    gridRows = grid.children;

    const noBuild = [0,1,6,7,10,19,20,24,28,29,31,32,33,37,38,39];
    let w = 0;
    for(let i=0;i<gridRows.length;i++)
    {
        let gridColumns = gridRows[i].children;
        for(let k=0;k<gridColumns.length;k++)
        {
            //gridColumns[k].innerHTML = w;
            //w++;
            if(!noBuild.includes(i*8+k))
            {
                gridColumns[k].onmouseover = () => gridColumns[k].className = "mouseOverGrid";
                gridColumns[k].onmouseout = () => gridColumns[k].className = "mouseOutGrid";
                gridColumns[k].innerHTML = "<img src='http://bga.rf.gd/images/village/buildable3.png'></img>";
            }
        }
    }
    })