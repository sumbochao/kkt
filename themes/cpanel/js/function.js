
function in_array (needle, haystack, argStrict) {
    var key = '',        
    strict = !! argStrict;
    if (strict) {
        for (key in haystack) {
            if (haystack[key] === needle) {                
                return true;
            }
        }
    } else {
        for (key in haystack) {            
            if (haystack[key] == needle) {
                return true;
            }
        }
    } 
    return false;
}

// trim, rtrim, ltrim
function trim(str, chr) {
  var rgxtrim = (!chr) ? new RegExp('^\\s+|\\s+$', 'g') : new RegExp('^'+chr+'+|'+chr+'+$', 'g');
  return str.replace(rgxtrim, '');
}
function rtrim(str, chr) {
  var rgxtrim = (!chr) ? new RegExp('\\s+$') : new RegExp(chr+'+$');
  return str.replace(rgxtrim, '');
}
function ltrim(str, chr) {
  var rgxtrim = (!chr) ? new RegExp('^\\s+') : new RegExp('^'+chr+'+');
  return str.replace(rgxtrim, '');
}


function setHtmlVideo(path,width,height){
    var html = '';
    html += '<object width="'+width+'" height="'+height+'" type="video/quicktime" data="'+path+'">';
    html += '<param value="'+path+'" name="src">';
    html += '</object>';
    return html;
}