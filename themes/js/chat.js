function tag(text1, text2, text3) {
    if ((document.selection)) 
    {
        document.form.message.focus();
        document.form.document.selection.createRange().text = text3+text1+document.form.document.selection.createRange().text+text2+text3;
    } 
    else if(document.forms['form'].elements['content'].selectionStart!=undefined) 
    {
        var element = document.forms['form'].elements['content'];
        var str = element.value;
        var start = element.selectionStart;
        var length = element.selectionEnd - element.selectionStart;
        element.value = str.substr(0, start) + text3 + text1 + str.substr(start, length) + text2 + text3 + str.substr(start + length);
    } else document.form.message.value += text3+text1+text2+text3;
}
            
function sendChat(e) {
    
    if(e.ctrlKey && e.keyCode == 13){                    
        var element = document.forms['form'].elements['content'];
        var str = element.value;
        var start = element.selectionStart;
        element.value = str.substr(0, start) + "\n" + str.substr(start);
        return false;
    } else if (e.keyCode == 13) {
        if(document.forms['form'].textarea.value != ""){
            document.forms['form'].submit();    
        } else {
            return false;
        }        
    } 
}