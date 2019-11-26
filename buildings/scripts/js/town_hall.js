upgrade = () =>{
    let req = new SimpleRequest();
    const header = "building=Town hall";
    req.sendPOST("http://bga.rf.gd/scripts/php/api/post/build.php", header);
    req.onload = () =>{
        console.log(req.responseText);
        window.open("http://bga.rf.gd/village.php", "_self");
    }
}