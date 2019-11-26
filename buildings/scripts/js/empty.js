build = (building, place) => {
    let myRequest = new SimpleRequest();
    header = "building=" + building + "&place=" + place;
    myRequest.sendPOST("http://bga.rf.gd/scripts/php/api/post/build.php", header);
    myRequest.onload = () =>{
        console.log(myRequest.responseText);
    }
    setTimeout(() =>  window.open("http://bga.rf.gd/village.php", "_self"), 150);
}