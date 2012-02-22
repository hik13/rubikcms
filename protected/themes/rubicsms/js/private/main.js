
function checkitAll(object,parent) {
    if($(object).attr("checked")) {
        $(parent).find(":checkbox'").attr("checked",true)
    } 
    else {
        $(parent).find(":checkbox'").attr("checked",false);
    }
}

function confirmdelete() {
    return confirm("Вы действительно хотите удалить объект")?true:false;
}


$(function(){
    $("a.dropdown-button").livequery("click",(function() {
        if ($(this).hasClass("opened")) {
            $(this).removeClass("opened").parents(".dropdown-block").find(".dropdown-content").css("display","none");  
        } else {
            $(this).addClass("opened").parents(".dropdown-block").find(".dropdown-content").css("display","block"); 
        }
    }))

    var toggleMenuModulesVisibility = function() {
        var el = $("#extended-menu-bar");
        z=el.parent().find(".extended-main-menu:hidden")
        if (z.size()>0) { 
            z.css("display","block")
            $(document).bind('click',toggleMenuModulesVisibility );

        } else {
            el.parent().find(".extended-main-menu").css("display","none")
            $(document).unbind('click', toggleMenuModulesVisibility);
        }
        return false;
    }
    
 
    $("#extended-menu-bar").click(toggleMenuModulesVisibility);
    $("#modul-menu-close").click(toggleMenuModulesVisibility);
    $(".extended-main-menu").click(function(event){
        event.stopPropagation();
    });


 
    $(".login_input").keypress(function(event) {
        if (event.which == '13') {
            $(this).parents("form").submit(); 
        }
    }
    ); 


})