const getCookie = (cname) => {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

const getInfo = (resolve, reject) => {
  const token = getCookie('auth_token');
  var data = JSON.stringify(false);
  var xhr = new XMLHttpRequest();
  xhr.withCredentials = true;

  xhr.addEventListener("readystatechange", function () {
    if (this.readyState === this.DONE) {
      resolve(JSON.parse(this.responseText));
    }else{
      reject();
    }
  });

  xhr.open("GET", "http://localhost:8000/api/profile/");
  xhr.setRequestHeader("accept", "application/json");
  xhr.setRequestHeader("authorization", `Bearer ${token}`);
  xhr.setRequestHeader("content-type", "application/json");

  xhr.send(data);
}

module.exports = {
  getInfo,
}