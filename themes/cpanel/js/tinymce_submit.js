tinyMCE.init({
  mode : "exact",
  elements : "description, content, lyrics,title_top,title_bottom",
  theme : "advanced",
  plugins : "jbimages,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,jbimages",

  theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,fontselect,fontsizeselect,forecolor,backcolor",
  theme_advanced_buttons2 : "jbimages,image,jbimages,link,unlink,emotions,|,table,tablecontrols,code",
  theme_advanced_buttons3 : "",
  theme_advanced_toolbar_location : "top",
  theme_advanced_toolbar_align : "left",
  theme_advanced_blockformats : "p,h2,h3,h4",
  removeformat_selector : "h2,h3,h4,br,b,strong,em,i,pre,span",
  theme_advanced_statusbar_location : "bottom",
  theme_advanced_path : false,
  extended_valid_elements : "a[!href|target|title],img[src|border=0|alt|title|hspace|vspace|width|height|align|name],br,strong/b,em/i,u,li,ul,ol",
  entity_encoding : "raw",
  //content_css : "../css/content.css",
  textarea_trigger : 'content_body',
  theme_advanced_resize_horizontal : true,
  theme_advanced_resizing : true,
  width:700,
  height:400,
  'editorTemplate' : 'full', 
  'useSwitch':false, 
  convert_urls : false,
  inline_styles : false,
	formats : {
		bold : {inline : 'strong'},
		italic : {inline : 'em'},
		underline : {inline : 'u'}
	},
  setup : function(ed) {
    ed.onKeyUp.add(function(ed, e) {    
      var strip = (tinyMCE.activeEditor.getContent()).replace(/(<([^>]+)>)/ig,"");
      var text = " " +  strip.length + " Characters ";
      tinymce.DOM.setHTML(tinymce.DOM.get(tinyMCE.activeEditor.id + '_path_row'), text);
    });
  }
});

function toggleEditor(id) {
  if (!tinyMCE.getInstanceById(id))
    tinyMCE.execCommand('mceAddControl', false, id);
  else
    tinyMCE.execCommand('mceRemoveControl', false, id);
}