document.addEventListener("DOMContentLoaded", ()=>{
    formAmount = document.getElementById("amount");
    formType = document.getElementById("type");
})

function submit()
{
    const amount = formAmount.value;
    const type = formType.value;
    console.log(amount, type);
    let myRequest = new SimpleRequest();
    header = "type=" + type + "&amount=" + amount;
    myRequest.sendPOST("http://bga.rf.gd/scripts/php/api/post/recruit.php", header);
    myRequest.onload = () =>{
        console.log(myRequest.responseText);
    }
}