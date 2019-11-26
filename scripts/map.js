document.addEventListener("DOMContentLoaded", ()=>{
    _table = document.getElementById("table");
    _tableParent = document.getElementById("tableParent");
    size = 8;
    initMap(size, false);
    _infoBox = document.getElementById("infoBox")
    headerRow = document.getElementById("tableHeader");
    xJump_el = document.getElementById("xJump");
    yJump_el = document.getElementById("yJump");
    jumpCell_el = document.getElementById("jumpCell");
    villageSelect = document.getElementById("villageSelect");
    table_el = new Array();

    //reloadMap('x', 0);
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
    _infoBox.className = "hideInfoBox";
    if(axis){
        {
            if(axis === "x") x += direction;
            else if(axis === "y") y += direction;
        
            if(x < 0 || x+size > 64) x -= direction;
            if(y < 0 || y+size > 64) y -= direction;
        }
        
    }
    
    ////console.log(_table);

    for (let r = 0; r < size; r++) //map cellák
    {
        _table.children[0].children[r + 1].innerHTML = (x + r + 1);
        _table.children[r+1].children[0].innerHTML = (y + r + 1);

        for (let c = 0; c < size; c++) {
            ////console.log(_table.children[r+1].children[c + 1]);
            let currCell = _table.children[r+1].children[c + 1];

            currCell.style.backgroundImage = `url('http://bga.rf.gd/images/backg/${backgArray[get(x + c, r + y)]}.jpg')`;
            currCell.style.border = "";

            if(layerArray[get(x + c, r + y)])
            currCell.innerHTML = `<img src="http://bga.rf.gd/images/layer/${layerArray[get(x + c, r + y)]}.png">`;
            else currCell.innerHTML = "";
            currCell.onclick = () => placeInfoBox(event, get(x + c, r + y));
        }
        //console.log("reload");
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
            //console.log("xVal < 4 - " + highlCellX);
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
        /*
        reloadMap(0, 0);
        table_el[highlCellY][highlCellX].style.border = "solid 2px red";*/
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
        while(parent != _tableParent)
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

initMap = (mapSize, reset) =>{
    let border = true;
    let fontSize = 0;
    if(size > 40) {
        document.getElementById("tableParent").style = "border-spacing: 0;";
        var pixels = parseInt(560/size);
    }else{
        document.getElementById("tableParent").style = "border-spacing: 1px;";
        var pixels = parseInt((560-(size*2))/size);
    }
    if(size > 40){
        fontSize = 0;
        document.getElementById("tableParent").style = "font-size: 1px";
    }
    else{
        fontSize = 30-size;
        document.getElementById("tableParent").style = "font-size: " + (40-size) + "px";
    } 
    if(reset) {
        let k = 0;
        while(_table.children[k]){
            _table.removeChild(_table.children[k]);
        }
    }
    _size = mapSize+1;
    let nodeArrayOfRows = new Array(_size);
    for(let c=0;c<nodeArrayOfRows.length;c++)
    {
        nodeArrayOfRows[c] = document.createElement("tr");

        for(let r=0;r<_size;r++)
        {
            let td = document.createElement("td");
            //td.style.border = "none";
            nodeArrayOfRows[c].appendChild(td);
        }
        if(c) nodeArrayOfRows[c].children[0].id = "coord";

        ////console.log(nodeArrayOfRows[c]);
        _table.appendChild(nodeArrayOfRows[c]);
    }
    nodeArrayOfRows[0].id = "tableHeader";
    //_table.onload = () =>reloadMap('x', 0);
    for(let i=0;_table.children[i];i++)
    {
        for(let k=0;_table.children[i].children[k];k++)
        {
            _table.children[i].children[k].style.height = pixels + "px";
            _table.children[i].children[k].style.width = pixels + "px";
            if(_table.children[i].children[k].children[0])
            _table.children[i].children[k].children[0].style.width = pixels + "px";
        }
    }

    setTimeout(() => {
        reloadMap('x', 0);
    }, 30);
    console.log(x+size);
}
zoom = (param) =>{
    switch(param){
        case 1: size++;break;
        case 0: size--;break;
        default: size = parseInt(document.getElementById("zoomInput").value);
    }
    initMap(size, true);
}