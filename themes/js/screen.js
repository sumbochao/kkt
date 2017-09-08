var width = null;
if(window.screen != null){
    width = window.screen.availWidth;
}
if(window.innerWidth != null){
    width = window.innerWidth;
}
if(document.body != null){
    width = document.body.clientWidth;
}
