/*var length = adv_auto.length;

for(var i=0;i<length;i++){
    var data_auto = adv_auto[i]; 
    var display="display:none";    
    if(i==0) {  
       display = "display:block"; 
    }
    document.write('<div id="show_data_auto_'+i+'" style="'+display+'">'+data_auto+'</div>');
}
var key_embed_auto = 0;
var key_sub_embed_auto = length-1;
var t = setInterval(function(){ 
    key_embed_auto = key_embed_auto + 1;
    if(key_embed_auto > length-1){
        key_embed_auto = 0;
        key_sub_embed_auto = length - 1;
    }else{
        key_sub_embed_auto = key_embed_auto - 1;
    }
    document.getElementById('show_data_auto_'+key_embed_auto).style.display='block';
    document.getElementById('show_data_auto_'+key_sub_embed_auto).style.display='none';

},4000);
key_embed_auto = 0;
key_sub_embed_auto = length-1;
                                */
var length = adv_auto.length;
var key_auto = Math.round(Math.random() * length) - 1;
if(key_auto <=0) key_auto=0;
var data_auto = adv_auto[key_auto];
document.write(data_auto);    