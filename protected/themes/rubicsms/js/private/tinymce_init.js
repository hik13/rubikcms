
function ajaxfilemanager(field_name, url, type, win) {
    var ajaxfilemanagerurl = "/protected/themes/rubicsms/js/public/tinymce/plugins/ajaxfilemanager/ajaxfilemanager.php";
    switch (type) {
        case "image":
            break;
        case "media":
            break;
        case "flash":
            break;
        case "file":
            break;
        default:
            return false;
    }
                        
                      
                        
    tinyMCE.activeEditor.windowManager.open({
        url: "/protected/themes/rubicsms/js/public/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php",
        width: 782,
        height: 440,
        inline : "yes",
        close_previous : "no"
    },{
        window : win,
        input : field_name
    });

    //return false;
        
    var fileBrowserWindow = new Array();
    fileBrowserWindow["file"] = ajaxfilemanagerurl;
    fileBrowserWindow["title"] = "Ajax File Manager";
    fileBrowserWindow["width"] = "782";
    fileBrowserWindow["height"] = "440";
    fileBrowserWindow["close_previous"] = "no";
    //tinyMCE.openWindow(fileBrowserWindow, {
    // window : win,
    // input : field_name,
    // resizable : "yes",
    // inline : "yes"
    // editor_id : tinyMCE.getWindowArg("editor_id")
    //});

    return false;
}

$(function() {
    $('.tinymce').tinymce({
        // Location of TinyMCE script
        script_url : '/protected/themes/rubicsms/js/public/tiny_mce/tiny_mce.js',
        
        
        elements : "ajaxfilemanager",
        file_browser_callback : "ajaxfilemanager",
        
        
        // General options
        theme : "advanced",
        plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
      
        // Theme options
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : false,

        // Example content CSS (should be your site CSS)
        //     content_css : "/themes/mobilebank/css/site-default-theme.css , /themes/mobilebank/css/site-layout.css;",


        extended_valid_elements : "div[*],p[*],a[*],img[*],hr[*],font[*],span[*],object[*],embed[*]",


        width : "100%",
        forced_root_block : '',
        force_br_newlines : true,
        force_p_newlines : false,
        relative_urls : false,
        convert_urls : false,
        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "lists/template_list.js",
        external_link_list_url : "lists/link_list.js",
        external_image_list_url : "lists/image_list.js",
        media_external_list_url : "lists/media_list.js",

        // Replace values for the template plugin
        template_replace_values : {
            username : "Some User",
            staffid : "991234"
        }
    });
});



