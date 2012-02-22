
function SaveGroup(obj,status) {
    li_parents=$(obj).parents(".catalog-group-li:first");
    value=li_parents.find(".inputNameGroup").attr("value");  
    if (value!=""){
        li_parents.find(".section-title .form-button").text(value);
        if (status=="new") {
            li_parents.find(".section-title").css("display","block");
        } 
        li_parents.find(".catalog-edit-form").slideUp(500);
    }
    return false;
}

function showGroupNameForm(obj) {
    li_parents=$(obj).parents(".catalog-group-li:first");
    if (li_parents.find(".catalog-edit-form:first:hidden").size()>0){
        li_parents.find(".catalog-edit-form:first").slideDown(500);
    }
    return false;
}

function canselSaveGroup(obj) {
    val=$(obj).parents(".catalog-group-li:first").find(".section-title .form-button").text();
    if (val=="") {
        $(obj).parents(".catalog-group-li:first").remove();    
    } else {
        $(obj).parents(".catalog-edit-form").slideUp(500).find(".inputNameGroup").val(val);    
    }
    return false;
}



function SaveParameter(obj,status) {
    li_parents=$(obj).parents("li.parameter:first");
    value=li_parents.find(".parameterName").attr("value");  
    li_parents.find(".section-parameter-title:first .form-button").text(value);
    if (value!=""){
        if (status=="new") {
            li_parents.find(".section-parameter-title").css("display","block");
        } 
        li_parents.find(".catalog-edit-form").slideUp(500);
    }
}

function showParamForm(obj) {
    li_parents=$(obj).parents("li.parameter:first");
    if (li_parents.find(".catalog-edit-form:first:hidden").size()>0){
        li_parents.find(".catalog-edit-form:first").slideDown(500);
    }
}

function canselSaveParameter(obj) {
    val=$(obj).parents("li.parameter:first").find(".section-parameter-title .form-button").text();
    if (val=="") {
        $(obj).parents("li.parameter:first").remove();    
    } else {
        $(obj).parents(".catalog-edit-form:first").slideUp(500);    
    }   
}

function randomNumber ()
{
    m = 99999999;
    n = 999999999;
    return Math.floor( Math.random() * (n - m + 1) ) + m;
}


function deleteEssenseObject(obj,ifNew,ClassObj,id) {
    size=obj.parents("form").find(".deleteObject").size()+1;
    if (!ifNew) {
        obj.parents("form").append(
            '<input type="hidden" class="deleteObject" name="deleteObject['+size+']['+ClassObj+']" value="'+id+'" />'
            )    
    }
    if (ClassObj=="Selectable") {
        deleteFromSelect(obj,id)
    }
    obj.remove();  
    return false;
}



function addTypedParameter(type_id,parent_object) {
    parametr_parent=$(parent_object).parents("li.parameter:first");
    $.ajax({
        type: "POST",
        url: "/management/catalogmanager/object/getform/",
        data: {
            type:"parameter",
            group_id:$(parent_object).parents(".catalog-group-li:first").find(".group_id").attr("value"),
            parametr_parent_id:parametr_parent.attr("id"),
            type_id:type_id
        },
        success:function (data) {
            parametr_parent.find(".parent_parametr_area:first").append(data);
        }
    });
}

function loadSelect(obj) {
    
    id=obj.parents("li.parameter:first").find(".type_type:first").attr("value");
    name=obj.find(".parameter_help_name").attr("value")+'[parameter_master_value_id]';
    if (id!=3){
        text='<select multiple="multiple" name="'+name+'[]" class="master_value_select" empty="">'
        collection=obj.parents("li.parameter:first").find(".menu-item:first .selectable_div_parents");
        $.each(collection, function() {
            id=$(this).find(".selectable_value_id").attr("value");
            value=$(this).find(".selectable_value_value").attr("value");
            text=text+'<option value="'+id+'" >'+value+'</option>';
        });
        text=text+'</select>';
        obj.find("#select_area").html(text);
        if (obj.find(".master_value").size()>0) {
        var master_value=obj.find(".master_value").attr("value");
        var arrayArea = master_value.split(',');
        obj.find(".master_value_select").val(arrayArea);
        }
    } else {
        value=obj.find(".master_value").attr("value");
        $.ajax({
            type: "POST",
            url: "/management/catalogmanager/object/getboolinput/",
            data: {
                get:true,
                name:name,
                value:value
            },
            success:function (data) {
                obj.find("#select_area").html(data);
            }
        });   
    }
}

function addToSelect(last_value){
    id=last_value.find(".selectable_value_id").attr("value");
    value=last_value.find(".selectable_value_value").attr("value");
    text='<option value="'+id+'" >'+value+'</option>';
    collection=last_value.parents(".parameter:first").find(".parent_parametr_area > li")
    $.each(collection, function() {
        $(this).find(".master_value_select").append(text);
    });
}
function deleteFromSelect(object,value) {
    colection=object.parents(".parameter:first").find(".parent_parametr_area:first > li");
    $.each(colection, function() {
        $(this).find(".master_value_select > option[value='"+value+"']").remove();
    });
}

