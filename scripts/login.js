document.addEventListener("DOMContentLoaded", ()=>{
    username_el = document.getElementById("username");
    pw_el = document.getElementById("pw");
    button_el = document.getElementById("button");
    slider_el = document.getElementById("slider");
    warning_el = document.getElementById("warn");
})

function submit()
{
    const username = username_el.value;
    const pw = pw_el.value;
    let command;

    if(username.length > 2 && pw.length > 2)
    {
        if(slider_el.value == 1) command = "login";
        else{
            if(slider_el.value == 2) command = "register";
        }
        
        const request = new XMLHttpRequest();
        request.open("POST", `http://bga.rf.gd/scripts/${command}.php`);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send(`username=${username}&pw=${pw}`);
        request.onload = () => {
            if(request.responseText === "ok")
            {
                console.log("submit");
                document.getElementById("approvedForm").submit();
            }
            else{
                console.log("response, no submit, response: " + request.responseText);
                warning_el.innerHTML = request.responseText;
                warning_el.style.display = "block";
            }
        }
    }else{
        warning_el.innerHTML = "username or password is too short";
        warning_el.style.display = "block";
    }
}
function changeSlider()
{
    if(slider_el.value == 1){
        slider_el.style.background = "white";
        button_el.innerHTML = "Login";
        console.log(slider_el.value);
        }else
            {
                slider_el.style.background = "grey";
                button_el.innerHTML = "Register";
                console.log(slider_el.value);
            }
}

function keyPressed(e)
{
    if(e.keyCode == 13) submit();
    if(username_el.value == "baluxd")
    {
        document.getElementById("titleInner").innerHTML = "balu kutya xdd";
    }
}