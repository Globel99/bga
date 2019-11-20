document.addEventListener("DOMContentLoaded", ()=>{
    _table = document.getElementById("table");
    _infoBox = document.getElementById("infoBox")
    headerRow = document.getElementById("header");
    headerChild = headerRow.querySelectorAll("td");
    xJump_el = document.getElementById("xJump");
    yJump_el = document.getElementById("yJump");
    jumpCell_el = document.getElementById("jumpCell");
    villageSelect = document.getElementById("villageSelect");
    table_el = new Array(7);
    for(let i=0;i<7;i++)
    {
        table_el[i] = document.getElementById("tr"+i).querySelectorAll("td");
    }
    let divs = document.getElementById("mainHeader").children;
        for(let i=0;i<divs.length;i++)
        {
            if(i == 2) continue;
            divs[i].onmouseover = () => {divs[i].className = "headerMouseOver";}
            divs[i].onmouseout = () => {divs[i].className = "headerMouseOut";}
        } 

    reloadMap('x', 0);
    villageSelectFunc(villageSelect);
})

let lastSelectedCellForInfoBox;
//kezdőképen a map bal felső sarka
let x = 7;
let y = 50;

get = (x, y) => {
	
	let returnVal = y*64+x;
	return returnVal;
}

function reloadMap(axis, direction) {
    lastSelectedCellForInfoBox = null;
    _infoBox.className = "hideInfoBox";
    if(axis){
        {
            if(axis === "x") x += direction;
            else if(axis === "y") y += direction;
        
            if(x < 0 || x > 57) x -= direction;
            if(y < 0 || y > 57) y -= direction;
        }
        
    }
    
    

    for (let r = 0; r < 7; r++) //map cellák
    {
        headerChild[r + 1].innerHTML = "X: " + (x + r + 1);
        table_el[r][0].innerHTML = "Y: " + (y + r + 1);

        for (let c = 0; c < 7; c++) {
            const currCell = table_el[r][c + 1];

            currCell.style.backgroundImage = `url('http://bga.rf.gd/images/backg/${backgArray[get(x + c, r + y)]}.jpg')`;
            currCell.style.border = "";

            if(layerArray[get(x + c, r + y)])
            currCell.innerHTML = `<img src="http://bga.rf.gd/images/layer/${layerArray[get(x + c, r + y)]}.png">`;
            else currCell.innerHTML = "";
            currCell.onclick = () => placeInfoBox(event, get(x + c, r + y));
        }
    }
}

function jump(){
    let xVal = xJump_el.value
    let yVal = yJump_el.value;
    let highlCellX = 0;
    let highlCellY = 0;

    if(xVal > 0 && xVal < 65 && yVal > 0 && yVal < 65)
    {
        if(xVal < 4){
            x = 0;
            highlCellX = xVal;
            console.log("xVal < 4 - " + highlCellX);
        } 
        else if(xVal > 61){
            x = 57;
            highlCellX = 4 + (xVal - 61);
        } 
        else{
            x = xVal - 4;
            highlCellX = 4;
        } 

        if(yVal < 4){
            y = 0;
            highlCellY = yVal - 1;
        } 
        else if(yVal > 61){
            y = 57;
            highlCellY = 3 + (yVal - 61);
        } 
        else {
            y = yVal - 4;
            highlCellY = 3;
        }
        
        reloadMap(0, 0);
        table_el[highlCellY][highlCellX].style.border = "solid 2px red";
    }
    
}
jumpToVillage = () => {villageSelectFunc(villageSelect);}

function villageSelectFunc(el){
    let index = el.value;

    let yOfVillage = parseInt(index/64);
    let xOfVillage = index-yOfVillage*64;
    xOfVillage++;
    yOfVillage++;

    xJump_el.value = xOfVillage;
    yJump_el.value = yOfVillage;

    jump();
}

placeInfoBox = (e, tile) =>
{
    console.log(e.target);
    if(e.target == lastSelectedCellForInfoBox && _infoBox.className == "showInfoBox")
    {
        console.log("double select");
        lastSelectedCellForInfoBox = null;
    }else
    {
        lastSelectedCellForInfoBox = e.target;
        let parent = e.target.offsetParent;
        let offsetL = e.target.offsetLeft;
        let offsetT = e.target.offsetTop;
        while(parent != _table)
        {
            offsetL += parent.offsetLeft;
            offsetT += parent.offsetTop;
            parent = parent.offsetParent;
            console.log("while");
        }
        offsetL += parent.offsetLeft + 50;
        offsetT += parent.offsetTop - 100;
        
        _infoBox.style.left = offsetL + "px";
        _infoBox.style.top = offsetT + "px";
        console.log("Left:" + offsetL + " Top: " + offsetT);
        console.log(tile);
        createInfoBoxContent(tile);
    }
    _infoBox.className = "hideInfoBox";
}

fillInfoBox = (_json) =>
{
        let y = parseInt(_json["tile"]/64);
        let x = _json["tile"] - (y*64);
        y++;
        x++;
        str = "(" + x + ", " + y + ")<br>";

    if(_json["type"] == "user"){
        str += _json["username"] + "<br>" + _json["villageName"];
    }else
    {
        str += _json["type"];
    }
    _infoBox.innerHTML = str;
    console.log(_infoBox.innerHTML);
    _infoBox.className = "showInfoBox";
}

function openLink(param){
    switch (param){
        case 1: {
            window.open(`http://bga.rf.gd/village.php?t=${villageSelect.selectedIndex}`, "_self");
         } break;
        case 2: {
            window.open("http://bga.rf.gd/scripts/logout.php","_self");
         } break;
    }
}