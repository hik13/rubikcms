$(function(){
    
    function changeClass(old,nev,obj,action) {
        obj.parents("li:first").find(".ul_sort:first").css("display",action);
        obj.removeClass(old).addClass(nev);
    }

    $(".status").click(function () {
        if ($(this).hasClass("closed")) {
            changeClass("closed","opened",$(this),"block");
        } else if ($(this).hasClass("opened")) {
            changeClass("opened","closed",$(this),"none");
        }
    })

})