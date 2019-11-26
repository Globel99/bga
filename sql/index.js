document.addEventListener('DOMContentLoaded', () =>{
    const iframe = document.getElementById("iframe");
    const input = document.getElementById("input");
    document.getElementById('button').onclick = () => process(input.value);

})

initNavigate = () =>{
    children = document.getElementById('navigate').children;
    for(let i=0; i<children.length; i++){
        children[i].onmouseover = () => children[i].className = "onMouseOver";
        children[i].onmouseout = () => children[i].className = "onMouseOut";
        children[i].onclick = () => process("select * from " + children[i].innerText);
    }
    document.getElementById('navigate').children;
}
process = (header) =>
{
    let url = "http://bga.rf.gd/sql/query.php?q=" + header;
    iframe.src = url;
}
function keyPressed(e)
{
    if(e.keyCode == 13) {
        process(input.value);
    }
}