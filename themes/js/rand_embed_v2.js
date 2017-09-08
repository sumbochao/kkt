var length = adv.length;
/*var key = Math.round(Math.random() * length) - 1;
if(key <=0) key=0;

var data = adv[key];
document.write('<div id="show_data">'+data+'</div>');    

setInterval(function(){
var div = document.getElementById("show_data");
div.parentNode.removeChild(div);
key = Math.round(Math.random() * length) - 1;
if(key <=0) key=0;
data = adv[key];
alert(key);
document.write('<div id="show_data">'+data+'</div>');

},5000);  */

for(var i=0;i<length;i++){
    var data = adv[i]; 
    var display="display:none";    
    if(i==0) {  
       display = "display:block"; 
    }
    document.write('<div id="show_data_'+i+'" style="'+display+'">'+data+'</div>');
}
var key_embed = 0;
var key_sub_embed = length-1;
var t = setInterval(function(){ 
    key_embed = key_embed + 1;
    if(key_embed > length-1){
        key_embed = 0;
        key_sub_embed = length - 1;
    }else{
        key_sub_embed = key_embed - 1;
    }
    //alert(key);alert(key_sub);
    document.getElementById('show_data_'+key_embed).style.display='block';
    document.getElementById('show_data_'+key_sub_embed).style.display='none';

},4000);
key_embed = 0;
key_sub_embed = length-1;