$(function(){

    $("#addGroup").click(function () {
        var i=$("#areas .inputNameGroup").size();
        $.ajax({
            type: "POST",
            url: "/management/catalogmanager/object/getform/",
            data: {
                type:"group",
                i:i
            },
            success:function (data) {
                $("#areas").append(data);
            }
        });
    })
    

    
    
    $(".addParameter").live("click",(function() {
        p=$(this).parents(".catalog-group-li:first");
        $.ajax({
            type: "POST",
            url: "/management/catalogmanager/object/getform/",
            data: {
                type:"parameter",
                group_id:p.find(".group_id").attr("value")
            },
            success:function (data) {
                p.find("ul.parameter_area").append(data);
            }
        });
    }))
    
    function chekNumberValue(parent){
        //disabled
        nt=parent.find(".number_type[id='active']");
        if ((parent.find(".work_type").attr("value")==3) || (parent.find(".type_type").attr("value")==3)) {
            nt.attr("value","2").attr("disabled","true");   
        } else {
            nt.removeAttr("disabled");  
        }
        //selectable_area
        if (((nt.attr("value")==2)||(nt.attr("value")==3))&& (parent.find(".type_type").attr("value")!=3)) {
            parent.find(".selectable_values").css("display","block")
        } else {
            parent.find(".selectable_values").css("display","none")
        }
    }
    
    $(".slave_parameter_id").live("change",function(){
      
        if ($(this).attr("value")!=""){
            loadSelect($(this).parents(".parameter:first"))
        } else {
            $($(this).parents(".parameter:first").find("#slave_select:first").remove());
        }
    })
       
       
    $(".work_type").live("change",function(){     
        count_add=$(this).parents("li.parameter:first").find(".table-action-buttons li.table-action-add").size();   
        parent=$(this).parents("li.parameter:first");
        val=$(this).attr("value");
        if (((val==2) || (val==3)) && count_add==0)  {
            parent.find(".table-action-buttons").prepend(
                '<li class="table-action-add"><a  onclick="addTypedParameter('+val+', this)"></a></li>')
        } else {
            if ((val==1) && (count_add>0)){
                parent.find(".table-action-buttons li.table-action-add").remove();  
            }
        }
        if ((val==1) || (val==3)){
            parent.find("#group_parameter_area").css("display","none");
            parent.find("#type").css("display","block");
            parent.find("#number").css("display","block");
        } else if (val==2) {
            parent.find("#group_parameter_area").css("display","block");
            parent.find("#type").css("display","none");
            parent.find("#number").css("display","none"); 
        }
        chekNumberValue(parent);
    })
    
    $(".type_type").live("change",function(){
        parent=$(this).parents("li.parameter:first");
        val=$(this).attr("value");
        parent.find("#number").css("display","block");
        if ((val==3) || (val==1) ) {
            parent.find("#parameter_dimension_area").css("display","none"); 
        }else if (val==2) {
            parent.find("#parameter_dimension_area").css("display","block");
        }
        chekNumberValue(parent);
    })
    
    $(".number_type").live("change",function(){
        chekNumberValue($(this).parents("li.parameter:first"));
    })
    
    
    
    $(".input_key_sort").live("change",function(){ 
        if ($(this).attr("value")==0) {
            $(this).parents(".parameter:first").find(".catalog-main-parametr:first").css("display","none") 
        } else {
            $(this).parents(".parameter:first").find(".catalog-main-parametr:first").css("display","block")   
        }
    })
    
 
    
    $(".input_primary_sort").live("change",function(){
        if ($(this).attr("value")==0) {
            $(this).parents(".parameter:first").find(".catalog-filtr-parametr:first").css("display","none") 
        } else {
            $(this).parents(".parameter:first").find(".catalog-filtr-parametr:first").css("display","block")   
        }
    })
    
    $(".add_selectable_value_input_button").live("click",function(){
        input=$(this).parents(".master-group-parametr-add").find("#add_selectable_value_input");
        value=jQuery.trim(input.attr("value"));
        if (value!="") {
            area=$(this).parents(".selectable_values");
            size=area.find(".master-group-parametrs input:last").parents(".form-row:first").attr("rel");
            inputname=$(this).parents(".parameter:first").find(".parameter_help_name").attr("value");
            typeid=$(this).parents(".parameter:first").find(".type_type").attr("value");
            $.ajax({
                type: "POST",
                url: "/management/catalogmanager/object/getform/",
                data: {
                    type:"parameter_selectable_value",
                    typeid:typeid,
                    inputname:inputname,
                    value:value,
                    i:size
                },
                success:function (data) {
                    area.find(".master-group-parametrs").append(data);
                    input.attr("value","")
                    addToSelect(area.find(".master-group-parametrs").find(".selectable_div_parents:last"))
                }
            }); 
        }
    })
    

})


