$(function(){
    
    
    $(".imageToUpload").change(function(){
        $(this).parents(".form-row-item").find(".uploadedImage").attr("value",$(this).attr("value")); 
    }) 


    $(".fileToUpload").change(function(){
        th=$(this);
        parent=$(this).parent();
        parent.find(".errormessage").html("");
        $(this).parents("form").
        ajaxSubmit({
            resetForm: false,
            url: "/management/feedsmanager/feedsobject/uploadfile/",
            success: function(data) { 
                th.attr("value","");
                var x = eval("(" + $.trim(data) + ")");
                if (x.responseStatus) {
                 parent.find(".uploadedFile").attr("value",x.responseText); 
                 parent.find('a').html(x.responseText) 
                                  .attr('href',x.responseText)
                                  .css("display","block")
                } else {
                    parent.find(".errormessage").html(x.responseErrors);
                }
            }
        });
    }) 

    
    
})

