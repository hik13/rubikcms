


function saveModalDimension(object) {
    obj=$(object).parents("form");
    link=obj.attr("action");
    string=obj.serialize();
    $.ajax({
        type: "POST",
        url: link,
        data:string,
        success:function (data) {
            obj.parents("#second-column-modal").html(data);
        }
    });
}


function setActiveDimensionGroup(new_active,editing) {
    //obj must be li
    current_active=new_active.parent().find(".active-unit");
    if (current_active.attr("rel")!=new_active.attr("rel")) {
        current_active.removeClass("active-unit");
        $.ajax({
            type: "POST",
            url: "/management/catalogmanager/dimension/view/id/"+new_active.attr("rel"),
            data: {
                modal:true 
            },
            success:function (data) {
                new_active.parents("#modal-dimension-window").find("#second-column-modal").html(data);
            }
        });
    }
    if (!editing){
        new_active.removeClass("editing").addClass("active-unit")
    } else {
        new_active.addClass("editing")   
    }
}

function setActiveDimensionParameter(new_active) {
    //obj must be li
    current_active=new_active.parent().find(".active-unit");
    if (current_active.attr("rel")!=new_active.attr("rel")) {
        current_active.removeClass("active-unit");
        new_active.addClass("active-unit")   
    }
}



$(function(){ 

    var toggleModalWindowVisibility = function() {
        el=$(".modal-overlay");
        if (el.size()>0){
            z=$(".modal-overlay:visible");
            if (z.size()>0) { 
                z.css("display","none")
            }
        }
        return false;
    }
    
    $(".show-modal").live("click",function(){
        obj=$(this);
        if ($(".modal-overlay").size()==0) {
            $.ajax({
                type: "GET",
                url: "/management/catalogmanager/dimension/",
                data: {
                    selectable_input_name:obj.next("input").attr("name"),
                    modal:true
                },
                success:function (data) {
                    $(".module-content").append(data);
                }
            });
        } else {
            $(".modal-overlay").css("display","block").find(".link_selectable_input_name").attr("value",obj.next("input").attr("name"));   
            
        }
    })
    
    $("#modal-window-close").live("click",toggleModalWindowVisibility);
  


    


    



    $("#add-dimension-group").live("click",function(){
        input=$(this).parents(".add-new-unit-group").find("#dimension_group_name_input");
        if (input.attr("value")!=""){
            $.ajax({
                type: "POST",
                url: "/management/catalogmanager/dimension/create",
                data: {
                    modal:true,
                    "DimensionGroup[dimension_group_name]":input.attr("value")
                },
                success:function (data) {
                    input.attr("value","").parents("#group_column").find("ul.unit").append(data);
                }
            });
        } 
    })


    $(".dimension-group-unit-add").live("click",function(){
        obj=$(this).parents("li:first");
        setActiveDimensionGroup(obj,false);
        id=obj.attr("rel");
            $.ajax({
            type: "POST",
            url: "/management/catalogmanager/dimension/dimensioncreate/id/"+id,
            data: {
                modal:true 
            },
            success:function (data) {
                obj.parents("#modal-dimension-window").find("#second-column-modal").html(data);
            }
        });
    })
    
   $(".dimension-group-unit-edit").live("click",function(){
        obj=$(this).parents("li:first");
        setActiveDimensionGroup(obj,true);
        obj.find(".unit-item").css("display","none");
        obj.find(".unit-edit-block").css("display","block");
    })
    
    $(".dimension-group-unit-update").live("click",function(){
        obj=$(this);
        input=$(this).parents(".unit-edit-block").find("#dimension_group_name_input");
        id=$(this).parents(".unit-edit-block").find("#dimension_group_id_input").attr("value")
        if (input.attr("value")!=""){
            $.ajax({
                type: "POST",
                url: "/management/catalogmanager/dimension/update/id/"+id,
                data: {
                    modal:true,
                    "DimensionGroup[dimension_group_name]":input.attr("value")
                },
                success:function (data) {
                   obj.parents("li:first").replaceWith(data);
                }
            });
        } 
    })

    $(".dimension-group-unit-update-cansel").live("click",function(){
        obj=$(this).parents("li:first");
        setActiveDimensionGroup(obj,false);
        value=obj.find(".unit-title").text();
        obj.find(".unit-edit-block").css("display","none").find("#dimension_group_name_input").attr("value",value);
        obj.find(".unit-item").css("display","block"); 
    })

    $(".dimension-group-unit-delete").live("click",function(){
        obj=$(this).parents("li:first");
        if (confirmdelete()){
            id=obj.attr("rel")
            $.ajax({
                type: "POST",
                url: "/management/catalogmanager/dimension/delete/id/"+id,
                data: {
                    modal:true 
                },
                success:function () {
                    if (obj.hasClass("active-unit")) {
                        if (obj.prev("li").size()>0){
                            setActiveDimensionGroup(obj.prev("li"),false);
                        } else if(obj.next("li").size()>0) {
                            setActiveDimensionGroup(obj.next("li"),false); 
                        }    
                    }
                    obj.remove();
                }
            });   
        }
    })


    $(".dimension-group-unit-title").live("click",function(){
        obj=$(this).parents("li:first");
        id_active=obj.parent().find(".active-unit").attr("rel")
        id=obj.attr("rel");
        if (id!=id_active) {
        setActiveDimensionGroup(obj,false);
        } else 
            return false
    })


    $(".dimension-unit-edit").live("click",function(){
        obj=$(this).parents("li:first");
        id=obj.attr("rel");
        $.ajax({
            type: "POST",
            url: "/management/catalogmanager/dimension/dimensionupdate/id/"+id,
            data: {
                modal:true 
            },
            success:function (data) {
                obj.parents("#modal-dimension-window").find("#second-column-modal").html(data);
            }
        });
    })


    $(".dimension-unit-delete").live("click",function(){
        obj=$(this).parents("li:first");
        id=obj.attr("rel");
        $.ajax({
            type: "POST",
            url: "/management/catalogmanager/dimension/dimensiondelete/id/"+id,
            data: {
                modal:true 
            },
            success:function (data) {
                obj.remove();
            }
        });
    })

    $(".dimension-unit-delete").live("click",function(){
        obj=$(this).parents("li:first");
        id=obj.attr("rel");
        $.ajax({
            type: "POST",
            url: "/management/catalogmanager/dimension/dimensiondelete/id/"+id,
            data: {
                modal:true 
            },
            success:function (data) {
                obj.remove();
            }
        });
    })

    $(".dimension_value").live("click",function(){
       setActiveDimensionParameter($(this));
      $(".insert_button").css("display","block");
    })
    
    
    $(".insert_button").live("click",function(){
        obj=$(".unit-value > .active-unit");
        if (obj.attr("rel")!="") {
            $("input[name='"+$(".link_selectable_input_name").attr("value")+"']").attr("value",obj.attr("rel")); 
            $("input[name='"+$(".link_selectable_input_name").attr("value")+"']").parent().find(".dimension_text_value").text(obj.text()); 
            $("#modal-window-close").click();    
        }
    })
    





})


