
function deleteRelation(type,object) {
    parents=$(object).parents(".dropdown-block")  
    if (type=="edit") {
        i=$("#feeds-form").find(".deleteRelation").size()+1;       
        parents.parents("form").append(
            '<input type="hidden" class="deleteRelation" name="deleteRelation['+i+']" value="'+parents.find(".relation_id").attr("value")+'" />'
            );        
    }
    parents.remove(); 
}

$(function(){
    $("#addTofields").click(function () {
        var count=$("#fields").find(".dropdown-block").size();
        $.ajax({
            type: "POST",
            url: "/management/feedsmanager/feeds/gettemplate/",
            data: "template_name=fields_choise&count="+count,
            success: function(data){
                $("#fields").append(data);
            }
        });
    })

    $(".typeField").livequery("change",(function () {
        var th=$(this);
        var ddC=th.parents(".dropdown-block").find(".dropdown-content");
        if (th.attr("value")){
            $.ajax({
                type: "POST",
                url: "/management/feedsmanager/feeds/gettemplate/",
                data: "template_name=fields_property&field_id="+th.attr("value")+"&i="+th.attr("id"),
                success: function(data){
                    ddC.html(data);
                    ddC.css("display","block");
                }
            });
        } else {
            ddC.html("")  
        }
    }));

    $(".deletefield").livequery("click",(function () {
        var th=$(this);
        i=$("#feeds-form").find(".deleteField").size()+1;
        $("#feeds-form").append(
            '<input type="hidden" class="deleteField" name="deleteField['+i+']" value="'+th.attr("id")+'" />'
            );
        th.parents(".dropdown-block").remove();         
    }))



    $("#Add_relation").livequery("click",(function () {
        var str="";
        $(".category").each(function() {
            str=str +"category["+$(this).parents(".category_div").attr("rel")+"]="+$(this).attr("value")+"&";
        }); 
       
        i=$("#feeds-form").find(".content_module_relation").size()+1;
        $.ajax({
            type: "POST",
            url: "/management/feedsmanager/feeds/gettemplate/",
            data: "template_name=get_relation&"+str+"i="+i,
            success: function(data){
                $("#relation").append(data);
            }
        });
    }))

 
 
    $(".add_category").click(function(){
        if (!(i=$(".category_div:last").attr("rel"))) {
            i=0;  
        }
        $.ajax({
            type: "POST",
            url: "/management/feedsmanager/feeds/gettemplate/",
            data: "template_name=get_category&i="+i,
            success: function(data){
                $("#category").append(data);
            }
        });
    });
    
        
    $(".category").live("change",function(){
        obj=$("#relation").find("input[class='relation_"+$(this).parents(".category_div").attr("rel")+"']")
        obj.attr("value",$(this).val());  
        obj.next("label").text($(this).val());
    })
    
    $(".delete_category").live("click",(function(){
        $("#relation").find("input[class='relation_"+$(this).parents(".category_div").attr("rel")+"']").parents(".checkbox").remove();
        $(this).parents(".category_div").remove();
    }));
    
    
    
    $(".add_list_data_value").live("click",(function(){
        parent=$(this).parents(".form-row:first")
        if (!(i=parent.find(".list_data_value_div:last").attr("rel"))) {
            i=0;  
        }
        name=parent.find("input:first").attr("rel")
        $.ajax({
            type: "POST",
            url: "/management/feedsmanager/feeds/gettemplate/",
            data: "template_name=get_list_data_input&i="+i+"&name="+name,
            success: function(data){
                parent.find("#list_data_values").append(data);
            }
        });
    }));
    
    $(".delete_list_data_value").live("click",(function(){
        $(this).parents(".list_data_value_div").remove();
    }));
    
    
        $(".add_image_size_value").live("click",(function(){
        parent=$(this).parents(".form-row:first")
        if (!(i=parent.find(".image_size_value_div:last").attr("rel"))) {
            i=0;  
        }
        name=parent.find("input:first").attr("rel")
        $.ajax({
            type: "POST",
            url: "/management/feedsmanager/feeds/gettemplate/",
            data: "template_name=get_image_size_input&i="+i+"&name="+name,
            success: function(data){
                parent.find("#image_size_values").append(data);
            }
        });
    }));
    
    $(".delete_image_size_value").live("click",(function(){
        $(this).parents(".image_size_value_div").remove();
    }));
    



})




