class SimpleRequest extends XMLHttpRequest {
    sendPOST(url, header){
      this.open("POST", url);
      this.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      this.send(header);
    }
  }