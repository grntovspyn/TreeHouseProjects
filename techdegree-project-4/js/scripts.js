/*
* Took some inspiration from the website below then changed code after digging through
* w3schools.com and reading up on javascript.
* https://medium.com/@melwinalm/crcreating-keyboard-shortcuts-in-javascripteating-keyboard-shortcuts-in-javascript-763ca19beb9e
*/

document.onkeypress = function(e) {
    var x = event.which || event.keyCode;
    var res = String.fromCharCode(x);
    var res = res.toLowerCase();
    
    document.getElementById(res).click();

  };

  