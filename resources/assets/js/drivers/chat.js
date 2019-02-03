const getInfo = (resolve, reject) => {
  var data = null;
  var xhr = new XMLHttpRequest();
  xhr.withCredentials = true;
  xhr.addEventListener("readystatechange", function () {
    if (this.readyState === this.DONE) {
      resolve(JSON.parse(this.responseText));
    }else
      reject();
  });
  xhr.open("GET", "http://localhost:8000/chat/info");
  xhr.send(data);
}

const sendMessage = (name, message, resolve, reject) => {
  var data = null;
  var xhr = new XMLHttpRequest();
  xhr.withCredentials = true;
  xhr.addEventListener("readystatechange", function () {
    // if (this.readyState === this.DONE) {
      // resolve(JSON.parse(this.responseText));
    // }else
      // reject();
  });
  xhr.open("GET", `http://localhost:8000/chat/new-message?name=${name}&message=${message}`);
  xhr.send(data);
}

module.exports = {
  getInfo,
  sendMessage,
}