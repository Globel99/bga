function countdown(finishTime)
{
    const sql = finishTime;
    const d = sql.split(/[- :]/);
    const date = new Date(Date.UTC(d[0], d[1]-1, d[2], d[3], d[4], d[5]));
    const countDownDate = date.getTime();

    loop = () =>{

        let now = new Date().getTime()+3600*1000;
        let distance = countDownDate - now;
        let dateArr = new Array(4);
        let stringArr = ["d", "h", "m", "s"];
        //days
        dateArr[0] = Math.floor(distance / (1000 * 60 * 60 * 24));
        //hours
        dateArr[1] = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        //mins
        dateArr[2] = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        //secs
        dateArr[3] = Math.floor((distance % (1000 * 60)) / 1000);
    
        document.getElementById("cd").innerHTML = "";
    
        //0 értékű kihagyása
        let x = false;
        for(let k=0;k<4;k++){
            if(dateArr[k] || x)
            {
                document.getElementById("cd").innerHTML += dateArr[k] + stringArr[k] + " ";
                x = true;
            }
        }
    
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("cd").innerHTML = "EXPIRED";
        }        
    }
    loop();
    setInterval(loop, 1000);
}