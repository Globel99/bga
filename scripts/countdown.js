function countdown(finishTime)
{
    const sql = finishTime;
    const d = sql.split(/[- :]/);
    const date = new Date(Date.UTC(d[0], d[1]-1, d[2], d[3], d[4], d[5]));
    const countDownDate = date.getTime();

    let dateArr = new Array(4);
    let stringArr = ["d", "h", "m", "s"];

    loop = () =>{
        let now = new Date().getTime()+3600*1000;
        let distance = countDownDate - now;
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
        
        console.log(distance);

        if (distance < 1000) {
            
            //setTimeout(() => req.sendGET("http://bga.rf.gd/scripts/event_list.php", ""), 1500);
            console.log(" sdf");
            clearInterval(clock);

            getQueueResponse = () =>{
                let req = new SimpleRequest();
                req.sendPOST("http://bga.rf.gd/scripts/php/api/post/queue_check.php", "tile=325");
                req.onreadystatechange = () => {
                    if(req.responseText == "free")
                    window.open("http://bga.rf.gd/village.php", "_self");
                    else {
                        console.log(req.responseText);
                    }
                };
            }
            let check = setInterval(getQueueResponse, 1000);
            //setTimeout(() => window.open("http://bga.rf.gd/village.php", "_self"), 2000);
        }
    }
    if((countDownDate - new Date().getTime()+3600*1000) > 1000)
    {
        loop();
        var clock = setInterval(loop, 1000);
    }

    
}