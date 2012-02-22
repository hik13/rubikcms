$(function(){
       
    $("#add_depfile").click(function () {
        var i=$("#files .block_dependies").size();
        $("#files").append(
            '<div><input type="file" id="Block_block_dependies_'+i+'" name="Block[block_dependies]['+i+']" value="" class="block_dependies"></div>'
            );
    })

    $(".deldependies").click(function () {
        var i=$("#files .del_dependies").size()+1;
        $(this).parents(".block_dependies_div")
        .css("display","none")
        .find(".block_dependies")
        .attr("name","del_dependies["+i+"]")
        .attr("class","del_dependies");
    })


    $(".delbanner").click(function () {
        var val = $(this).attr("rel");
        parent=$(this).parents(".block_dependies_div").css("display","none").find("#banner_delete").attr("value", val);
        $("#file-form").css("display","block");
    })

})