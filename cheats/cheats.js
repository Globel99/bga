document.addEventListener("DOMContentLoaded", ()=>{
    city_form = document.getElementById("city");
    amount_form = document.getElementById("amount");
    resourceType_form = document.getElementsByName('resourceType');
    slider_form = document.getElementById("slider");
})

function submit()
{
    const tile = city_form.value;
    const amount = amount_form.value;
    const resourceType = resourceType_form;
    let slider = slider_form.value;
    let wood = null;
    let wheat = null;
    let stone = null;

    for (let i = 0, length = resourceType.length; i < length; i++) {
        if (resourceType[i].checked) {
            selectedResType = resourceType[i].value;
            break;
        }
    }

    const request = new XMLHttpRequest();
    request.open("POST", `http://bga.rf.gd/cheats/submit.php`);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    if(selectedResType == "wood") {
        wood = 1;
        wheat = 0;
        stone = 0;
    } else if(selectedResType == "wheat") {
        wood = 0;
        wheat = 1;
        stone = 0;
    } else if(selectedResType == "stone"){
        wood = 0;
        wheat = 0;
        stone = 1;
    }
    request.send(`tile=${tile}&amount=${amount}&wood=${wood}&wheat=${wheat}&stone=${stone}&slider=${slider}`);
    window.location.reload();
    request.onload = () => {
        if(request.responseText === "ok")
        {
            window.location.reload();
        }
        else{
            console.log("Not submitted, response: " + request.responseText);
        }
    }
}
function changeSlider()
{
    if(slider_form.value == 1){
        slider_form.style.background = "white";
        console.log(slider_form.value);
    } else {
        slider_form.style.background = "blue";
        console.log(slider_form.value);
    }
}