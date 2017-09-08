var length = adv.length;
var key = Math.round(Math.random() * length) - 1;
if(key <=0) key=0;
var data = adv[key];
document.write(data);    