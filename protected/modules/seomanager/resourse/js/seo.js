

function canselSaveCounter(obj) {
    val=$(obj).parents(".catalog-group-li:first").find(".section-title .form-button").text();
    if (val=="") {
        $(obj).parents(".catalog-group-li:first").remove();    
    } else {
        $(obj).parents(".catalog-edit-form").css("display","none").find(".inputNameGroup").val(val);    
    }   
}

function showCounterNameForm(obj) {
    li_parents=$(obj).parents(".catalog-group-li:first");
    if (li_parents.find(".catalog-edit-form:first").css("display")=="none"){
        li_parents.find(".catalog-edit-form:first").css("display","block");
    }
}

function deleteCounter(obj) {
    if (confirmdelete())
        $(obj).parents("li.catalog-group-li").remove();  
}

function SaveParameter(obj) {
    li_parents=$(obj).parents(".catalog-list");
    value=li_parents.find(".counterName").attr("value");  
    li_parents.find(".section-title .form-button").text(value);
    if (li_parents.find(".section-title:visible").size()==0) {
        li_parents.find(".section-title").css("display","block");
    } 
    li_parents.find(".catalog-edit-form").css("display","none");
}


$(function(){

    $("#addCounter").click(function () {
        var i=$("#counters").attr("rel")
        var j=$("#counters .catalog-list").size();
        $.ajax({
            type: "POST",
            url: "/management/seomanager/seo/getcounterform/",
            data: {
                i:i,
                j:j
            },
            success:function (data) {
                $("#counters").append(data);
            }
        });
    })
})