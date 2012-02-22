



function setName(id,name) {
    //  $("#Item_item_manufacturer_id").attr("value",id);
    $("#suggest_manufacturer_name").attr("value",name);
    $("#manufacturer_suggest").empty();
}

var globalSet=true;

$(function(){
    $("#suggest_manufacturer_name").keyup(function ()  {
        if (globalSet) {
            globalSet=false;
            var v=$(this);
            $.ajax({
                type: "GET",
                url: "/management/catalogmanager/manufacturer/suggest/str/"+v.attr("value"),
                success:function (data) {
                    globalSet=true;
                    var  x=eval("(" + $.trim(data) + ")");
                    if (x.responseStatus) {
                        $("#manufacturer_suggest").html(x.responseText);
                    } else {
                        alert(x.responseErrors);
                    }
                }
            });
        }
    })



    $(".master_select").live("change",function(){
        obj=$(this);
        parameter_id=$(this).parent().find(".parameter_id").attr("value");
        id=$(this).attr("value");
        count_values=$("input.count_value").size();
        $.ajax({
            type: "POST",
            url: "/management/catalogmanager/object/getmasterinput/",
            data: {
                parameter_id:parameter_id,
                value_id:id,
                count_values:count_values
            },
            success:function (data) {
                obj.parents("tr").next("tr").find("#slave_parameter").html(data)  
            }
        });
    })

    
})

