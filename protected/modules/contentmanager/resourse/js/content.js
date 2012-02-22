
function changeClass(old,nev,obj,action) {
    obj.parents("li:first").find(".ul_sort:first").css("display",action);
    obj.removeClass(old).addClass(nev);
}
    
$(function(){

    var changeStatusChild = function(object) {
        if (object.find(".table-item-status:first").hasClass("unpublished")) {
            object.find("li .table-item-status").addClass("unpublished");
        } else {
            object.find("li .table-item-status").each (function () {
                if (!$(this).parents("li.drag:first").hasClass("disabled")) {
                    $(this).removeClass("unpublished") 
                }
            })
        }
    }

    $(".contenttable li.disabled").each (function () {
        changeStatusChild($(this));
    })


    $(".table-item-status").click(function () {
        th=$(this);
        if (!th.parents("li:first").parents("li:first").find(".table-item-status:first").hasClass("unpublished")) {
            $.ajax({
                type: "POST",
                url: "/management/contentmanager/content/setstatus/",
                data:{
                    id:th.parents("li:first").attr("id")
                },
                success:function (data) {
                    th.toggleClass("unpublished").parents("li:first").toggleClass("disabled");
                    changeStatusChild(th.parents("li:first"))
                }
            });
        }
    })



    $(".status").click(function () {
        if ($(this).hasClass("closed")) {
            changeClass("closed","opened",$(this),"block");
        } else if ($(this).hasClass("opened")) {
            changeClass("opened","closed",$(this),"none");
        }
    })



    $(".translit").click(function ()  {
        var value=$("#Content_name").attr("value");
        $.ajax({
            type: "POST",
            url: "/management/contentmanager/content/translit/",
            data:{
                translit:value
            },
            success:function (data) {
                var x = eval("(" + $.trim(data) + ")");
                if (x.responseStatus) {
                    $("#Content_textlink").attr("value",x.responseText)
                } else {
                    alert(x.responseErrors)
                }
            }
        });
    })
})

