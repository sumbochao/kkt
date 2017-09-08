var length = adv.length;
var key = Math.round(Math.random() * length) - 1;

var data = adv[key];

var username_domain = "http://" + username + ".taoviec.com";
var html = '';
html += '<div style="text-align: center;">';
html +=     '<a href="' + username_domain + '">';
html +=         '<img border=0 width="' + width + '" src="' + data[0] + '" title="' + escape(data[1]) + '">';
html +=     '</a>';
html +=     '<br />';
html +=     '<a href="' + username_domain + '">';
html +=         data[1];
html +=     '</a>';
html += '</div>';
document.write(html);