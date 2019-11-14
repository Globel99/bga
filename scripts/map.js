document.addEventListener("DOMContentLoaded", ()=>{
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

//kezdőképen a map bal felső sarka
let x = 7;
let y = 50;

get = (x, y) => {
	
	let returnVal = y*64+x;
	return returnVal;
}

function reloadMap(axis, direction) {

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
            table_el[r][c + 1].style.backgroundImage = `url('http://bga.rf.gd/images/backg/${backgArray[get(x + c, r + y)]}.jpg')`;
            table_el[r][c + 1].style.border = "";

            if(layerArray[get(x + c, r + y)])
            table_el[r][c+1].innerHTML = `<img src="http://bga.rf.gd/images/layer/${layerArray[get(x + c, r + y)]}.png">`;
            else table_el[r][c+1].innerHTML = "";
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