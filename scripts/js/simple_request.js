class SimpleRequest extends XMLHttpRequest {
    sendPOST(url, header){
      this.open("POST", url);
      this.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      this.send(header);
    }
    sendGET(url, header){
        this.open("GET", url+header);
        this.send();
        this.onreadystatechange = () => console.log(this.responseText);
        console.log("sendGET");
        //console.log(this.responseText);
    }
  }