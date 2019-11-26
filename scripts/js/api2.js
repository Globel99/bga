XMLHttpRequest.prototype.sendWithSimpleHeader = (header) =>{
    console.log(this.method);
}
let a = new XMLHttpRequest("POST");
XMLHttpRequest.sendWithSimpleHeader("123");