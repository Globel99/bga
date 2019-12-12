request = new SimpleRequest();
request.sendGET("http://bga.rf.gd/scripts/php/api/get/resource_field_types.php", "");

document.addEventListener("DOMContentLoaded", () => {
    
    request.onload = () =>{
        let resource_field_types = JSON.parse(request.responseText);
        loadResourceFields(resource_field_types);
    }
})

loadResourceFields = (json) =>{
    const fields = document.getElementsByClassName("resource");
    let className;
    for(let i = 0; fields[i]; i++)
    {
        switch(json[i])
        {
            case 0: className = "plain"; break;
            case 1: className = "forest"; break;
            case 2: className = "hillWithForest"; break;
            default:break;
        }
        
        //console.log("\n" + i + "-" + className);
        fields[i].classList.add(className);
    }
}
