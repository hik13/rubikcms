function sortTable(sortingTableClass,inputIdentClass,inputName,buttonSaveClass) {
    $("."+sortingTableClass).tableDnD({
        dragHandle: "tabledrag-handle-2",
        onDrop: function(table) {
            qwery="";
            $(table).find("tbody tr").each(function (i) {
                qwery=qwery+$(this).attr("id")+";";
            })
            rel_input=$(table).attr("id");
            var i=$("."+inputIdentClass+"[rel|='"+rel_input+"']").size();
            if (i==0) {
                $(table).parents("form").append('<input class="'+inputIdentClass+'" type="hidden" rel="'+rel_input+'" name="'+inputName+'['+rel_input+']" value='+qwery+' />')   
            } else {
                $("."+inputIdentClass+"[rel|='"+rel_input+"']").attr("value",qwery)    
            }
            $("."+buttonSaveClass+":hidden").css("display","block");  
        }
    });   
} 


