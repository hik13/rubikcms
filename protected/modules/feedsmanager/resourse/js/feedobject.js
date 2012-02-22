$(function(){ 

    $(".add_galery_image").live("click",(function(){
        parent=$(this).parents(".form-row:first")
        if (!(i=parent.find(".galery_image_div:last").attr("rel"))) {
            i=0;  
        }
        name=$(this).attr("rel")
        $.ajax({
            type: "POST",
            url: "/management/feedsmanager/feedsobject/gettemplate/",
            data: "template_name=get_galery_input&i="+i+"&name="+name,
            success: function(data){
                parent.find("#galery_image_values").append(data);
            }
        });
    }));
    
    $(".delete_galery_image").live("click",(function(){
        $(this).parents(".galery_image_div").remove();
    }));
    




})


